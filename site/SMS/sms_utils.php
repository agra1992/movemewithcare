<?php
// Print out work in progress, usefull for command line use!
define('VERBOSE',true);
/***************************************************************************
 *                                sms_utils.php
 *                            -------------------
 *   begin                : Mar 2006
 *   copyright            : (C) 2006 Simone Grassi (for Trinity College Dublin, CS Dep, DSG Group)
 *   email                : simonegrassi@gmail.com
 *
 *
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/**
 * Simply a set of static tools
 * to work on SMS issues
 */
class sms_utils {

	// Db access
	var $db;
	// Last message
	var $last_msg = array();

	/**
	 * Just receive db connection instance reference
	 *
	 * @param unknown_type $db
	 * @return sms_utils
	 */
	function sms_utils(&$db) {
		$this->db = $db;
	}
	/**
	 * Return a string of the same lenght of $number, hiding the last $leave_N numbers with #
	 * I know passing $db reference everywhere is quiet bad, but introducing patterns like singleton
	 * in phpbb2 structure would make it half-way!
	 *
	 * @param string $number	String to work on
	 * @param int $leave_n		Number of digits to leave readable at the end of number
	 * @return string			String with first N elements hidden
	 */
	function hide_first_digits($number,$leave_n) {
		$max_string = '########################################';
		if (strlen($number)>strlen($max_string))
			$number = substr($number,1,strlen($max_string));
		if ($leave_n<0)
			$leave_n = 0;
		$hide_n = strlen($number)-$leave_n;
		if ($hide_n==0)
			return substr($max_string,1,strlen($number));
			// Return initial ###Êthen the last part of the number
		return substr($max_string,1,$hide_n).substr($number,($hide_n),(strlen($number)-$hide_n));
	}

	/**
	 * Given an SMS source number, find out an associated user
	 *
	 * @param string $sms_number
	 * @return int user_id if a user found, false otherwise
	 */
	function search_user_by_sms($sms_number) {
		$sql = "SELECT * 
			FROM " . USERS_TABLE . "
			WHERE user_sms='$sms_number'";
		if ( !($result = $this->db->sql_query($sql)) )
		{
			return false;
		}

		$matching_user = array();
		if ( $row = $this->db->sql_fetchrow($result) )
		{
			return $row;
		}
		return false;
	}
	
	/**
	 * Store received SMS in a common table with publishment info
	 *
	 * @param string $source_sms_number
	 * @param string $text
	 * @param string $date Y-m-d
	 * @param array $sms_published_data info about forum_id, user_id, post_id, topic_id
	 * @param bool $published true if has been published, false otherwise
	 * @return boolean true on success false otherwise
	 */
	function save_sms($source_sms_number,$text,$time,$sms_published_data,$published,$post_permission=false) {
		if (!strcmp($time,''))
			$date = time();		
		// Create the insert statement
		$sql = 'INSERT INTO '.RECEIVED_SMS_TABLE.' (sms_source,sms_text,sms_datetime,user_id,forum_id,topic_id,post_id,post_permission,published)'.
					" VALUES ('$source_sms_number','".mysql_escape_string($text)."','$time','".$sms_published_data['user_id']."','".$sms_published_data['forum_id']."','".$sms_published_data['topic_id']."','".$sms_published_data['post_id']."','".($post_permission?'1':'0')."','".$published."')";

		if ( !($result = $this->db->sql_query($sql)) )
			return false;
		return true;
	}
	
	
	function reset_last_msg() {
		$this->last_msg = array();
	}
	
	function get_last_msg() {
		return $this->last_msg;
	}
	
	function get_last_msg_format($separator='<br/>') {
		$count = count($this->last_msg);
		$unique_string = '';
		for ($i=0;$i<$count;$i++)
			$unique_string = $this->last_msg[$i].$separator;
		return $unique_string;
	}
	
