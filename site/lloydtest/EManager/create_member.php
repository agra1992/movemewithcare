<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   include "members_js.php";
   
   echo "<h2>Add New Member</h2><br>";
   
   function Val()
    {
	    	
        global $DataBase;
		
		$strQuery = "SELECT StateID, name, sh_name FROM states WHERE 1 LIMIT 0, 80 "; 
        $DataBase->query($strQuery);
		$nResult  = $DataBase->fetch_all();
        $Record_Type  = $DataBase->fetch_row();
		$Count = $Record_Type[0];
		
		foreach($nResult as $val)
		{
			$SID    	= $val[0];
			$Name		= $val[1];
			$SName		= $val[2];
			
			$options = $options . "<option value=$SID>$Name ($SName)</option>";
          
         }// End OF Foreach Loop
		return  $options;
		
    }  // EnD Of Function Val()
	
	function Val1()
    {
	    	
        global $DataBase;
		
		$strQuery = "SELECT CityID,city FROM cities WHERE 1 LIMIT 0, 1000 "; 
        $DataBase->query($strQuery);
		$nResult  = $DataBase->fetch_all();
        $Record_Type  = $DataBase->fetch_row();
		$Count = $Record_Type[0];
		
		foreach($nResult as $val)
		{
			$CID	= $val[0];
			$Name		= $val[1];
			$options = $options . "<option value=$CID>$Name</option>";
          
         }// End OF Foreach Loop
		return  $options;
		
    }  // EnD Of Function Val()
	
	 function Val2()
    {
	    	
        global $DataBase;
		
		$strQuery = "SELECT assid, ass_shname, ass_fullname FROM associations WHERE 1 LIMIT 0, 10 "; 
        $DataBase->query($strQuery);
		$nResult  = $DataBase->fetch_all();
        $Record_Type  = $DataBase->fetch_row();
		$Count = $Record_Type[0];
		
		foreach($nResult as $val)
		{
			$AID    	= $val[0];
			$SName		= $val[1];
			$FName		= $val[2];
			
			$options = $options . "<option value=$AID>$SName ($FName)</option>";
          
         }// End OF Foreach Loop
		return  $options;
		
    }  // EnD Of Function Val()
?>
<script language="JavaScript">


function changeOptions(opt_ele)
{
        //showOptions();
        var ele=opt_ele.value;
		
        if (ele==1)
        {
		   document.all['Nm1'].style.visibility='visible';
		   document.all['Nm'].style.visibility='visible';
		   document.all['CP'].style.visibility='visible';
		   document.all['CP1'].style.visibility='visible';
		   document.all['CE'].style.visibility='visible';
		   document.all['CE1'].style.visibility='visible';
		   document.all['warning'].style.visibility='visible';
		   document.all['Pass_1'].style.visibility='visible';
		   document.all['Pass1_1'].style.visibility='visible';
		   document.all['Zip1'].style.visibility='visible';
		   document.all['Zip_1'].style.visibility='visible';
		   document.all['Address1'].style.visibility='visible';
		   document.all['Address_1'].style.visibility='visible';
		   document.all['Phone1'].style.visibility='visible';
		   document.all['Phone_1'].style.visibility='visible';
		   document.all['Fax1'].style.visibility='visible';
		   document.all['Fax_1'].style.visibility='visible';
		   document.all['URL1'].style.visibility='visible';
		   document.all['URL_1'].style.visibility='visible';
		   document.all['Buttons'].style.visibility='visible';
		   document.all['Ass1'].style.visibility='visible';
		   document.all['Ass_1'].style.visibility='visible';
		   document.all['State_City'].style.visibility='visible';
		   document.all['State_City1'].style.visibility='visible';
		}	
		
		if (ele==2)
        {
           
		}				
		
		if (ele==3)
        {
           
		}	
		
		if (ele==4)
        {
           
		}	
		
		if (ele==5)
        {
           
		}	
}// function changeoptions();

function GeneratePassword() {

    var length=8;
    var sPassword = "";

	for (i=0; i < length; i++) 
	{
		numI = getRandomNum();
		while (checkPunc(numI)) { numI = getRandomNum(); } 
	        sPassword = sPassword + String.fromCharCode(numI);
	}

document.form1.Pass.value = sPassword;

MakeBaloon(sPassword);

return true;

}

