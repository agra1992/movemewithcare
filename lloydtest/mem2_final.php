<?php
set_time_limit(60*60*60);
error_reporting(0);
require_once "mailer.php";
require_once "top_panel.php";
require("config.inc.php");
require_once ('seo.php');
require("sanitize.php");
include "mem2js.php";



function send_sms($message)
{

    $sms_query= "SELECT Phone from sms_admins Where 1";
    $sms_r=mysql_query($sms_query);
    while($sms_result = mysql_fetch_assoc($sms_r))
    {
        $phone = $sms_result[Phone];
        send_mail ($phone, $phone, $phone, "new member", $message);
        $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$phone', '$phone', 'sms_new member', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
    }
}


?>
<style type="text/css">
<!--
.button
{
    BORDER-RIGHT: 1px solid;
    PADDING-RIGHT: 2px;
    BORDER-TOP: 1px solid;
    PADDING-LEFT: 4px;
    FONT-WEIGHT: bold;
    FONT-SIZE: 10px;
    PADDING-BOTTOM: 2px;
    BORDER-LEFT: 1px solid;
    COLOR: #ffffff;
    PADDING-TOP: 3px;
    BORDER-BOTTOM: 1px solid;
    FONT-FAMILY: Verdana, Arial, Helvetica;
    HEIGHT: 22px;
    BACKGROUND-COLOR: #0080C0
}
.lists{
    FONT-SIZE: 11px;
}
-->
</style>

<script type="text/javascript" src="cal.js"></script>
<script language="javascript" type="text/javascript">



function validate_lupu(MUWCForm)
{
    var errorMsg = "";	

        //alert(MUWCForm.sms_company.selectedIndex);

        //return false;
    
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";

	}
	if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false) {
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
 
	if (MUWCForm.login.value.trim() == ""){
		errorMsg += "\n\Login \t\t\t- Please provide your Login.";
	}
	if (MUWCForm.pass.value.trim() == ""){
		errorMsg += "\n\Password \t\t- Please provide your Password.";
	}

        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}

	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
		errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}
	if (MUWCForm.state.selectedIndex == 0){
		errorMsg += "\n\Service State \t\t- Please specify the Service State.";
	}

	if (MUWCForm.sms_service1.checked){
	    if (MUWCForm.sms_phone.value == ""){
		errorMsg += "\n\SMS Phone \t\t- Please specify the phone you would like to use for text messaging service.";}
	    if (isInteger(MUWCForm.sms_phone.value,10) != true){
		errorMsg += "\n\SMS Phone \t\t- Your text messaging service phone must be 10 digits long.";}
	    if (MUWCForm.sms_company.selectedIndex == 0 || MUWCForm.sms_company.selectedIndex == -1){
		errorMsg += "\n\SMS Company \t\t- Please specify the company of you phone for text messaging service.";}
	}



	
	// added by tj
	if (MUWCForm.association.selectedIndex == -1){
		errorMsg += "\n\Association \t\t- Please specify your association.";
	}

	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}

function validate_fullservice(MUWCForm)
{
    var errorMsg = "";	
    
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";
	}
	if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
	if (MUWCForm.login.value.trim() == ""){
		errorMsg += "\n\Login \t\t\t- Please provide your Login.";
	}
	if (MUWCForm.pass.value.trim() == ""){
		errorMsg += "\n\Password \t\t- Please provide your Password.";
	}

        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}
	if (MUWCForm.m_state.selectedIndex == 0)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	
	if (MUWCForm.description.value.trim()==""){
		errorMsg += "\n\Description \t\t- Please provide your Description.";
	}
	if (MUWCForm.radio1.checked)
	{
		if ((MUWCForm.license.value.trim() == "" || MUWCForm.license1.value.trim() == "" )&& (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value<52 || MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value==997))
		{
			errorMsg += "\n\License \t\t\t- Please provide License Information.";
		}		
		if (MUWCForm.state.selectedIndex == 0)
		{
			errorMsg += "\n\Service State \t\t\t- Please select your service state.";
		}
		if (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value>52 && (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value !=997 && MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value!=999) && MUWCForm.license2.value.trim()=="")
		{
			errorMsg += "\n\License \t\t\t-You should provide Canadian interprovince license to select Canadian province.";
		}
	}

	else
        {
            if(MUWCForm.state.options[MUWCForm.state.selectedIndex].value !=MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value)
            {
			errorMsg += "\n\State \t\t- Your service and Member state must be the same if you don't have an interstate license.";
            }
        }
	if (MUWCForm.sms_service1.checked){
	    if (MUWCForm.sms_phone.value == ""){
		errorMsg += "\n\SMS Phone \t\t- Please specify the phone you would like to use for text messaging service.";}
	    if (isInteger(MUWCForm.sms_phone.value,10) != true){
		errorMsg += "\n\SMS Phone \t\t- Your text messaging service phone must be 10 digits long.";}
	    if (MUWCForm.sms_company.selectedIndex == 0 || MUWCForm.sms_company.selectedIndex == -1){
		errorMsg += "\n\SMS Company \t\t- Please specify the company of you phone for text messaging service.";}
	}
	if (MUWCForm.association.selectedIndex == -1){
		errorMsg += "\n\Association \t\t- Please specify your association.";
	}
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}

