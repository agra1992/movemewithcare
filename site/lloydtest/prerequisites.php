<?php
function browser_detection( $which_test ) {

	// initialize the variables
	$browser = '';
	$dom_browser = '';

	// set to lower case to avoid errors, check to see if http_user_agent is set
	$navigator_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';

	// run through the main browser possibilities, assign them to the main $browser variable
	if (stristr($navigator_user_agent, "opera")) 
	{
		$browser = 'opera';
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "msie 4")) 
	{
		$browser = 'msie4'; 
		$dom_browser = false;
	}

	elseif (stristr($navigator_user_agent, "msie")) 
	{
		$browser = 'msie'; 
		$dom_browser = true;
	}

	elseif ((stristr($navigator_user_agent, "konqueror")) || (stristr($navigator_user_agent, "safari"))) 
	{
		$browser = 'safari'; 
		$dom_browser = true;
	}

	elseif (stristr($navigator_user_agent, "gecko")) 
	{
		$browser = 'mozilla';
		$dom_browser = true;
	}
	
	elseif (stristr($navigator_user_agent, "mozilla/4")) 
	{
		$browser = 'ns4';
		$dom_browser = false;
	}
	
	else 
	{
		$dom_browser = false;
		$browser = false;
	}

	// return the test result you want
	if ( $which_test == 'browser' )
	{
		return $browser;
	}
	elseif ( $which_test == 'dom' )
	{
		return $dom_browser;
		//  note: $dom_browser is a boolean value, true/false, so you can just test if
		// it's true or not.
	}
}


//$user_browser = browser_detection('browser');

if ( $user_browser == 'mozilla' )
{
?>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="#666666">
<p>This unique and interactive site has been designed for Internet Explorer 6.0 version ONLY. <br />
Other browser will experience navigation and user interface issues.<br />We highly recommend to use the Internet Explorer browser to fully experience the magic in MOvinguwithcare.com</p>
</font>

<?
die();
}

function CheckBrowser()
{
  $navigator_user_agent = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
  
  if (stristr($navigator_user_agent, "opera")) 
	{
		$browser = 'Opera';
	}

	elseif ((stristr($navigator_user_agent, "msie 4")) || (stristr($navigator_user_agent, "msie")))
	{
		$browser = 'IE'; 
	}

	elseif ((stristr($navigator_user_agent, "konqueror")) || (stristr($navigator_user_agent, "safari"))) 
	{
		$browser = 'Safari'; 

	}

	elseif (stristr($navigator_user_agent, "gecko")) 
	{
		$browser = 'Mozilla';
	}
	
	elseif (stristr($navigator_user_agent, "mozilla/4")) 
	{
		$browser = 'NS';
	}
	
  return $browser;
}
?>
