<?php

/*
 * Nucleus: PHP/MySQL Weblog CMS (http://nucleuscms.org/)
 * Copyright (C) 2002-2007 The Nucleus Group
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * (see nucleus/documentation/index.html#license for more info)
 */
/**
 * A class representing site members
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: MEMBER.php 1116 2007-02-03 08:24:29Z kimitake $
 */
class MEMBER {

	// 1 when authenticated, 0 when not
	var $loggedin = 0;
	var $password;		// not the actual password, but rather a MD5 hash

	var $cookiekey;		// value that should also be in the client cookie to allow authentication

	// member info
	var $id = -1;
	var $realname;
	var $displayname;
	var $email;
	var $url;
	var $language = '';		// name of the language file to use (e.g. 'english' -> english.php)
	var $admin = 0;			// (either 0 or 1)
	var $canlogin = 0;		// (either 0 or 1)
	var $notes;

	// (private)
	function MEMBER() {

	}

	// (static)
	function &createFromName($displayname) {
		$mem =& new MEMBER();
		$mem->readFromName($displayname);
		return $mem;
	}

	// (static)
	function &createFromID($id) {
		$mem =& new MEMBER();
		$mem->readFromID($id);
		return $mem;
	}

	function readFromName($displayname) {
		return $this->read("mname='".addslashes($displayname)."'");
	}

	function readFromID($id) {
		return $this->read("mnumber=" . intval($id));
	}

	/**
	  * Tries to login as a given user. Returns true when succeeded,
	  * returns false when failed
	  */
	function login($login, $password) {
		$this->loggedin = 0;
		if (!$this->readFromName($login))
			return 0;
		if (!$this->checkPassword($password))
			return 0;
		$this->loggedin = 1;
		return $this->isLoggedIn();
	}

	// login using cookie key
	function cookielogin($login, $cookiekey) {
		$this->loggedin = 0;
		if (!$this->readFromName($login))
			return 0;
		if (!$this->checkCookieKey($cookiekey))
			return 0;
		$this->loggedin = 1;
		return $this->isLoggedIn();
	}

	function logout() {
		$this->loggedin=0;
	}

	function isLoggedIn() {
		return $this->loggedin;
	}

	function read($where) {
		// read info
		$query =  'SELECT * FROM '.sql_table('member') . ' WHERE ' . $where;

		$res = sql_query($query);
		$obj = mysql_fetch_object($res);

		$this->setRealName($obj->mrealname);
		$this->setEmail($obj->memail);
		$this->password = $obj->mpassword;
		$this->setCookieKey($obj->mcookiekey);
		$this->setURL($obj->murl);
		$this->setDisplayName($obj->mname);
		$this->setAdmin($obj->madmin);
		$this->id = $obj->mnumber;
		$this->setCanLogin($obj->mcanlogin);
		$this->setNotes($obj->mnotes);
		$this->setLanguage($obj->deflang);

		return mysql_num_rows($res);
	}


	/**
	  * Returns true if member is an admin for the given blog
	  * (returns false if not a team member)
	  */
	function isBlogAdmin($blogid) {
		$query = 'SELECT tadmin FROM '.sql_table('team').' WHERE'
			   . ' tblog=' . intval($blogid)
			   . ' and tmember='. $this->getID();
		$res = sql_query($query);
		if (mysql_num_rows($res) == 0)
			return 0;
		else
			return (mysql_result($res,0,0) == 1) ;
	}

	function blogAdminRights($blogid) {
		return ($this->isAdmin() || $this->isBlogAdmin($blogid));
	}


	function teamRights($blogid) {
		return ($this->isAdmin() || $this->isTeamMember($blogid));
	}

	/**
	  * Returns true if this member is a team member of the given blog
	  */
	function isTeamMember($blogid) {
		$query = 'SELECT * FROM '.sql_table('team').' WHERE'
			   . ' tblog=' . intval($blogid)
			   . ' and tmember='. $this->getID();
		$res = sql_query($query);
		return (mysql_num_rows($res) != 0);
	}