	function push_msg($string) {
		$this->last_msg[] = $string;
	}
	
	
	/**
	 * Received an SMS decide where to publish it
	 * 
	 * Policy:
	 * 	- Look for forum ID and publish there only if user is allowed
	 *  - Look for forum name and publish there only if user is allowed
	 * 			title match first 2 word of SMS and user is allowed
	 * 	- Look for user default forum
	 * 	- Look for default forum by user and date
	 * 	- Save SMS in received messages
	 *
	 * @param string $source_sms_number
	 * @param string $text
	 * @param string $ip
	 * @param string $save_or_update if 'save' save the SMS at the end, if 'update' update it using update_id as ID
	 * @param int $update_id id to use to update the sms in the db
	 * 
	 * @return boolean true on success, 0 if saved but not published, <0 on error
	 */
	function publish_sms($source_sms_number,$text,$user_ip,$save_or_update='save',$update_id='',$reset=true) {
		// Try to publish an SMS, directly colled by sms gateway or other sources of messages
		$forum_id = false;
		$new_text = '';
		if ($reset)
			$this->reset_last_msg();
		// Recognize $number associating it to an user
		if ($user_data = $this->search_user_by_sms($source_sms_number)) {
			// Find out destination forum
			if (!$forum_id = $this->get_forum_by_title_id($text,FORUM_NAME_ID_PREFIX,&$new_text)) {
				if (!$forum_id = $this->get_forum_by_name($text,&$new_text)) {
					// Check user default group
					if (!strcmp($user_data['user_sms_default_forum_id'],'') || !strcmp($user_data['user_sms_default_forum_id'],'0')) {
						if (!$forum_id = $this->get_default_user_group_forum($user_data['user_id'])) {
							// No way to find out a forum!
							$this->push_msg('No way to find a forum by any policy, for user_id "'.$user_data['user_id'].'"');
							print_("USER_ID '".$user_data['user_id']."");
						} else {
							 $this->push_msg("Message published by user group forum, with forum_id '$forum_id'");
							 print_("FORUM_ID '$forum_id'");
						}
					} else {
						// Save forum_id
						$forum_id = $user_data['user_sms_default_forum_id'];
						$this->push_msg("Message published on User default forum with forum_id '$forum_id'");
						print_("userdata '".$user_data['default_forum_id']."'");
					}
				} else {
					$this->push_msg("Message publised on Forum by Name, forum_id '$forum_id'");
					// Use epured text, without words used to identify the forum
					$text = $new_text;
					print_("get_forum_by_name ok! ($forum_id)");
				}
			} else {
				$this->push_msg("Message publised on Forum by Title id, forum_id '$forum_id'");
				$text = $new_text;
				print_("get_forum_by_title_id ok!");
			}
		} else {
			$this->push_msg("Cannot find user associated with source mobile '$source_sms_number'");
			 print_("CANNOT FIND USER! (sms is $source_sms_number)");
		}
		$published = false;
		$post_permission = false;
		// Default values
		$sms_published_data = array('forum_id'=>0,'post_id'=>0,'topic_id'=>0,'user_id'=>0);
		if ($forum_id) {
			// Get auth info
			$is_auth = array();
			// Retrieve all info about permissions for forum_id
			$is_auth = auth(AUTH_ALL,$forum_id,$user_data,'');
/*
if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] )
{
	if ( !$userdata['session_logged_in'] )
	{
		$redirect = POST_FORUM_URL . "=$forum_id" . ( ( isset($start) ) ? "&start=$start" : '' );
		redirect(append_sid("login.$phpEx?redirect=viewforum.$phpEx&$redirect", true));
	}
	//
	// The user is not authed to read this forum ...
	//
	$message = ( !$is_auth['auth_view'] ) ? $lang['Forum_not_exist'] : sprintf($lang['Sorry_auth_read'], $is_auth['auth_read_type']);

	message_die(GENERAL_MESSAGE, $message);
}
*/
			// Try to publish the message if the user has permission to post
			if ($is_auth['auth_post']) {
				$post_permission = true;
				$published = $this->publish_on_forum($forum_id,$text,$source_sms_number,$user_data['user_id'],$user_data['username'],$user_ip,&$sms_published_data);
			} else {
				print_("USER HAS NO PERMISSION TO POST\n");
			}

		}
		print "ALORA ($save_or_update)\n";
		// In any case save the informations about the SMS, if requested
		switch ($save_or_update) {
			case 'save':
				sms_utils::save_sms($source_sms_number,$text,time(),$sms_published_data,$published,$post_permission);
				break;
			case 'update':
				print "UPDATE\n";
				if ($published) {
					$sql = 'UPDATE phpbb_received_sms '.
						" SET user_id='".$user_data['user_id']."', ".
						" forum_id='".$forum_id."', ".
						" post_id='".$forum_id."', ".
						" topic_id='".$forum_id."', ".
						" published='1' ".
						" WHERE sms_id='".$update_id."';";
					print "Updating the SMS entry '$sql'\n";
					$result = $this->db->sql_query($sql);
				}break;
			default:break;
		}
		return $published;
	}
	
