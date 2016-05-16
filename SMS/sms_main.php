<?php
/***************************************************************************
 *                             sms_main.php
 *                            -------------------
 *   begin                : Sep 2006
 *   copyright          : (C) 2006 Simone Grassi, contain some lines from PHPBB2 /viewforum.php script
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

/***************************************************************************
	Written by Simone Grassi, (c) 2006 for EduTxt Project
	Trinity College Dublin, Computer Science Department, DSG Group.
	
	Works with MC35i Siemens GSM Box, following manual about GSM 07.05
	
	Condition: 
	
	i. the system must redirect the data from the serial COM_DEVICE to the file READ_FROM_COM_FILE
			es:  #cat /dev/ttyS0 > /tmp/from_ttyS0.txt
	ii. no other programs access the same device during the use by this script. Interference in the created
	    output created error in the interpretation by this script
	    
	iii. the GSM Box is mapped as a device file to COM_DEVICE (on linux box usually /dev/ttyS0)
	
	iv. READ_FROM_COM_FILE file is readable and writeable by php and/or apache
			
	How it Works:
	
	-> This script is supposed to be ran at regular timings (it internally check the last run, running this
		scripts two times simultaneously create an unpredictable output)
		
	Steps:
	1. The script open the device
	2. Sends set-up, including the activation of the Echo (needed to associate requests and replies)
	3. All the available SMS memory position are READ (AT+CMGR=#)
	4. The output is read from READ_FROM_COM_FILE
	5. The read messages are extracted one by one. 
		5a. If the message is not found in the EduTxt Database, is saved
		5b. The message is removed from the GSM Box (by position)
 ***************************************************************************/

// By default try to read from GSM BOX device and try to publish unpublished sms
$no_sms = false;
$publish_sms = true;
// Check parameters
$argv = $_SERVER['argv'];
$add_msg = '';
$output = true;
print "\nEduTxt SMS Gateway, (c) 2006, Simone Grassi, CS Department, DSG Group, Trinity College Dublin\n";
if (array_key_exists(1,$argv)) {
	switch ($argv[1]) {
		case 'no_device':$output = false;$no_sms = true;break;
		case 'device':$output = false;break;
		case 'only_device':$output = false;$publish_sms = false;break;
		default:$output = true;break;
	}
	$add_msg = "Unrecognized parameter '".$argv[1]."'\n run with no_device device or only_device\n";
}
if ($output) {
	print_v(((!strcmp($add_msg,''))?"At least one parameter needed\n":$add_msg).
		"run '".$argv[0]." no_device' to check in stored SMS, without accessing the device for new sms\n".
		"run '".$argv[0]." device' to check for new messages in the device first, then try to publish unpublished sms\n".
		"run '".$argv[0]." only_device' to check for new messages in the device only, without trying to publish sms\n");
	print_v("\n");
	exit();
}

// Decide if this script tries to publish sms after saving them to the DB
define('PUBLISH_TO_PHPBB',true);

// Must be the number of position in the default memory of your device (memory for SMS)
define('MAX_SMS_POSITION',5);
// Must be the device mapped on the serial port
define('COM_DEVICE','/dev/ttyS0');
// Must be a readable file for php/apache
define('READ_FROM_COM_FILE','/tmp/from_ttyS0.txt');
// Turn true/false if you want to delete or not readen messages (true recommended)
define('REMOVE_READ_MESSAGES',true);
// AT COMMAND prefix for reading the SMS in position #
define('READ_SMS_BY_POSITION','AT+CMGR=');

// --------- SECTION DEDICATED TO includes about phpBB2 Integration, just cut if not needed
define('IN_PHPBB', true);
define('VERBOSE',false);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'includes/bbcode.'.$phpEx);
include($phpbb_root_path . 'includes/functions_search.'.$phpEx);
// --------- INCLUDES FROM phpBB2 ends here

// SMS Software to Publish SMS as posts
include('sms_utils.php');
// SMS Gateway to the device are made by sms_read() and sms_remove() functions!