function MakeBaloon(sPassword) {

    var alpha = new Array('alpha', 'bravo', 'charlie', 'delta', 'echo', 'foxtrot', 'golf', 'hotel', 'india', 'juliet', 'kilo', 'lima', 'mike', 'november', 'oscar', 'papa', 'quebec', 'romeo', 'sierra', 'tango', 'uniform', 'victor', 'whiskey', 'x-ray', 'yankee', 'zulu');
   title = '';

	for (i=0; i < sPassword.length; i++) 
		{
		current = sPassword.substr(i,1);
		if (current.search(/[0-9]/)==0) title = title + ' digit ' + current;
		if (current.search(/[A-Z]/)==0) title = title + ' UPPERCASE ' + alpha[current.charCodeAt()-65].toUpperCase();
		if (current.search(/[a-z]/)==0) title = title + ' lowercase ' + alpha[current.charCodeAt()-97];
                }

document.form1.Pass.title = title;

return true;

}


function getRandomNum() {

    var rndNum = Math.random()
    rndNum = parseInt(rndNum * 1000);
    rndNum = (rndNum % 94) + 33;

    return rndNum;
}

function checkPunc(num) {

    if ((num >=33) && (num <=47)) { return true; }
    if ((num >=58) && (num <=64)) { return true; }
    if ((num >=91) && (num <=96)) { return true; }
    if ((num >=123) && (num <=126)) { return true; }

    return false;
}

function validateForm(frm)
                {
                        var strError = '';
						var validEmail;

                        if(frm.Email.value=='')
						{
                                strError += "Enter an EMAIL ADDRESS!\n";

                        }           
						if(frm.Email.value !='')
						{
                               validEmail = emailCheck(frm.Email.value)
                               if (validEmail == false) 
							   {
							     strError += "Invalid EMAIL ADDRESS!\n";
							   }
                        }               

                        if(strError != '')
                        {
                                alert(strError);
                                return false;
                        }

                        return true;
                }

 function emailCheck(emailStr)
                {

                        var emailPat=/^(.+)@(.+)$/
                        var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]"
                        var validChars="\[^\\s" + specialChars + "\]"
                        var quotedUser="(\"[^\"]*\")"
                        var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
                        var atom=validChars + '+'
                        var word="(" + atom + "|" + quotedUser + ")"
                        var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
                        var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")
                        var matchArray=emailStr.match(emailPat)
                        if (matchArray==null) {
                                //alert("Email address seems incorrect (check @ and .'s)")
                                //form1.strEmail.focus();
                                //form1.strEmail.select();
                                return false;
                        }
                        var user=matchArray[1]
                        var domain=matchArray[2]

                        if (user.match(userPat)==null) {
                           
                        return false;
						}
                }
	function Move (elem, dlina, id) 
	{
	 if (elem.value.length > dlina-1 && id) 
	  {
	    document.getElementById(id).focus();
    }
	}