function validate_transport(MUWCForm)
{
    var errorMsg = "";	
    
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";
	}
	if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
	        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}	
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	
	if (MUWCForm.m_state.selectedIndex == 0)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.description.value.trim()==""){
		errorMsg += "\n\Description \t\t- Please provide your Description.";
	}	
		if (MUWCForm.radio1.checked)
	{
		if ((MUWCForm.license.value.trim() == "" || MUWCForm.license1.value.trim() == "" )&& (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value<52 || MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value==997))
		{
			errorMsg += "\n\License \t\t\t- Please provide License Information.";
		}		
		if (MUWCForm.state.selectedIndex == 0)
		{
			errorMsg += "\n\Service State \t\t\t- Please select your service state.";
		}
		if (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value>52 && (MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value !=997 && MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value!=999) && MUWCForm.license2.value.trim()=="")
		{
			errorMsg += "\n\License \t\t\t-You should provide Canadian interprovince license to select Canadian province.";
		}
	}

	else
        {
            if(MUWCForm.state.options[MUWCForm.state.selectedIndex].value !=MUWCForm.m_state.options[MUWCForm.m_state.selectedIndex].value)
            {
			errorMsg += "\n\State \t\t- Your service and Member state must be the same if you don't have an interstate license.";
            }
        }
	if (MUWCForm.sms_service1.checked){
	    if (MUWCForm.sms_phone.value == ""){
		errorMsg += "\n\SMS Phone \t\t- Please specify the phone you would like to use for text messaging service.";}
	    if (isInteger(MUWCForm.sms_phone.value,10) != true){
		errorMsg += "\n\SMS Phone \t\t- Your text messaging service phone must be 10 digits long.";}
	    if (MUWCForm.sms_company.selectedIndex == 0 || MUWCForm.sms_company.selectedIndex == -1){
		errorMsg += "\n\SMS Company \t\t- Please specify the company of you phone for text messaging service.";}
	}
	if (MUWCForm.association.selectedIndex == -1){
		errorMsg += "\n\Association \t\t- Please specify your association.";
	}
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}

function validate_packingstorage(MUWCForm)
{
    var errorMsg = "";	
    
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";
	}
	if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}	
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	
	if (MUWCForm.m_state.selectedIndex == 0)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.description.value.trim()==""){
		errorMsg += "\n\Description \t\t- Please provide your Description.";
	}
	if (MUWCForm.state.selectedIndex == 0)
	{
		errorMsg += "\n\Service State \t\t\t- Please select your service state.";
	}
	if (MUWCForm.sms_service1.checked){
	    if (MUWCForm.sms_phone.value == ""){
		errorMsg += "\n\SMS Phone \t\t- Please specify the phone you would like to use for text messaging service.";}
	    if (isInteger(MUWCForm.sms_phone.value,10) != true){
		errorMsg += "\n\SMS Phone \t\t- Your text messaging service phone must be 10 digits long.";}
	    if (MUWCForm.sms_company.selectedIndex == 0 || MUWCForm.sms_company.selectedIndex == -1){
		errorMsg += "\n\SMS Company \t\t- Please specify the company of you phone for text messaging service.";}
	}
	if (MUWCForm.association.selectedIndex == -1){
		errorMsg += "\n\Association \t\t- Please specify your association.";
	}
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}

function validate_market(MUWCForm)
{
     var errorMsg = "";	
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";
	}
