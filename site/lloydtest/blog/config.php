<?php

	// mySQL connection information
	$MYSQL_HOST = 'localhost';
	$MYSQL_USER = 'movemewi_movemew';
	$MYSQL_PASSWORD = 'withcare';
	$MYSQL_DATABASE = 'movemewi_proacemmwc';
	$MYSQL_PREFIX = '';

	// main nucleus directory
	$DIR_NUCLEUS = '/home/movemewi/public_html/blog/nucleus/';

	// path to media dir
	$DIR_MEDIA = '/home/movemewi/public_html/blog/media/';

	// extra skin files for imported skins
	$DIR_SKINS = '/home/movemewi/public_html/blog/skins/';

	// these dirs are normally sub dirs of the nucleus dir, but 
	// you can redefine them if you wish
	$DIR_PLUGINS = $DIR_NUCLEUS . 'plugins/';
	$DIR_LANG = $DIR_NUCLEUS . 'language/';
	$DIR_LIBS = $DIR_NUCLEUS . 'libs/';

	// include libs
	include($DIR_LIBS.'globalfunctions.php');
?>