if (!$no_sms) {
	print_v("------------------------------");
	print_v("START SMS_READ date='".date('r'));
	
	// Read all messages!
	$read_sms = sms_read();
	$sms_to_remove = array();
	// Parse the result
	foreach ($read_sms as $k => $v) {
		print_v("WORK ON SMS '$k'");
		if ($read_sms[$k]['valid'] == 1) {
			
			// Try to Save!
			$sql = "SELECT * ".
				"FROM phpbb_received_sms ".
				" WHERE  sms_source = '".ereg_replace('"','',$read_sms[$k]['sms_source'])."'".
				" AND sms_datetime = '".mysql_escape_string(ereg_replace('"','',$read_sms[$k]['sms_datetime']))."'".
				" AND sms_text = '".mysql_escape_string(ereg_replace('$"','',ereg_replace('^"','',$read_sms[$k]['sms_text'])))."'";
			
			print_v("SEARCH for SMSs '$sql'");
			if (!$result = $db->sql_query($sql))
				die('Error Accessing the Database!\n');
			if (!($sms_found = $db->sql_fetchrow($result))) {
				// SMS not found!
				print_v("SMS $k not yet saved, try to add");
				// SMS not found, to add as not published
				$sql_ins = 'INSERT INTO phpbb_received_sms (sms_source,sms_datetime,sms_text) '.
					'VALUES (\''.ereg_replace('"','',$read_sms[$k]['sms_source']).'\',\''.
						ereg_replace('"','',$read_sms[$k]['sms_datetime']).'\',\''.
						mysql_escape_string(ereg_replace('$"','',ereg_replace('^"','',$read_sms[$k]['sms_text']))).'\')';
				if ( !($result = $db->sql_query($sql_ins)) ) {
					print_v("ERROR INSERT '$sql_ins'");
				} else {
					print_v("SMS $k saved, adding to the list of sms to remove");
					$sms_to_remove[] = $k;
				}
			} else {
				print_v("SMS $k Already saved, to remove");
				// SMS already saved, to remove from the GSM Box
				$sms_to_remove[] = $k;
			}
		}
	}
	// remove messages
	print_v('Must remove '.count($sms_to_remove).' messages');
	sms_remove($sms_to_remove);
	print_v("END SMS_READ date='".date('r')."'");
	print_v("------------------------------");
}

// Check if publish to phpbb feature is active
if (!PUBLISH_TO_PHPBB) 
	exit();

// Try to publish unpublished SMS
$sms_ob = new sms_utils(&$db);
// Retrieve all unpublished SMS (limit the amount)
$sql = "SELECT * FROM phpbb_received_sms WHERE published=0 ORDER BY sms_id DESC LIMIT 0,1000";
if (!$result = $db->sql_query($sql)) {
	if (VERBOSE)
		die('Error Accessing the Database, cannot try to Publish SMS!\n');
	else 
		die();
}
$pub = 0;
while ($sms_found = $db->sql_fetchrow($result)) {
	$pub++;
	print_v("FOUND ($pub)");
	print_v($sms_found);
	$where = $sms_ob->publish_sms($sms_found['sms_source'],$sms_found['sms_text'],'','update',$sms_found['sms_id']);
	if (!$where) {
		print_v("Failed to publish message");
	} else {
		print_v("MESSAGE Published ($where)");
		// Set as published
	}
	print_v($sms_ob->get_last_msg_format());
}
exit();

/**
 * Write commands to read all the available sms positions
 *
 * @return unknown
 */