	/**
	  * Returns true if this member can edit/delete a commentitem. This can be in the
	  * following cases:
	  *	  - member is a super-admin
	  *   - member is the author of the comment
	  *   - member is admin of the blog associated with the comment
	  *   - member is author of the item associated with the comment
	  */
	function canAlterComment($commentid) {
		if ($this->isAdmin()) return 1;

		$query =  'SELECT citem as itemid, iblog as blogid, cmember as cauthor, iauthor'
			   . ' FROM '.sql_table('comment') .', '.sql_table('item').', '.sql_table('blog')
			   . ' WHERE citem=inumber and iblog=bnumber and cnumber=' . intval($commentid);
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);

		return ($obj->cauthor == $this->getID()) or $this->isBlogAdmin($obj->blogid) or ($obj->iauthor == $this->getID());
	}

	/**
	  * Returns true if this member can edit/delete an item. This is true in the following
	  * cases: - member is a super-admin
	  *	       - member is the author of the item
	  *        - member is admin of the the associated blog
	  */
	function canAlterItem($itemid) {
		if ($this->isAdmin()) return 1;

		$query =  'SELECT iblog, iauthor FROM '.sql_table('item').' WHERE inumber=' . intval($itemid);
		$res = sql_query($query);
		$obj = mysql_fetch_object($res);
		return ($obj->iauthor == $this->getID()) or $this->isBlogAdmin($obj->iblog);
	}

	/**
	  * returns true if this member can move/update an item to a given category,
	  * false if not (see comments fot the tests that are executed)
	  *
	  * @param itemid
	  * @param newcat (can also be of form 'newcat-x' with x=blogid)
	  */
	function canUpdateItem($itemid, $newcat) {
		global $manager;

		// item does not exists -> NOK
		if (!$manager->existsItem($itemid,1,1)) return 0;

		// cannot alter item -> NOK
		if (!$this->canAlterItem($itemid)) return 0;

		// if this is a 'newcat' style newcat
		// no blog admin of destination blog -> NOK
		// blog admin of destination blog -> OK
		if (strstr($newcat,'newcat')) {
			// get blogid
			list($blogid) = sscanf($newcat,'newcat-%d');
			return $this->blogAdminRights($blogid);
		}

		// category does not exist -> NOK
		if (!$manager->existsCategory($newcat)) return 0;


		// get item
		$item =& $manager->getItem($itemid,1,1);

		// old catid = new catid -> OK
		if ($item['catid'] == $newcat) return 1;

		// not a valid category -> NOK
		$validCat = quickQuery('SELECT COUNT(*) AS result FROM '.sql_table('category').' WHERE catid='.intval($newcat));
		if (!$validCat) return 0;

		// get destination blog
		$source_blogid = getBlogIDFromItemID($itemid);
		$dest_blogid = getBlogIDFromCatID($newcat);

		// not a team member of destination blog -> NOK
		if (!$this->teamRights($dest_blogid)) return 0;

		// if member is author of item -> OK
		if ($item['authorid'] == $this->getID()) return 1;

		// if member has admin rights on both blogs: OK
		if (($this->blogAdminRights($dest_blogid)) && ($this->blogAdminRights($source_blogid))) return 1;

		// all other cases: NOK
		return 0;

	}

	function canAddItem($catid) {
		global $manager;

		// if this is a 'newcat' style newcat
		// no blog admin of destination blog -> NOK
		// blog admin of destination blog -> OK
		if (strstr($catid,'newcat')) {
			// get blogid
			list($blogid) = sscanf($catid,"newcat-%d");
			return $this->blogAdminRights($blogid);
		}

		// category does not exist -> NOK
		if (!$manager->existsCategory($catid)) return 0;

		$blogid = getBlogIDFromCatID($catid);

		// no team rights for blog -> NOK
		if (!$this->teamRights($blogid)) return 0;

		// all other cases: OK
		return 1;
	}

	/**
	  * Return true if member can be deleted. This means that there are no items
	  * posted by the member left
	  */
	function canBeDeleted() {
		$res = sql_query('SELECT * FROM '.sql_table('item').' WHERE iauthor=' . $this->getID());
		return (mysql_num_rows($res) == 0);
	}

	/**
	  * Sets the cookies for the member
	  *
	  * @param shared
	  *		set this to 1 when using a shared computer. Cookies will expire
	  *		at the end of the session in this case.
	  */
	function setCookies($shared = 0) {
		global $CONF;

		if ($CONF['SessionCookie'] || $shared)
			$lifetime = 0;
		else
			$lifetime = (time()+2592000);

		setcookie($CONF['CookiePrefix'] .'user',$this->getDisplayName(),$lifetime,$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
		setcookie($CONF['CookiePrefix'] .'loginkey', $this->getCookieKey(),$lifetime,$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);

		// make sure cookies on shared pcs don't get renewed
		if ($shared)
			setcookie($CONF['CookiePrefix'] .'sharedpc', '1',$lifetime,$CONF['CookiePath'],$CONF['CookieDomain'],$CONF['CookieSecure']);
	}

	function sendActivationLink($type, $extra='')
	{
		global $CONF;

		// generate key and URL
		$key = $this->generateActivationEntry($type, $extra);
		$url = $CONF['AdminURL'] . 'index.php?action=activate&key=' . $key;

		// choose text to use in mail
		switch ($type)
		{
			case 'register':
				$message = _ACTIVATE_REGISTER_MAIL;
				$title = _ACTIVATE_REGISTER_MAILTITLE;
				break;
			case 'forgot':
				$message = _ACTIVATE_FORGOT_MAIL;
				$title = _ACTIVATE_FORGOT_MAILTITLE;
				break;
			case 'addresschange':
				$message = _ACTIVATE_CHANGE_MAIL;
				$title = _ACTIVATE_CHANGE_MAILTITLE;
				break;
			default;
		}

		// fill out variables in text

		$aVars = array(
			'siteName' => $CONF['SiteName'],
			'siteUrl' => $CONF['IndexURL'],
			'memberName' => $this->getDisplayName(),
			'activationUrl' => $url
		);

		$message = TEMPLATE::fill($message, $aVars);
		$title = TEMPLATE::fill($title, $aVars);

		// send mail

		@mail($this->getEmail(), $title ,$message,'From: ' . $CONF['AdminEmail']);

		ACTIONLOG::add(INFO, _ACTIONLOG_ACTIVATIONLINK . ' (' . $this->getDisplayName() . ' / type: ' . $type . ')');


	}

	/**
	  * Returns an array of all blogids for which member has admin rights
	  */
	function getAdminBlogs() {
		$blogs = array();

		if ($this->isAdmin())
			$query = 'SELECT bnumber as blogid from '.sql_table('blog');
		else
			$query = 'SELECT tblog as blogid from '.sql_table('team').' where tadmin=1 and tmember=' . $this->getID();

		$res = sql_query($query);
		if (mysql_num_rows($res) > 0) {
			while ($obj = mysql_fetch_object($res)) {
				array_push($blogs, $obj->blogid);
			}
		}

		return $blogs;
	}

	/**
	  * Returns an email address from which notification of commenting/karma voting can
	  * be sent. A suggestion can be given for when the member is not logged in
	  */
	function getNotifyFromMailAddress($suggest = "") {
		global $CONF;
		if ($this->isLoggedIn()) {
			return $this->getDisplayName() . " <" . $this->getEmail() . ">";
		} else if (isValidMailAddress($suggest)) {
			return $suggest;
		} else {
			return $CONF['AdminEmail'];
		}
	}

	/**
	  * Write data to database
	  */
	function write() {

		$query =  'UPDATE '.sql_table('member')
			   . " SET mname='" . addslashes($this->getDisplayName()) . "',"
			   . "     mrealname='". addslashes($this->getRealName()) . "',"
			   . "     mpassword='". addslashes($this->getPassword()) . "',"
			   . "     mcookiekey='". addslashes($this->getCookieKey()) . "',"
			   . "     murl='" . addslashes($this->getURL()) . "',"
			   . "     memail='" . addslashes($this->getEmail()) . "',"
			   . "     madmin=" . $this->isAdmin() . ","
			   . "     mnotes='" . addslashes($this->getNotes()) . "',"
			   . "     mcanlogin=" . $this->canLogin() . ","
			   . "	   deflang='" . addslashes($this->getLanguage()) . "'"
			   . " WHERE mnumber=" . $this->getID();
		sql_query($query);
	}

	function checkPassword($pw) {
		return (md5($pw) == $this->getPassword());
	}

	function checkCookieKey($key) {
		return (($key != '') && ($key == $this->getCookieKey()));
	}

	function getRealName() {
		return $this->realname;
	}

	function setRealName($name) {
		$this->realname = $name;
	}

	function getEmail() {
		return $this->email;
	}

	function setEmail($email) {
		$this->email = $email;
	}

	function getPassword() {
		return $this->password;
	}

	function setPassword($pwd) {
		$this->password = md5($pwd);
	}

	function getCookieKey() {
		return $this->cookiekey;
	}

	/**
	  * Generate new cookiekey, save it, and return it
	  */
	function newCookieKey() {
		mt_srand( (double) microtime() * 1000000);
		$this->cookiekey = md5(uniqid(mt_rand()));
		$this->write();
		return $this->cookiekey;
	}

	function setCookieKey($val) {
		$this->cookiekey = $val;
	}

	function getURL() {
		return $this->url;
	}

	function setURL($site) {
		$this->url = $site;
	}

	function getLanguage() {
		return $this->language;
	}

	function setLanguage($lang) {
		$this->language = $lang;
	}

	function setDisplayName($nick) {
		$this->displayname = $nick;
	}

	function getDisplayName() {
		return $this->displayname;
	}

	function isAdmin() {
		return $this->admin;
	}

	function setAdmin($val) {
		$this->admin = $val;
	}

	function canLogin() {
		return $this->canlogin;
	}

	function setCanLogin($val) {
		$this->canlogin = $val;
	}

	function getNotes() {
		return $this->notes;
	}

	function setNotes($val) {
		$this->notes = $val;
	}

	function getID() {
		return $this->id;
	}

	// returns true if there is a member with the given login name (static)
	function exists($name) {
		$r = sql_query('select * FROM '.sql_table('member')." WHERE mname='".addslashes($name)."'");
		return (mysql_num_rows($r) != 0);
	}

	// returns true if there is a member with the given ID (static)
	function existsID($id) {
		$r = sql_query('select * FROM '.sql_table('member')." WHERE mnumber='".intval($id)."'");
		return (mysql_num_rows($r) != 0);
	}

	// checks if a username is protected. If so, it can not be used on anonymous comments
	function isNameProtected($name) {

		// extract name
		$name = strip_tags($name);
		$name = trim($name);

		return MEMBER::exists($name);
	}

	// adds a new member (static)
	function create($name, $realname, $password, $email, $url, $admin, $canlogin, $notes, $e_list) {
		if (!isValidMailAddress($email))
			return _ERROR_BADMAILADDRESS;

		if (!isValidDisplayName($name))
			return _ERROR_BADNAME;

		if (MEMBER::exists($name))
			return _ERROR_NICKNAMEINUSE;

		if (!$realname)
			return _ERROR_REALNAMEMISSING;

		if (!$password)
			return _ERROR_PASSWORDMISSING;

		// Sometimes user didn't prefix the URL with http://, this cause a malformed URL. Let's fix it.
		if (!eregi("^https?://", $url))
			$url = "http://".$url;

		$name = addslashes($name);
		$realname = addslashes($realname);
		$password = addslashes(md5($password));
		$email = addslashes($email);
		$url = addslashes($url);
		$admin = intval($admin);
		$canlogin = intval($canlogin);
		$notes = addslashes($notes);

		$query = 'INSERT INTO '.sql_table('member')." (MNAME,MREALNAME,MPASSWORD,MEMAIL,MURL, MADMIN, MCANLOGIN, MNOTES, MAILINGLIST) "
			   . "VALUES ('$name','$realname','$password','$email','$url',$admin, $canlogin, '$notes','$e_list')";

		sql_query($query);

		ACTIONLOG::add(INFO, _ACTIONLOG_NEWMEMBER . ' ' . $name);

		return 1;
	}

	/**
	 * Returns activation info for a certain key (an object with properties vkey, vmember, ...)
	 * (static)
	 *
	 * @author karma
	 */
	function getActivationInfo($key)
	{
		$query = 'SELECT * FROM ' . sql_table('activation') . ' WHERE vkey=\'' . addslashes($key). '\'';
		$res = sql_query($query);

		if (!$res || (mysql_num_rows($res) == 0))
			return 0;
		else
			return mysql_fetch_object($res);
	}

	/**
	 * Creates an account activation key
	 *
	 * @param $type one of the following values (determines what to do when activation expires)
	 *                'register' (new member registration)
	 *                'forgot' (forgotton password)
	 *                'addresschange' (member address has changed)
	 * @param $extra extra info (needed when validation link expires)
	 *				  addresschange -> old email address
	 * @author dekarma
	 */
	function generateActivationEntry($type, $extra = '')
	{
		// clean up old entries
		$this->cleanupActivationTable();

		// kill any existing entries for the current member (delete is ok)
		// (only one outstanding activation key can be present for a member)
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vmember=' . intval($this->getID()));

		$canLoginWhileActive = false; // indicates if the member can log in while the link is active
		switch ($type)
		{
			case 'forgot':
				$canLoginWhileActive = true;
				break;
			case 'register':
				break;
			case 'addresschange':
				$extra = $extra . '/' . ($this->canLogin() ? '1' : '0');
				break;
		}

		$ok = false;
		while (!$ok)
		{
			// generate a random key
			srand((double)microtime()*1000000);
			$key = md5(uniqid(rand(), true));

			// attempt to add entry in database
			// add in database as non-active
			$query = 'INSERT INTO ' . sql_table('activation'). ' (vkey, vtime, vmember, vtype, vextra) ';
			$query .= 'VALUES (\'' . addslashes($key). '\', \'' . date('Y-m-d H:i:s',time()) . '\', \'' . intval($this->getID()). '\', \'' . addslashes($type). '\', \'' . addslashes($extra). '\')';
			if (sql_query($query))
				$ok = true;
		}

		// mark member as not allowed to log in
		if (!$canLoginWhileActive)
		{
			$this->setCanLogin(0);
			$this->write();
		}

		// return the key
		return $key;
	}

	/**
	 * Inidicates that an activation link has been clicked and any forms displayed
	 * there have been successfully filled out.
	 * @author dekarma
	 */
	function activate($key)
	{
		// get activate info
		$info = MEMBER::getActivationInfo($key);

		// no active key
		if (!$info)
			return false;

		switch ($info->vtype)
		{
			case 'forgot':
				// nothing to do
				break;
			case 'register':
				// set canlogin value
				global $CONF;
				sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($CONF['NewMemberCanLogon']). ' WHERE mnumber=' . intval($info->vmember));
				break;
			case 'addresschange':
				// reset old 'canlogin' value
				list($oldEmail, $oldCanLogin) = explode('/', $info->vextra);
				sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($oldCanLogin). ' WHERE mnumber=' . intval($info->vmember));
				break;
		}

		// delete from activation table
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vkey=\'' . addslashes($key) . '\'');

		// success!
		return true;
	}

	/**
	 * Cleans up entries in the activation table. All entries older than 2 days are removed.
	 * (static)
	 *
	 * @author dekarma
	 */
	function cleanupActivationTable()
	{
		$boundary = time() - (60 * 60 * 24 * 2);

		// 1. walk over all entries, and see if special actions need to be performed
		$res = sql_query('SELECT * FROM ' . sql_table('activation') . ' WHERE vtime < \'' . date('Y-m-d H:i:s',$boundary) . '\'');

		while ($o = mysql_fetch_object($res))
		{
			switch ($o->vtype)
			{
				case 'register':
					// delete all information about this site member. registration is undone because there was
					// no timely activation
					include_once($DIR_LIBS . 'ADMIN.php');
					ADMIN::deleteOneMember(intval($o->vmember));
					break;
				case 'addresschange':
					// revert the e-mail address of the member back to old address
					list($oldEmail, $oldCanLogin) = explode('/', $o->vextra);
					sql_query('UPDATE ' . sql_table('member') . ' SET mcanlogin=' . intval($oldCanLogin). ', memail=\'' . addslashes($oldEmail). '\' WHERE mnumber=' . intval($o->vmember));
					break;
				case 'forgot':
					// delete the activation link and ignore. member can request a new password using the
					// forgot password link
					break;
			}
		}

		// 2. delete activation entries for real
		sql_query('DELETE FROM ' . sql_table('activation') . ' WHERE vtime < \'' . date('Y-m-d H:i:s',$boundary) . '\'');
	}

}

?>
