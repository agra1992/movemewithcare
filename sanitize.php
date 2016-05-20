<?php

function sanitize($Expression,$Length,$TryHard) {

	if ($TryHard==0) {

		//$secure = addslashes($secure);

		$secure = utf8_decode($Expression);
		$secure = strip_tags($secure);
		$secure = htmlspecialchars($secure,ENT_NOQUOTES);
		$secure = strtr($secure, array('(' => '&#40;', ')' => '&#41;'));

		$secure = substr($secure,0,$Length);
		return $secure;

	} else {

		//$secure = addslashes($secure);

		$secure = utf8_decode($Expression);
		$secure = strip_tags($secure);
		$secure = htmlspecialchars($secure,ENT_NOQUOTES);
		$secure = strtr($secure, array('(' => '&#40;', ')' => '&#41;'));

		$secure = preg_replace('/[^a-z0-9]/i', '', $secure);

		$secure = substr($secure,0,$Length);

		return $secure;

	}


}



?>