function sms_read() {

	empty_file(READ_FROM_COM_FILE);

	// Rembember to disable any unsolicited message (like RING)!

	// Set-up device
	print_v("Set-up the Device");
	system('echo "AT+CNMI=0,1,0,2,1" > '.COM_DEVICE);
	print_v("AT+CNMI=0,1,0,2,1 Sent");
	sleep(1);
	system('echo "AT+CMGF=1" > '.COM_DEVICE);
	print_v("AT+CMGF=1 Sent");
	sleep(1);
	system('echo "ATE1" > '.COM_DEVICE);
	print_v("ATE1 Sent");
	sleep(3);

	// Read all received after commands

	print_v("START LOOP BETWEEN ALL ".MAX_SMS_POSITION." POSITIONS ");
	// Loop all available positions, read them and eventually delete them
	for ($sms_pos=MAX_SMS_POSITION;$sms_pos>0;$sms_pos--) {
		print_v('SEND COMMAND '.READ_SMS_BY_POSITION.$sms_pos);
		// Send command to read position $sms_post
		sleep(2);
		// Execute command to ask for $sms_pos message
		system('echo "AT+CMGR='.$sms_pos.'" > '.COM_DEVICE);
	}
	// Give time to get the output (tune for your system or delay need)
	sleep(3);
	// Read the all output, coming from the COM_DEVICE
	if (!$fread = fopen(READ_FROM_COM_FILE,'r')) {
		if (VERBOSE)
			die('Cannot open file to READ "'.READ_FROM_COM_FILE.'"');
		else 
			die();
	}
	while (!feof($fread))
		$read_txt[] = fgets($fread);
	fclose($fread);

	empty_file(READ_FROM_COM_FILE);

	// Walk through the array!
	define('READ_ECHO','AT+CMGR=');
	define('READ_OUTPUT','+CMGR:');
	define('SMS_STATUS_READ','REC READ');
	define('SMS_STATUS_UNREAD','REC UNREAD');
	define('SMS_STATUS_UNRECOGNIZED','_____');

	define('STATUS_NONE',0);
	define('STATUS_COMMAND_ECHO_FOUND',1);
	define('STATUS_COMMAND_REPLY_FOUND',2);

	if (is_array($read_txt) && count($read_txt)>0)
		// Something to check
		$end = false;
	else 
		$end = true;
	$index = 0;
	$status = STATUS_NONE;
	$sms_pos = 0;
	$sms_read_ok = array();
	while (!$end) {
		$line = ereg_replace(chr(10),'',$read_txt[$index]);
		//print "CHECK LINE '$index' that is :'".$line."'\n";
		switch ($status) {
			case STATUS_NONE:
				// Care only about to find command echo
				if (ereg("^AT\+CMGR=",$line)) {
					// Try to extract the sms position
					$nmatch = preg_match('/^AT\+CMGR=[0-9]+$/',$line,$subpattern);
					print_v("Found Echo, Line '$line'");
					if ($nmatch == 1) {
						// Grab sms position number
						$sms_pos = (int)(ereg_replace('AT\+CMGR=','',$line));
						print_v("Found echo position $sms_pos");
						if ($sms_pos<=0) {
							$sms_pos = 0;
						} elseif ($sms_pos>MAX_SMS_POSITION) {
							// Out of Range!
							$sms_pos = 0;
						} else {
							print_v("Change status to ECHO_FOUND");
							//Ok, change status
							$status = STATUS_COMMAND_ECHO_FOUND;
						}
						//print "($nmatch) LINE '$line'\n";
					}
					// Go on anyway!
					$index++;
					print_v();
				} else 
					// Not an Echo, go on!
					$index++;
				break;
			case STATUS_COMMAND_ECHO_FOUND:
				if (ereg("^\+CMS ERROR:",$line)) {
					// Found an Error! Reset the echo status
					$status = STATUS_NONE;
					$index++;
				} else {
					// Look for reply string
					if (ereg("^\+CMGR:",$line)) {
						print_v("found reply");
						// Grab SMS info!
						$sms_info_array = explode(',',$line);
						//print_r($sms_info_array);
						/*
							Array
							(
							    [0] => +CMGR: "REC READ"
							    [1] => "+353851571903"
							    [2] => 
							    [3] => "06/09/18
							    [4] => 11:32:22+04"
							)
						*/
						if (ereg(SMS_STATUS_READ,$sms_info_array[0])) {
							print_v( "MESSAGE READ!");
							$actual_sms_status = SMS_STATUS_READ;
						}
						elseif (ereg(SMS_STATUS_UNREAD,$sms_info_array[0])) {
							print_v("MESSAGE UNREAD");
							$actual_sms_status = SMS_STATUS_UNREAD;
						} else {
							print_v("MESSAGE UNRECOGNIZED");
							// Status not recognized, discart this reply!
							$actual_sms_status = SMS_STATUS_UNRECOGNIZED;
						}
						// Found reply, not change status, to collect data!
						$status = STATUS_COMMAND_REPLY_FOUND;
						$sms_read_ok[$sms_pos]['sms_source'] = $sms_info_array[1];
						$sms_read_ok[$sms_pos]['sms_datetime'] = $sms_info_array[3].' '.$sms_info_array[4];
						$found_sms_text = false;
						$sms_text = '';
						$index++;
					} else 
						// Not the result, go on!
						$index++;
				}
				break;
			case STATUS_COMMAND_REPLY_FOUND:
				if (ereg("^\+CMS ERROR:",$line)) {
					// Found an Error! Reset the echo status
					$status = STATUS_NONE;
					$index++;
				} else {
					if (ereg('^OK$',$line)) {
						print_v("OK MESSAGE FOUND!");
						if ($actual_sms_status==SMS_STATUS_UNRECOGNIZED) {
							$sms_read_ok[$sms_pos]['valid'] = false;
							print_v(" but To Discart cause is UNRECOGNIZED");
						} else {
							// End of reply!
							if ($found_sms_text=false)
								$sms_read_ok[$sms_pos]['sms_text'] = '';
							$sms_read_ok[$sms_pos]['valid'] = true;
							// Save SMS and delete $sms_pos from the GSM Box
							print_v("MESSAGE n.'$sms_pos' FOUND. From '".$sms_read_ok[$sms_post]['sms_source']."' At '".$sms_read_ok[$sms_post]['sms_datetime']."' TEXT '".$sms_read_ok[$sms_post]['sms_text']."'");
						}
						$index++;
						$status = STATUS_NONE;
					} elseif (strcmp('',$line)) {
						// Line not empty and not == 'OK', is the sms text!
						$sms_read_ok[$sms_pos]['sms_text'] = $line;
						$index++;
					} else 	
						// Empty line, to skip!
						$index++;
				}
				break;
			default:
				// not maches, go on!
				$index++;
				break;
		}
		if (count($read_txt)<$index)
			$end = true;
	}
	// Return the array of retrieved messages
	return $sms_read_ok;
}

/**
 * Remove the specified SMS from the GSM Box
 *
 * @param array $sms_stored_ok the elements are the position of SMS to remove
 */
function sms_remove($sms_to_remove) {
	// Eventually Delete stored messages
	for ($i=0;$i<count($sms_to_remove);$i++) {
		system('echo "AT+CMGD='.$sms_to_remove[$i].'" > '.COM_DEVICE);
		sleep(1);
		print_("Sent delete command 'AT+CMGD=".$sms_to_remove[$i]."' to device ".COM_DEVICE);
	}
}

function empty_file($file) {
	fopen($file,'w+');
}

function print_v($txt) {
	if (VERBOSE)
		print $txt."\n";
}
?>