if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}
	if (MUWCForm.login.value.trim() == ""){
		errorMsg += "\n\Login \t\t\t- Please provide your Login.";
	}
	if (MUWCForm.pass.value.trim() == ""){
		errorMsg += "\n\Password \t\t- Please provide your Password.";
	}
        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}
	if (MUWCForm.state.selectedIndex == 0)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	
	if (MUWCForm.description.value.trim()==""){
		errorMsg += "\n\Description \t\t- Please provide your Description.";
	}

        if (MUWCForm.market_type.selectedIndex == 0)
	{
		errorMsg += "\n\Service Type \t\t\t- Please provide your type of service.";
        }
	if (MUWCForm.sms_service1.checked){
	    if (MUWCForm.sms_phone.value == ""){
		errorMsg += "\n\SMS Phone \t\t- Please specify the phone you would like to use for text messaging service.";}
	    if (isInteger(MUWCForm.sms_phone.value,10) != true){
		errorMsg += "\n\SMS Phone \t\t- Your text messaging service phone must be 10 digits long.";}
	    if (MUWCForm.sms_company.selectedIndex == 0 || MUWCForm.sms_company.selectedIndex == -1){
		errorMsg += "\n\SMS Company \t\t- Please specify the company of you phone for text messaging service.";}
	}
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}
function validate_deadhaul(MUWCForm)
{
    var errorMsg = "";	
    
	if (MUWCForm.name.value.trim() == ""){
		errorMsg += "\n\Full name of company \t- Please provide your Full name of company.";
	}
	if (MUWCForm.person.value.trim() == ""){
		errorMsg += "\n\Contact Person \t\t- Please provide your Contact Person.";
	}
	if (MUWCForm.email.value.trim()== ""){
		errorMsg += "\n\Email Address \t\t- Please provide your Email Address.";
	}
	else if(echeck(MUWCForm.email.value.trim()) == false)
	{
		errorMsg += "\n\Email Address \t\t- Invalid Email Address.";
	}
	if (MUWCForm.phone_one.value.trim() == "" ||MUWCForm.phone_two.value.trim() == "" || MUWCForm.phone_three.value.trim() == ""){
		errorMsg += "\n\Phone Number \t\t- Please provide your Phone Number.";
	}	
	else if (isInteger(MUWCForm.phone_one.value, 3) == false || isInteger(MUWCForm.phone_two.value, 3) == false || isInteger(MUWCForm.phone_three.value, 4) == false){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Phone Number.";
	}
	else if (MUWCForm.phone_four.value.trim() != "" && isInteger(MUWCForm.phone_four.value, 2) != true && isInteger(MUWCForm.phone_four.value, 3) != true && isInteger(MUWCForm.phone_four.value, 4) != true && isInteger(MUWCForm.phone_four.value, 5) != true ){
		errorMsg += "\n\Phone Number \t\t- Phone extension must be 0 or 2-5 numbers.";
	}

	        if (isInteger(MUWCForm.fax.value, 10) == false && MUWCForm.fax.value.trim() != ""){
		errorMsg += "\n\Phone Number \t\t- Please provide 10 digits of your Fax Number.";
	}

        if (isInteger(MUWCForm.tollfree.value, 11) == false && MUWCForm.tollfree.value.trim() != ""){
		errorMsg += "\n\Toll-free Number \t\t- Please provide 11 digits of Toll-free Number.";
	}
	if (MUWCForm.address.value.trim()==""){
		errorMsg += "\n\Address \t\t\t- Please provide your Address.";
	}
	if (MUWCForm.state.selectedIndex == 0)
	{
		errorMsg += "\n\State \t\t\t- Please select your state.";
	}
	if (MUWCForm.zipcode.value.trim()==""){
		errorMsg += "\n\Zip Code \t\t\t- Please provide your Zip Code.";
	}
	else if (validateZIP(MUWCForm.zipcode.value) == false){
			errorMsg += "\n\Zip Code \t\t\t- Invalid Zip Code.";
	}	

	if (MUWCForm.radio1.checked)
	{
		if (MUWCForm.license.value.trim() == "" && MUWCForm.license2.value.trim() == "")
		{
			errorMsg += "\n\License \t\t\t- Please provide License Information.";
		}		


	}
	
	if (MUWCForm.association.selectedIndex == -1){
		errorMsg += "\n\Association \t\t- Please specify your association.";
	}
	if (errorMsg != ""){
		msg = "____________________________________________________________________\n\n";
		msg += "There are problem(s) with the form.\n";
		msg += "Please correct the problem(s) and re-submit the form.\n";
		msg += "____________________________________________________________________\n\n";
		msg += "The following field(s) need to be corrected: -\n";
		
		errorMsg += alert(msg + errorMsg + "\n\n");		
		return false;
	}
	
	return true;	
}

</script>
<?php