	/**
	 * Publish the received SMS on forum_id
	 *
	 * @param int $forum_id must be already verified the existence
	 * @param string $text
	 * @param string $source_sms_number
	 * @return boolean true on success, <0 otherwise
	 */
	function publish_on_forum($forum_id,$text,$source_sms_number,$user_id,$username,$user_ip,&$publish_info) {
		// An SMS in now only inserted as a "new topic"
		// forum_id: new entry
		$topic_title = SUBJECT_PREFIX_VALUE.substr($text,0,SUBJECT_SMS_LENGHT);
		// user_id of the poster
		$topic_poster = $user_id;
		$topic_time = time();
		// $topic_views : default
		
		$topic_status = TOPIC_UNLOCKED;
		$topic_type = POST_NORMAL;
		// $topic_vote : default
		
		$mode = 'newtopic';
		$post_data = $text;
		// For first insert a record in topic table
		$sql = "INSERT INTO " . TOPICS_TABLE . " (topic_title, topic_poster, topic_time, forum_id, topic_status, topic_type) VALUES ('$topic_title','$topic_poster','$topic_time',$forum_id,$topic_status,$topic_type)";
		if (!$this->db->sql_query($sql)) {
			// Error trying to insert a new entry
			$this->push_msg("Error trying to insert a new Topic '$sql'");
			return false;
		}
		$topic_id = $this->db->sql_nextid();
		// enable_bbcode, enable_html, enable_smilies, enable_sig: default
		// Now prepare to insert record in post table
		$sql = "INSERT INTO " . POSTS_TABLE . " (topic_id, forum_id, poster_id, post_username, post_time, poster_ip,by_sms) VALUES ($topic_id, $forum_id, " . $user_id . ", '$username', $topic_time, '$user_ip','$source_sms_number')";
		if (!$this->db->sql_query($sql, BEGIN_TRANSACTION)) {
			$this->push_msg("Error trying to insert a new post '$sql'");
			return false;
		}
		$post_id = $this->db->sql_nextid();
		// Now insert the text in the relative table
		$sql = "INSERT INTO " . POSTS_TEXT_TABLE . " (post_id, post_subject, bbcode_uid, post_text) VALUES ($post_id,'".SUBJECT_PREFIX_VALUE."','".make_bbcode_uid()."','".mysql_escape_string($text)."')";
		//print "SQL '$sql'<br>";
		if (!$this->db->sql_query($sql)) {
			$this->push_msg("Error inserting post text '$sql'");
			return false;
		}
		// Now we know post_id, update TOPICS_TABLE record
		$sql = 'UPDATE '.TOPICS_TABLE.
				" SET topic_first_post_id='$post_id',topic_last_post_id='$post_id' ".
				" WHERE topic_id='$topic_id'";
		if (!$this->db->sql_query($sql)) {
			$this->push_msg("Error updating topics table '$sql'");
			return false;			
		}	
		add_search_words('single',$post_id,stripslashes($text), stripslashes(SUBJECT_PREFIX_VALUE));
		// Update Forum Posts number
		$sql = 'UPDATE '.FORUMS_TABLE.
				' SET forum_posts = forum_posts+1,'.
				" forum_last_post_id='$post_id',".
				' forum_topics=forum_topics+1 '.
				" WHERE forum_id=$forum_id";
		if (!$this->db->sql_query($sql)) {
			$this->push_msg("Error updating forum table '$sql'");
			return false;
		}
		$sql = 'UPDATE '.USERS_TABLE.
				' SET user_posts = user_posts+1 '.
				" WHERE user_id=$user_id";
		if (!$this->db->sql_query($sql)) {
			$this->push_msg("Error updating user table '$sql'");
			return false;
		}
		// Published, save relative info
		$publish_info['user_id'] = $user_id;
		$publish_info['topic_id'] = $topic_id;
		$publish_info['forum_id'] = $forum_id;
		$publish_info['post_id'] = $post_id;
		return true;
	}