</script>

 <form name ="form1" id="form1" method="post" action="create_customer_action.php" onsubmit="return validateForm(this);">
  <table width="100%" border="0" align="center">
    <tr>
       <td align="left"><input name="type" type="radio" onClick="changeOptions(this)" value="1">
        <b>Loading/Unloading Assistance<br /></b>
        <input type="radio" name="type" value="2" onClick="changeOptions(this)">        
	    <b>Full service (Includes Packing, Loading, Transportation, Unloading, Unpacking and Warehousing) <br /></b>
	    <input type="radio" name="type" value="3" onClick="changeOptions(this)">        
	    <b>Transportation Services (Includes Local truck rental, long distance truck rental, truck with drivers, portable storage system)
        <br /></b>
       <input type="radio" name="type" value="4" onClick="changeOptions(this)">        
	    <b>Storage Facility (Provide storage locally and nationally, corporate storage facility providers, franchises, etc..)
       <br /></b>
	   <input type="radio" name="type" value="5" onClick="changeOptions(this)">        
       <b>Packing Supplies (All packing supplies providers able to ship locally and nationwide)
       <br /></b>
	</td>  
  <tr>
		<td>&nbsp;</td>
	</tr>
	</table>

	<table border="0" cellspacing="0" cellpadding="5">
  <tr>
		<td align="right"><div id='Nm' Style='visibility:hidden'><b>Full name of Company:</b></div></td>
		<td><div id='Nm1' Style='visibility:hidden'><input type="text" name="Name" SIZE="40" maxlength="32"></div></td>
	</tr>
	<tr>
		<td align="right"><div id='CP' Style='visibility:hidden'><b>Contact Person:</b></div></td>
		<td><div id='CP1' Style='visibility:hidden'><input type="text" name="Person" SIZE="40" maxlength="32"></div></td>
	</tr>
  <tr>
		<td align="right"><div id='CE' Style='visibility:hidden'><b>Contact email:</b></div></td>
		<td><div id='CE1' Style='visibility:hidden'><input type="text" name="Email" SIZE="40" maxlength="32">
		<div id='warning' class='warning' Style='visibility:hidden'>
		    <b>(Email Address will be used by the MEMBER to login to the system.)</b>
		</div></div>
		</td>
	</tr>
	<tr>
		<td align="right"><div id='Pass_1' Style='visibility:hidden'><b>Password:</b></div></td>
		<td><div id='Pass1_1' Style='visibility:hidden'><input type="text" name="Pass" SIZE="40" maxlength="32">&nbsp;
		<input type="button" name="generate" value="Generate" onClick="GeneratePassword()" class="waButton1"></div>
		</td>
	</tr>
   <tr>
		<td align="right"><div id='Address1' Style='visibility:hidden'><b>Address:</b></div></td>
		<td><div id='Address_1' Style='visibility:hidden'><textarea name="Address" cols="30" rows="2"></textarea></div></td>
	</tr>
	<tr>
            <td align="right" valign="top"><div id='State_City' Style='visibility:hidden'><b>Select area of service:</b>
			<br>(Ctrl+Click to select multiple)</div> </td>
            <td> <div id='State_City1' Style='visibility:hidden'>
              <select name='state' size="5" multiple onChange="show_selected()">
			    <option value="-1">---Select State---</option>
                <? echo Val(); ?>
              </select> 
			  <select name='city[]' size="5" multiple disabled>
			     <option value="-1">---Select City---</option>
                <? //echo Val1(); ?>
              </select> </div>
			  </td>
          </tr>
  <tr>
		<td align="right"><div id='Zip1' Style='visibility:hidden'><b>Zip Code</b></div></td>
		<td><div id='Zip_1' Style='visibility:hidden'><input type="text" name="zip" SIZE="40" maxlength="32"></div></td>
	</tr>
  <tr>
		<td align="right"><div id='Phone1' Style='visibility:hidden'><b>Phone:</b></div></td>
		<td><div id='Phone_1' Style='visibility:hidden'>
		 ( <input name="phone1" type="text" alt="Area Code" id="phone1" size="3" maxlength="3" onKeyUp='Move(this,3,"phone2")'> ) 
         <input name="phone2" type="text" alt="Phone" id="phone2" size="3" maxlength="3" onKeyUp='Move(this,3,"phone3")'> -
         <input name="phone3" type="text" id="phone3" size="4" maxlength="4"></div>
		</td>
	</tr>
  <tr>
		<td align="right"><div id='Fax1' Style='visibility:hidden'><b>Fax</b></div></td>
		<td><div id='Fax_1' Style='visibility:hidden'><input type="text" name="fax" SIZE="40" maxlength="32"></div></td>
	</tr>
  <tr>
		<td align="right"><div id='URL1' Style='visibility:hidden'><b>URL (if any)</b></div></td>
		<td><div id='URL_1' Style='visibility:hidden'><input type="text" name="url" SIZE="40" maxlength="32" value="http://"></div></td>
	</tr>
  <tr>
		<td align="right" valign="top"><div id='Ass1' Style='visibility:hidden'><b>Select the associations the company is registered with:
		<br></b><i>(Ctrl+Click to select multiple)</i></div></td>
		<td><div id='Ass_1' Style='visibility:hidden'>
		<select name='Association[]' size="5" multiple>
                <? echo Val2(); ?>
         </select>
		</div></td>
	</tr>
   <tr>
		<td></td>
		<td valign="top">
		<div id='Buttons' Style='visibility:hidden'>
        <input type="submit" value="Create Customer" class="waButton1">
        <input type="reset" value="Reset" class="waButton1">
		</div>
		</td></tr>
		
</table>
</form>
		
<?
   include "footer.php";
?>
  
   
   