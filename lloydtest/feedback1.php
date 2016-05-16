<html>
<head>
<?
 error_reporting(0);
 require ('config.inc.php'); 
 require_once ('seo.php');
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
-->
</style>
</head><body>
<? 
include_once "top_panel.php"; 
?>
<a name="top"></a>
<?
  if ($_SESSION['browser'] != "Mozilla")
  {
    echo "<table width=\"750\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\" style=\"margin-left:105px\">";  
  }
  else
  {
    echo "<table width=\"600\" border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\" style=\"margin-left:105px\">"; 
  }
?>

<tr><td><div align="left" id="err"></div></td></tr>
	<tr>
		<td width="566" valign="top">
			<div align="center">
				<span class="bluetitle style17"><font style="FONT: bold 15px 'Verdana, Arial, Helvetica, sans-serif'; COLOR: #F79A30; LETTER-SPACING: 3px;">Feedback</font> </span>
				<hr />
				<form action="feedbackPr.php" method="post">
					<p><strong><font size="2" face="Verdana, Arial">We Always Like To Hear From You</font></strong></p>
					<p><font size="2" face="Verdana, Arial"><strong>What kind of comment would you like to send?</strong><br />
	<input type="radio" checked="checked" value="Suggestion" name="comment" id="Suggestion"><label for="Suggestion">Suggestion</label><input type="radio" value="Complaint" name="comment" id="Complaint"><label for="Complaint">Complaint</label><input type="radio" value="Praise" name="comment" id="Praise"><label for="Praise">Praise</label>
<input type="radio" value="Beta" name="comment" id="Beta"><label for="Praise">Web Site Issues</label><br />
							<br />
							<br />
							<strong>To which service offered in Movemewithcare would you care to comment? </strong></font></p>
					<table width="81%" border="0" >
						<tbody>
							<tr>
								<td width="48%" align="center"><font size="2" face="Verdana, Arial"><input type="radio" checked="checked" value="full" name="proacecompany" id="full"><label for="full">Full Service Mover Provider</label> </font></td>
							</tr>
							<tr>
								<td width="48%" align="center"><font size="2" face="Verdana, Arial"><input type="radio" value="lupu" name="proacecompany" id="lupu"><label for="lupu"> Loading/Unloading provider</label></font></td>
							</tr>
							<tr>
								<td width="48%" align="center"><font size="2" face="Verdana, Arial"><input type="radio" value="transport" name="proacecompany" id="transport"/><label for="transport">Transportation providers</label> &nbsp;&nbsp;&nbsp;</font></td>
							</tr>
							<tr>
								<td width="48%" align="center"> <font size="2" face="Verdana, Arial"><input type="radio" value="storage" name="proacecompany" id="storage"/> <label for="storage">Storage Facilities </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
							</tr>
							<tr>
								<td width="48%" align="center"> <font size="2" face="Verdana, Arial"><input type="radio" value="packingsupplied" name="proacecompany" id="packingsupplied"/><label for="packingsupplied"> Packing Supplies Provider</label> &nbsp;&nbsp;</font></td>
							</tr>
							<tr><td><br />
<br /></td></tr>
							<tr>
								<td>
									<div align="center">
										<p><strong><font face="Verdana, Arial">How many stars do you wish to give?</font></strong></p>
									</div>
								</td>
							</tr>
							<tr>
								<td align="center">
									<p><font size="1" face="Verdana, Arial">Rate: 1 star = poor  / 5 star = great</font></p>
								</td>
							</tr>
							<tr>
								<td align="center"><font size="2" face="Verdana, Arial"><input type="radio" checked="checked" value="1" name="rater" id="1"/> <label for="1"> 1 </label><input type="radio" value="3" name="rater" id="2"/> <label for="2">2 </label><input type="radio" value="3" name="rater" id="3"/><label for="3"> 3 </label><input type="radio" value="4" name="rater" id="4"/><label for="4"> 4 </label> <input type="radio" value="5" name="rater" id="5"/><label for="5"> 5 </label></font></td>
							</tr>
						</tbody>
					</table>
					<font size="2" face="Verdana, Arial"><br />
						<strong>Enter your comments below:</strong><br />
						<textarea name="feedback" rows="6" wrap="hard" cols="35"></textarea><br />
						<br />
						<strong>Tell us how to contact you:</strong></font>
					<table width="286" border="0">
						<tbody>
							<tr>
								<td width="16%"><strong><font size="1" face="Verdana, Arial">Name:</font></strong></td>
								<td width="84%"><input type="text" size="30" name="name" id="name"/></td>
							</tr>
							<tr>
								<td width="16%"><strong><font size="1" face="Verdana, Arial">Company:</font></strong></td>
								<td width="84%"><input type="text" size="30" id="company" name="company" /></td>
							</tr>
							<tr>
								<td width="16%"><strong><font size="1" face="Verdana, Arial">E-mail:</font></strong></td>
								<td width="84%"><input type="text" size="30" id="email" name="email" /></td>
							</tr>
							<tr>
								<td width="16%"><strong><font size="1" face="Verdana, Arial">Phone:</font></strong></td>
								<td width="84%"><input type="text" size="30" id="phone" name="phone" /></td>
							</tr>
						</tbody>
					</table>
					<font size="2" face="Verdana, Arial"><br />
					</font>
					<center>
						<font size="2" face="Verdana, Arial"><input class="button" type="submit" value="Submit" name="submit" /> <input class="button" type="reset" value="Clear Form" name="reset" /></font></center>
				</form>
			</div>
		</td>
	</tr>
</table>

</form>
<? include "bottom_panel.php"; ?>	
</div>
</body>
</html> 