$temp = $_POST[phone_one].$_POST[phone_two].$_POST[phone_three]." ext.".$_POST[phone_four];
$name = sanitize($_POST[name],100,0);
$email = sanitize($_POST[email],100,0);
$person=$_POST[person];
$login = sanitize($_POST[login],20,0);
$phone = sanitize($temp,20,0);
$pass = sanitize($_POST[pass],20,0);
$distance = $_POST[distance];
$fax = sanitize($_POST[fax],20,0);
$tollfree = sanitize($_POST[tollfree],20,0); 
$address = sanitize($_POST[address],150,0); 
$description = sanitize($_POST[description],1024,0); 
$assoc=$_POST[association];
$city = $_POST[city];
$country = $_POST[country];
$selcities = $_POST[selcities];
$selcities = explode(",",$selcities);
$selcities = array_unique($selcities);
if($assoc) $assocs=implode(",",$assoc);
$type = $_POST[type];
$state = $_POST[state];
$m_state = $_POST[m_state];
$market_type = $_POST[market_type];
$sms_address="";
$sms_service=$_POST[sms_service];
$longdist = sanitize($_POST[longdist],20,0);

if($sms_service =="yes")
{
$sms_address=sanitize($_POST[sms_phone],10,0);

$sms_address.="@".$_POST[sms_company];

}

if($m_state <52)
{
    $country="USA";
}else{
    $country="canada";
}
if($m_state ==997)
{
    $m_state=999;
    $country="USA";
   $distance=9999;
}
if($m_state ==998)
{
    $m_state=999;
    $country="canada";
   $distance=9999;
}
if ($longdist=="yes") {
	$longdist="1";
	$license = sanitize($_POST[license],50,0); 
	$license1 = sanitize($_POST[license1],50,0);
	$license2 = sanitize($_POST[license2],50,0);	
}
else {
	$longdist="0";
	$license = ""; 
	$license1 = "";
	$license2 = "";
}


$link = mysql_connect($db_host, $db_user, $db_password)
        or die("Could not connect");
mysql_select_db($db_locator_name) or die("Could not select database");

if (($type=='full' || $type=='packing' ||$type=='storage' ||$type=='transport') && $state=='')
{
	$sql = "SELECT sh_name from states where StateID = '$state'";
	$result = mysql_query($sql) or die("Query failed1");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$zipcode = $_POST[zipcode];	
        $comp_state= $line[sh_name];
}
else
{
	$sql = "SELECT sh_name from states where StateID = '$state'";
	$result = mysql_query($sql) or die("Query failed2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	$zipcode = $_POST[zipcode];	
        $comp_state= $line[sh_name];
}

if (($name) and ($type=='standard')) {
	
//check if all cities are within one state (fraud check)
/////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////
	// check if login is avaible?
	///////////////////////////////////////////////////////////////////////////
	$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
	
	$result = mysql_query($sql) or die("Query failed2");
	$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {

		$sql = "INSERT INTO `tblmembers` (`MemberName`, `MemberType`, `ContactEmail`, `ContactPerson`,`Login`,`Associations` ,`pass`, `Phone`, `State`, `ZipCode`, `Fax`, `TollFree`, `Address`, `MemberState`,`Description`,`ServiceCountry`, `DateAdded`,`sms_service`,`sms_address`, `distance`) 
		VALUES ('$name','$type','$email','$person', '$login','$assocs', '$pass', '$phone','$comp_state', '$zipcode', '$fax', '$tollfree', '$address', '$state','$description', '$country', CURRENT_TIMESTAMP, '$sms_service', '$sms_address', '$distance') "; 
		$result = mysql_query($sql) or die("Query failed3");
		
		$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
		$result = mysql_query($sql) or die("Query failed4");
		$line = mysql_fetch_array($result, MYSQL_ASSOC);
		$newid = $line[MemberID]; 




		
		 $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed233");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed23");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		$message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 
		  //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $email, $Subject, $message);

		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
		 $message = "Your application has been accepted and will be considered within few days";
                send_sms("new LUPU member");
	}
  
} else if (($name) and ($type=='full')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////


$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`distance`, `ContactPerson`,`MemberName`, `Phone`, `State`, `ZipCode`,
`Fax`, `TollFree`, `Address`, `Description`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`, `DateAdded`, `MemberState`, `CanadianLicense`,`sms_service`,`sms_address`) VALUES ( '$pass','$login','$distance', '$person','$name', '$phone','$comp_state', '$zipcode','$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$license1', '$email','$assocs','$type','$country', CURRENT_TIMESTAMP, '$m_state', '$license2', '$sms_service', '$sms_address')";

$result = mysql_query($query) or die("Query failed1111"); //$message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

if ($state == 999)
{
	$sql = "SELECT StateID from states WHERE StateID!=999 AND StateID!=68";
	$result = mysql_query($sql) or die("Query failed8");
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$sid = $line[StateID];
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$sid',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}
else
{
	if ($state!='')
	{
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$state',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}

$uploaddir = 'logos/';
$before = $uploaddir.basename($HTTP_POST_FILES['Logo']['name']);
if (file_exists($before) && $before != 'logos/NoLogo.gif')
{
   	unlink($before);
}
$realname = uniqid(rand()).substr($HTTP_POST_FILES['Logo']['name'], -4);
$uploadfile = $uploaddir . $realname;
if ($HTTP_POST_FILES['Logo']['name'] != '') {
	move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile);
}
else {
	$realname = 'NoLogo.gif';
}
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  


         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed234");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed26");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
		 
		 $Temp_FS = "<br><br><strong>Please note:</strong> ALL FULL SERVICE MOVERS will receive premium leads to service MUWC customer for their full service local and long distance, depending on your licensing (Interstate or Intrastate ONLY). However, every Full Service movers MUST serve also the Loading/Unloading service request in movemewithcare.com. All Full service movers have great privileges of receiving top quality leads from customers who is looking for ONLY the best movers in the nation, but you are also providing them specific service of their moves, more precisely Loading/Unloading assistance. Your data will be registered and transferred to both Full service providers AND Loading/Unloading Assistance providers. All companies servicing companies ONLY for Loading/Unloading, will ONLY receive the leads for LOading/Unloading assistance, but all Full Service movers will receive BOTH the loading/Unloading leads AND Full service Leads.";
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . 
		            $Temp_FS . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed55");
		  send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, you will be contacted shortly regarding billing information. ";
                send_sms("new Full Service member");

}
} 

else if (($name) and ($type=='transport')) {
$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

if ($line[nummembers]!=0) {
$message = "<font color=red>We are sorry, but you are already registered.";
} else {


$query = "INSERT INTO `tblmembers` (`ContactPerson`,`MemberName`, `Phone`, `State`, `ZipCode`,
`Fax`, `TollFree`, `Address`, `Description`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`, `DateAdded`, `MemberState`,`CanadianLicense`,`sms_service`,`sms_address`) VALUES ('$person','$name', '$phone','$comp_state', '$zipcode', '$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$license1', '$email','$assocs','$type','$country', CURRENT_TIMESTAMP, '$m_state', '$license2', '$sms_service', '$sms_address')";  

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

