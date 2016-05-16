<?php
        session_start();
		
		error_reporting(0);

        session_unset("Member_Id");
        unset($Member_Id);
        	
        session_unset("Member_Login");
        unset($Member_Login);
		
		session_unset("Member_Pass");
        unset($Member_Pass);
		
		session_unset("Member_Email");
        unset($Member_Email);
		
		session_unset("Member_Name");
        unset($Member_Name);
		
		session_unset("Member_Contact");
        unset($Member_Contact);
		
		session_unset("Member_Phone");
        unset($Member_Phone);
        
		$Member_Id = "";
        $Member_Login = "";
		$Member_Pass = "";
        $Member_Email = "";
		$Member_Name = "";
        $Member_Contact = "";
		$Member_Phone = "";

        session_destroy();

        @header("Location: ../../index.php");
		exit;
?>