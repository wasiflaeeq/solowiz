<?php
include("header.php");
if(isset($_POST['changepass']))
{
$old=md5($_POST['oldpassword']);
$new=$_POST['newpass'];
$new2=$_POST['newpass2'];
$old=mysql_query("SELECT * FROM users WHERE password='$old'");
if(mysql_num_rows($old)>0){
	if($new==$new2)
	{
		$new=md5($new);
		mysql_query("UPDATE users SET password='$new'");
		$msg="Password Changed Successfuly!";
		echo "<span class='msg'>Password Changed Successfuly!</span>";
		
		
		
	}
	else{
		
		echo "<span class='err'>New Password and Confirm Password fields mismatched</span>";
		
		
		}
	
	
	
	}
	else
	{
		
		
		echo "<span class='err'>Old Password mistyped</span>";
		
		
	}

	
	
	
	
}
?>

<div class="thetitle">Change Password </div>
<div>
<form name="chngpass" method="post">
<table>
<tr>
<td width="151">Old Password:</td>
<td width="234">
<input type="password" name="oldpassword" />
</td>
</tr><tr>
<td> New Password:
</td>
<td>
<input type="password" name="newpass" />
</td>
</tr><tr>
<td> Repeat new Password
</td>
<td>
<input type="password" name="newpass2" /></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input type="submit" value="Change Password" name="changepass" />&nbsp;</td>
</tr>
</table>
</form>
</div>
<?php
include("footer.php");

?>