if ($state == 999)
{
	$sql = "SELECT StateID from states WHERE StateID!=999 AND StateID!=68";
	$result = mysql_query($sql) or die("Query failed8");
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$sid = $line[StateID];
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$sid',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}
else
{
	if ($state!='')
	{
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$state',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}

$uploaddir = 'logos/';
$before = $uploaddir.basename($HTTP_POST_FILES['Logo']['name']);
if (file_exists($before) && $before != 'logos/NoLogo.gif')
{
   	unlink($before);
}
$realname = uniqid(rand()).substr($HTTP_POST_FILES['Logo']['name'], -4);
$uploadfile = $uploaddir . $realname;
if ($HTTP_POST_FILES['Logo']['name'] != '') {
	move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile);
}
else {
	$realname = 'NoLogo.gif';
}
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  


         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed230");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed260");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process		 
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed556");
		  send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, Thank you.";
                send_sms("new Transport member");

}
}
else if (($name) and ($type=='storage')) {
$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

if ($line[nummembers]!=0) {
$message = "<font color=red>We are sorry, but you are already registered.";
} else {
	
$query = "INSERT INTO `tblmembers` (`ContactPerson`,`MemberName`, `Phone`, `State`,`ZipCode`,
`Fax`, `TollFree`, `Address`, `Description`, `ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`, `DateAdded`,`MemberState`,`sms_service`,`sms_address`) VALUES ('$person','$name', '$phone','$comp_state', '$zipcode', '$fax', '$tollfree', '$address', '$description',
'$email','$assocs','$type','$country', CURRENT_TIMESTAMP, $m_state, '$sms_service', '$sms_address')";   

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID];

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$state', CURRENT_TIMESTAMP)";
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$before = $uploaddir.basename($HTTP_POST_FILES['Logo']['name']);
if (file_exists($before) && $before != 'logos/NoLogo.gif')
{
   	unlink($before);
}
$realname = uniqid(rand()).substr($HTTP_POST_FILES['Logo']['name'], -4);
$uploadfile = $uploaddir . $realname;
if ($HTTP_POST_FILES['Logo']['name'] != '') {
	move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile);
}
else {
	$realname = 'NoLogo.gif';
}
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  


         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed237");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed267");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed557");
		 send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, Thank you.";
                send_sms("new Storage member");
}
}
else if (($name) and ($type=='packing')) {

$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but you are already registered.";
	} else {
	
$query = "INSERT INTO `tblmembers` (`ContactPerson`,`MemberName`, `Phone`, `State`,`ZipCode`,
`Fax`, `TollFree`, `Address`, `Description`, `ContactEmail`,`Associations`,`MemberType`,`ServiceCountry`, `DateAdded`, `MemberState`,`sms_service`,`sms_address`) VALUES ('$person','$name', '$phone','$comp_state', '$zipcode', '$fax', '$tollfree', '$address', '$description',
'$email','$assocs','$type','$country', CURRENT_TIMESTAMP, $m_state, '$sms_service', '$sms_address')"; 

