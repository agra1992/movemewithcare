<? 
  // session_start();
    //echo $_SESSION['Admin_Id'];
   include "Security.php";
   include "header.php";
   
   echo "<h2>Add New Customer</h2>
          <b><font color=\"blue\">(All Fields are Mandatory unless stated otherwise)</font><br>";
   
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
	
?>
<script language="JavaScript">

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

  <table border="0" cellspacing="0" cellpadding="5">
  
  <form action="create_customer_action.php" name="form1" method="post" onsubmit="return validateForm(this);">
  
  <tr>
		<td align="right"><b>First Name:</b></td>
		<td><input type="text" name="FName" SIZE="40" maxlength="32"></td>
	</tr>
	<tr>
		<td align="right"><b>Last Name</b></td>
		<td><input type="text" name="LName" SIZE="40" maxlength="32"></td>
	</tr>
  <tr>
		<td align="right"><b>Email Address:</b></td>
		<td><input type="text" name="Email" SIZE="40" maxlength="32">
		    <? echo "<div class='warning'><b>(Email Address will be used by the customer to login to the system.)</b></div>"; ?>
		</td>
	</tr>
   <tr>
		<td align="right"><b>Address:</b></td>
		<td><textarea name="Address" cols="30" rows="2"></textarea></td>
	</tr>
	<tr>
            <td align="right"><b>State</b> </td>
            <td> 
              <select name='State'>
			     <option value="">Select State/Province</option>
                <? echo Val(); ?>
              </select> </td>
          </tr>
	<tr>
            <td align="right"><b>City</b> </td>
            <td> 
              <select name='City'>
			     <option value="">Select City</option>
                <? echo Val1(); ?>
              </select> </td>
          </tr>
  
  <tr>
		<td align="right"><b>Zip Code</b></td>
		<td><input type="text" name="zip" SIZE="40" maxlength="32"></td>
	</tr>
  <tr>
		<td align="right"><b>Phone</b></td>
		<td>
		 ( <input name="phone1" type="text" alt="Area Code" id="phone1" size="3" maxlength="3" onKeyUp='Move(this,3,"phone2")'> ) 
         <input name="phone2" type="text" alt="Phone" id="phone2" size="3" maxlength="3" onKeyUp='Move(this,3,"phone3")'> -
         <input name="phone3" type="text" id="phone3" size="4" maxlength="4">
		</td>
	</tr>
  <tr>
		<td align="right"><b>Fax (if any)</b></td>
		<td><input type="text" name="fax" SIZE="40" maxlength="32"></td>
	</tr>
  <tr>
		<td align="right"><b>URL (if any)</b></td>
		<td><input type="text" name="url" SIZE="40" maxlength="32" value="http://"></td>
	</tr>
   <tr>
		<td></td>
		<td valign="top">
        <input type="submit" value="Create Customer" class="waButton1">
        <input type="reset" value="Reset" class="waButton1">
		<? echo "<input type=button value=\"Go Back\" class=\"waButton1\" onclick=\"window.location='customers.php'\">"; ?>
		</td></tr>
		</form>
</table>
		
<?
   include "footer.php";
?>
  
   
   