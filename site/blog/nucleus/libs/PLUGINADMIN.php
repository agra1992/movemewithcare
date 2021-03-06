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
 * code to make it easier to create plugin admin areas
 *
 * @license http://nucleuscms.org/license.txt GNU General Public License
 * @copyright Copyright (C) 2002-2007 The Nucleus Group
 * @version $Id: PLUGINADMIN.php 1151 2007-05-19 23:38:50Z kaigreve $
 */

global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES, $HTTP_SESSION_VARS;
$aVarsToCheck = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_ENV_VARS', 'HTTP_SESSION_VARS', 'HTTP_POST_FILES', 'HTTP_SERVER_VARS', 'GLOBALS', 'argv', 'argc', '_GET', '_POST', '_COOKIE', '_ENV', '_SESSION', '_SERVER', '_FILES', 'DIR_LIBS');

foreach ($aVarsToCheck as $varName)
{
	if (phpversion() >= '4.1.0')
	{
		if (   isset($_GET[$varName])
			|| isset($_POST[$varName])
			|| isset($_COOKIE[$varName])
			|| isset($_ENV[$varName])
			|| isset($_SESSION[$varName])
			|| isset($_FILES[$varName])
		){
			die('Sorry. An error occurred.');
		}
	} else {
		if (   isset($HTTP_GET_VARS[$varName])
			|| isset($HTTP_POST_VARS[$varName])
			|| isset($HTTP_COOKIE_VARS[$varName])
			|| isset($HTTP_ENV_VARS[$varName])
			|| isset($HTTP_SESSION_VARS[$varName])
			|| isset($HTTP_POST_FILES[$varName])
		){
			die('Sorry. An error occurred.');
		}
	}
}

if (!isset($DIR_LIBS)) {
	die('Sorry.');
}

include($DIR_LIBS . 'ADMIN.php');

class PluginAdmin {

	var $strFullName;		// NP_SomeThing
	var $plugin;			// ref. to plugin object
	var $bValid;			// evaluates to true when object is considered valid
	var $admin;				// ref to an admin object

	function PluginAdmin($pluginName)
	{
		global $manager;

		$this->strFullName = 'NP_' . $pluginName;

		// check if plugin exists and is installed
		if (!$manager->pluginInstalled($this->strFullName))
			doError('Invalid plugin');

		$this->plugin =& $manager->getPlugin($this->strFullName);
		$this->bValid = $this->plugin;

		if (!$this->bValid)
			doError('Invalid plugin');

		$this->admin = new ADMIN();
		$this->admin->action = 'plugin_' . $pluginName;
	}

	function start($extraHead = '')
	{
		global $CONF;
		$strBaseHref  = '<base href="' . htmlspecialchars($CONF['AdminURL']) . '" />';
		$extraHead .= $strBaseHref;

		$this->admin->pagehead($extraHead);
	}

	function end()
	{
		$this->_AddTicketByJS();
		$this->admin->pagefoot();
	}

/** 
 * Add ticket when not used in plugin's admin page
 * to avoid CSRF.
 */
	function _AddTicketByJS(){
		global $CONF,$ticketforplugin;
		if (!($ticket=$ticketforplugin['ticket'])) {
			//echo "\n<!--TicketForPlugin skipped-->\n";
			return;
		}
		$ticket=htmlspecialchars($ticket,ENT_QUOTES);
 
?><script type="text/javascript">
/*<![CDATA[*/
/* Add tickets for available links (outside blog excluded) */
for (i=0;document.links[i];i++){
  if (document.links[i].href.indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
    && !(document.links[i].href.indexOf('//',0)<0)) continue;
  if ((j=document.links[i].href.indexOf('?',0))<0) continue;
  if (document.links[i].href.indexOf('ticket=',j)>=0) continue;
  document.links[i].href=document.links[i].href.substring(0,j+1)+'ticket=<?php echo $ticket; ?>&'+document.links[i].href.substring(j+1);
}
/* Add tickets for forms (outside blog excluded) */
for (i=0;document.forms[i];i++){
  /* check if ticket is already used */
  for (j=0;document.forms[i].elements[j];j++) {
    if (document.forms[i].elements[j].name=='ticket') {
      j=-1;
      break;
    }
  }
  if (j==-1) continue;
 
  /* check if the modification works */
  try{document.forms[i].innerHTML+='';}catch(e){
    /* Modificaion falied: this sometime happens on IE */
    if (!document.forms[i].action.name && document.forms[i].method.toUpperCase()=="POST") {
      /* <input name="action"/> is not used for POST method*/
      if (document.forms[i].action.indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
        && !(document.forms[i].action.indexOf('//',0)<0)) continue;
      if (0<(j=document.forms[i].action.indexOf('?',0))) if (0<document.forms[i].action.indexOf('ticket=',j)) continue;
      if (j<0) document.forms[i].action+='?'+'ticket=<?php echo $ticket; ?>';
      else document.forms[i].action+='&'+'ticket=<?php echo $ticket; ?>';
      continue;
    }
    document.write('<p><b>Error occured druing automatic addition of tickets.</b></p>');
    j=document.forms[i].outerHTML;
    while (j!=j.replace('<','&lt;')) j=j.replace('<','&lt;');
    document.write('<p>'+j+'</p>');
    continue;
  }
  /* check the action paramer in form tag */
  /* note that <input name="action"/> may be used here */
  j=document.forms[i].innerHTML;
  document.forms[i].innerHTML='';
  if ((document.forms[i].action+'').indexOf('<?php echo $CONF['PluginURL']; ?>',0)<0
      && !((document.forms[i].action+'').indexOf('//',0)<0)) {
    document.forms[i].innerHTML=j;
    continue;
  }
  /* add ticket */
  document.forms[i].innerHTML=j+'<input type="hidden" name="ticket" value="<?php echo $ticket; ?>"/>';
}
/*]]>*/
</script><?php
 
	}
}



?>