	/**
	 * Look for a forum with title starting with the proper string: $tag:ID
	 * return forum's database id if found
	 *
	 * @param string $text
	 * @param string $tag
	 * @param string $epured_text, return the text without the title id
	 * @return int forum id if founds, 0 otherwise
	 */
	function get_forum_by_title_id($text,$tag,&$epured_text) {
		$epured_text = $text;
		// Is text starting with the specified $tag
		preg_match('/^[1-9][0-9]* /',$text,&$matches);
		if (is_array($matches) && strcmp($matches[0],'')) {
			// Assign new text, removing the first part needed to identify the forum
			$epured_text = ereg_replace($matches[0].' ','',$text);
			// Look for an INTEGER at the beginning, it would be the forum id
			preg_match('/^[1-9][0-9]* /',$text,&$matches);
			$look_for = $matches[0];
			// Retrieve forums titles
			$sql = "SELECT forum_id,forum_name
						FROM " . FORUMS_TABLE . "";
			// ADD selection for authorized forums relative to current user:
			//					WHERE user_mobile_number='$sms_number'";
			if ($result = $this->db->sql_query($sql))
				while ( $row = $this->db->sql_fetchrow($result) ) {
					// Look for $tag!  tag: + arbitrary int tag:[0-9]+
					preg_match('/'.$tag.':'.$look_for.'/',$row['forum_name'],&$matches);
					if (is_array($matches) && strcmp($matches[0],'')) {
						// Return forum ID
						return $row['forum_id'];				
					}
				}
				$this->push_msg("Cannot publish by forum title id, cannot find any forum title beginning with '$tag:$look_for'");
		} else
			$this->push_msg("Cannot get forum by title id, cannot find an int at the beginning of text '$text'");
		// no matches
		return false;
	}

	/**
	 * Find out a forum with title containing the first 2 string found in the $text
	 *
	 * @param unknown_type $text
	 * @param unknown_type $epured_text
	 * @return unknown
	 */
	function get_forum_by_name($text,&$epured_text) {
		// Extract first 2 words of text long at least 3 char each
		preg_match('/^[a-z|A-Z|0-9][a-z|A-Z|0-9][a-z|A-Z|0-9]+ [a-z|A-Z|0-9][a-z|A-Z|0-9][a-z|A-Z|0-9]+/',$text,&$matches);
		$epured_text = $text;
		if (is_array($matches) && strcmp($matches[0],'')) {
			$epured_text = ereg_replace($matches[0].' '.$matches[1],'',$text);
			// Match! Explode words
			$words_ar = explode(' ',$matches[0]);
			// Look in forums names
			$sql = 'SELECT forum_id,forum_name
						FROM ' . FORUMS_TABLE . '';
			// ADD selection for authorized forums relative to current user:
			//					WHERE user_mobile_number='$sms_number'";
			if ($result = $this->db->sql_query($sql))
				while ( $row = $this->db->sql_fetchrow($result) ) {
					// Must find both words
					if (eregi($words_ar[0],$row['forum_name']) && eregi($words_ar[1],$row['forum_name'])) {
						// Match ok, return forum ID
						return $row['forum_id'];				
					}
				}
		}
	}

	/**
	 * Retrieve default group forum, for the user $user_id
	 *
	 * @param int $user_id
	 * @return int default forum_id or 0 if not found
	 */
	function get_default_user_group_forum($user_id) {
		$sql = 'SELECT g.default_forum_id
				FROM '.USER_GROUP_TABLE. ' ug,'.GROUPS_TABLE.' g 
				WHERE ug.group_id = g.group_id 
				AND g.default_forum_id != 0 
				AND ug.user_id=\''.$user_id.'\'';
		$forum_id = false;
		if ($result = $this->db->sql_query($sql)) {
			while ($row = $this->db->sql_fetchrow($result)) {
				// What about a user assigned to many groups?
				// Now we do not care, we return the last association
				// FIXME: a user<->group association date should be added to be sure to
				// retrieve the last valid association
				$forum_id = $row['default_forum_id'];
			}
		}
		return $forum_id;
	}
	
	
	function extractForumID($text) {
		
	}
	
	function retrieveDefaultForumID($userId) {
		
	}
	
	function postTopicInForum($forumId,$topicHead,$topicBody) {
		
	}
	
	function postReplyInTopic($postId,$replyHead,$replyBody) {
		
	}
}

function print_($txt) {
	if (VERBOSE)
		print $txt."<br/>\n";
}
?>