$result = mysql_query($query) or $message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `ContactEmail`='$email' AND `Phone`='$phone' AND `ContactPerson`='$person' AND `MemberName`='$name'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$state', CURRENT_TIMESTAMP)"; 
$result = mysql_query($sql) or die("Query failed8");

$uploaddir = 'logos/';
$before = $uploaddir.basename($HTTP_POST_FILES['Logo']['name']);
if (file_exists($before) && $before != 'logos/NoLogo.gif')
{
   	unlink($before);
}
$realname = uniqid(rand()).substr($HTTP_POST_FILES['Logo']['name'], -4);
$uploadfile = $uploaddir . $realname;
if ($HTTP_POST_FILES['Logo']['name'] != '') {
	move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile);
}
else {
	$realname = 'NoLogo.gif';
}
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  


         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed2343");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed262");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail]; 
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed5559");
		 send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, Thank you.";
                send_sms("new packing member");
}
} 
else if (($name) and ($type=='market')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING FULL SERVICE MEMBERS HERE ||||||||||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////


$sql = "SELECT COUNT(*) as nummembers from tblmembers WHERE Login='$login'"; 
$result = mysql_query($sql) or die("Query failed6");
$line = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($line[nummembers]!=0) {
	$message = "<font color=red>We are sorry, but login \"$login\" is already taken.<br>Please return to the previous page and select another login</a>";
	} else {
	
$query = "INSERT INTO `tblmembers` (`pass`,`Login`,`ContactPerson`,`MemberName`, `Phone`, `State`, `ZipCode`,
`Fax`, `TollFree`, `Address`, `Description`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`,`MemberType`, `ServiceCountry`, `DateAdded`, `MemberState`, `CanadianLicense`,`sms_service`,`sms_address`,`Active`) VALUES ( '$pass','$login','$person','$name', '$phone','$comp_state', '$zipcode','$fax', '$tollfree', '$address', '$description',
'$longdist', '$license', '$license1', '$email','$assocs','$type','$country', CURRENT_TIMESTAMP, '$state', '$license2', '$sms_service', '$sms_address', '0')";

$result = mysql_query($query) or die("Query failed1111"); //$message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";

$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 

$sql ="Insert into tblmarket (`MID`,`MemberType`)  values('$newid', '$market_type')";
$r_market=mysql_query($sql);
if ($state == 999)
{
	$sql = "SELECT StateID from states WHERE StateID!=999 AND StateID!=68";
	$result = mysql_query($sql) or die("Query failed8");
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$sid = $line[StateID];
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$sid',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}
else
{
	if ($state!='')
	{
		$sql = "INSERT INTO `tblmember_servicecity` (`MID`, `StateID`, `DateAdded`) VALUES ('$newid','$state',CURRENT_TIMESTAMP)";
		$result = mysql_query($sql) or die("Query failed8");
	}
}

$uploaddir = 'logos/';
$before = $uploaddir.basename($HTTP_POST_FILES['Logo']['name']);
if (file_exists($before) && $before != 'logos/NoLogo.gif')
{
   	unlink($before);
}
$realname = uniqid(rand()).substr($HTTP_POST_FILES['Logo']['name'], -4);
$uploadfile = $uploaddir . $realname;
if ($HTTP_POST_FILES['Logo']['name'] != '') {
	move_uploaded_file($HTTP_POST_FILES['Logo']['tmp_name'], $uploadfile);
}
else {
	$realname = 'NoLogo.gif';
}
	  $strQuery = "update tblmembers set Logo = '$realname' where MemberID = $newid";
	  $result = mysql_query($strQuery) or die("Query failed90");  


         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed234");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed26");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
		 

		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . 
		           "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Complete";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed55");
		  send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, you will be contacted shortly regarding billing information. ";
                send_sms("new market member");
}
}
else if (($name) and ($type=='deadhaul')) {
////////////////////////////////////////////////////////////////////////////
// PROCESSING DEADHAUL MEMBERS HERE ||||||||||||||||||||||||||||
////////////////////////////////////////////////////////////////////////////



$query = "INSERT INTO `tblmembers` (`ContactPerson`,`MemberName`, `Phone`, `State`, `ZipCode`,
`Fax`, `TollFree`, `Address`, `InterstateLicense`, `USDot`, `MC`,
`ContactEmail`,`Associations`, `ServiceCountry`, `DateAdded`,  `CanadianLicense`,`MemberType`) VALUES ( '$person','$name', '$phone','$comp_state', '$zipcode','$fax', '$tollfree', '$address', 
'$longdist', '$license', '$license1', '$email','$assocs','$country', CURRENT_TIMESTAMP, '$license2','deadhaul')";
$result = mysql_query($query) or die("Query failed1111 $query"); //$message = "An internal error occured, please repeat your request. If problem persists, contact <a href=\"mailto:admin@movinguwithcare.com\">webmaster</a>.";


$sql = "SELECT `MemberID` FROM `tblmembers` WHERE `login`='$login'";
$result = mysql_query($sql) or die("Query failed7");
$line = mysql_fetch_array($result, MYSQL_ASSOC);
$newid = $line[MemberID]; 



         $sql = "SELECT admin_email from tbladmin";
	     $result = mysql_query($sql) or die("Query failed234");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $AdminMail = $line[admin_email]; 

		 $sql = "SELECT Detail from tbl_templates WHERE TempID='5'"; 
	     $result = mysql_query($sql) or die("Query failed26");
	     $line = mysql_fetch_array($result, MYSQL_ASSOC);
         $temp_message = $line[Detail];
		 
		 $Temp_FS = "<br><br><strong>Please note:</strong> ALL FULL SERVICE MOVERS will receive premium leads to service MUWC customer for their full service local and long distance, depending on your licensing (Interstate or Intrastate ONLY). However, every Full Service movers MUST serve also the Loading/Unloading service request in movemewithcare.com. All Full service movers have great privileges of receiving top quality leads from customers who is looking for ONLY the best movers in the nation, but you are also providing them specific service of their moves, more precisely Loading/Unloading assistance. Your data will be registered and transferred to both Full service providers AND Loading/Unloading Assistance providers. All companies servicing companies ONLY for Loading/Unloading, will ONLY receive the leads for LOading/Unloading assistance, but all Full Service movers will receive BOTH the loading/Unloading leads AND Full service Leads.";
		 
		 //process
		 $message  = "<br>";
         $message  = str_replace ("%Login%", $login, $temp_message);
		 $message  =  str_replace("%Pass%", $pass, $message);
		 $message = nl2br($message);
		 $message = "<font face= \"Verdana, Arial, Helvetica, sans-serif\"><center><img src=\"http://" . $CN_SERVER_NAME . "/logos/MUWC_Logo.gif\"><br>" . $message . 
		            $Temp_FS . "</center></font>";
		 
		 $from = "$AdminMail";
		 $Subject = "MMWC - Registeration Pending";

		 //send_mail("$from",SYSTEM_EMAIL_NAME,"$email","$Subject","$message");
		 
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$email', '$Subject', '$message')";
		 $result = mysql_query($sql) or die("Query failed55");
		  send_mail($from, $from, $email, $Subject, $message);
		 $sql = "INSERT INTO `tblEmails` (`MailType`, `From`, `To`, `Subject`, `Message`) VALUES ('1', '$from', '$from', 'New Member', 'there is a new $type member, $name')";
		 $result = mysql_query($sql) or die("Query failed5");
		  send_mail($from, $from, $from, "New Member", "there is a new $type member, $name");
$message = "Your application has been accepted, you will be contacted shortly regarding billing information. ";
                send_sms("new deadhaul member");


} 



?>

<?php if ($name) { ?>
</td>
    <td rowspan="5" bgcolor="#0066FF"></td>
    <td valign="top"><div align="center">
&nbsp;
</div></td>
  </tr>
  <tr> 
    <td valign="top" bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><table width="95%" border="0" align="center">
        <tr> 
          <td><br>
  <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">
<? echo $message ?>
</font></strong></p><br>
<center>
<!--a href="mem2_final.php"-->
<a href="/index.php">
<font size="-1" face="Arial, Helvetica, sans-serif">Return</font></a></center>
</td>
        </tr>
      </table>
      <div align="center" class="bottomtext"></div></td>
  </tr>
  <tr> 
    <td bgcolor="#0066FF" height="1"></td>
  </tr>
  <tr> 
    <td valign="top"><br><strong><font size="-1" face="Arial, Helvetica, sans-serif">
<?php

echo "<div id=\"copy\" align=\"center\" class=\"style1\">&copy; MoveMeWithCare Registered, 2006. All Rights Reserved - Relocators you can trust.
</div>";

?>
</font></strong></td>
  </tr>
</table>
</body>
</html>

<?php } ?>

<?php
if ($name) die;
///////////////////////////////////////////////////////////////////////////////


?>


 <p align="center"><strong><font size="-1" face="Arial, Helvetica, sans-serif">Become a 
    MoveMeWithCare.com member</font></strong></p>
<form name="form1" id="form1" method="post" action="" enctype="multipart/form-data">
  <table width="90%" border="0" align="center"  cell-spacing="10" style="font-family:Verdana;font-size:12px">
<tr><td colspan='2'>      <p>What kind of services you want to offer:<br /> <i>Please click on corresponding service.If you do offer more then one, please re-register for the other services</i></td></tr>
    <tr>
      <td  width='400'>What are the benefits? Read below:<br><span style='color:red'>
·SMS notification<br>
·Deadhaul program: Never come back with empty load<br>
·Recommendations to your customers for proper decisions<br>
·Marketplace: Free ads available to members<br>
·Corporate moving companies: Can dispatch all leads to your agents<br></span>
</td>



      <td align="left" ><input name="type" type="radio" onClick="setdata()" value="standard" id="standard">
        <label for="standard" class="lists">Loading/Unloading Assistance</label><br />
        <input type="radio" name="type" value="full" onClick="setdata()" id="full">        
	<label for="full" class="lists">Full service (Includes Packing, Loading, Transportation, Unloading, Unpacking and Warehousing)</label>
<!--(<strong><s>$250</s> $100/month special price</strong>)--> <br />
	<input type="radio" name="type" value="transport" onClick="setdata()" id="transport">        
	<label for="transport" class="lists">Transportation Services (Includes Local truck rental, long distance truck rental, truck with drivers, portable storage system)</label>
<br />
     <input type="radio" name="type" value="storage" onClick="setdata()" id="storage">        
	 <label for="storage" class="lists">Storage Facility (Provide storage locally and nationally, corporate storage facility providers, franchises, etc..)</label>
<br />
	 <input type="radio" name="type" value="packing" onClick="setdata()" id="packing">        
   <label for="packing" class="lists">Packing Supplies (All packing supplies providers able to ship locally and nationwide)</label>   
<br />
	 <input type="radio" name="type" value="market" onClick="setdata()" id="market">        
   <label for="market" class="lists">Marketplace (A variety of services)</label>   
<br />
	 <input type="radio" name="type" value="deadhaul" onClick="setdata()" id="deadhaul">        
   <label for="deadhaul" class="lists">Deadhaul</label>   
<br />

</td>

<td>
<img src='/images/Deadhaul.gif'>
</td>
    </tr>
  </table>
  <br>
<style>
#Agreement{
  background-image: url(semi.gif);
  width: 100%;
  height: 100%;
  top: 160px;
  left: 50px;
  height: 300px;
  width: 800px;
  z-index: 1000;
  visibility: hidden;
  position:absolute;
  text-align:center;
 
}
</style>

<div id="Agreement">
<script src="scripts/includethis.js">

</script>
<!--<script src="scripts/prototype.js" type="text/javascript"></script>
  <script src="scripts/scriptaculous.js" type="text/javascript"></script>
<script>
function handleError() {
	return true;
}
window.onerror = handleError;
ajaxinclude("affagreement.html");
var agreed=false;
</script>-->

<br />
<!--<input type="button" class="button" onclick="Effect.Puff('Agreement');agreed=true;" value="Agree"/>
<input type="button" class="button" onclick="window.location='index.php';" value="Disagree"/>-->
</div>
<tr><td><?echo"$captcha_html";?></td></tr>
<span id="newmember">

</span>
</div>
</form>
</td>
        </tr>
      </table>

			</div>
	   	</div>

</body>
</html>