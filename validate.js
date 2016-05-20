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
