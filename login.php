<?php

session_start();
if(isset($_POST['login']))
{
	
$user=$_POST['login'];
$pass=$_POST['password'];
include("includes/database_functions.php");
$login=login($user,$pass);

if($login!=false)
{

$_SESSION['loggedin']=true;
header("location: index.php");
	
}
else
{
session_destroy();
	$err=true;

}
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>SOLOWIZ -:- Login Page</title>
	<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="js/simple.js"></script>
<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" type="text/css" href="style-login.css" />
</head>

<body><div style='height:20px';><?php

if(isset($err) AND $err==true)
{
	
echo "<span style='background:' class='err'>Login Failed, Wrong Username and Password Provided</span>";	
}
?>
</div>
<div class="tlinks"><img src="images/solowiz-logo.png" width="303" height="80" /></div>
	<div id="room1"><form id="login-form" action="login.php" method="post">
		<fieldset>
		
<legend>Log in</legend>
			
			<label for="login">username</label>
			<input type="text" id="login" name="login"/>
			<div class="clear"></div>
			
			<label for="password">Password</label>
			<input type="password" id="password" name="password"/>
		  <div class="clear"></div>
			<div class="clear"></div>
			
			<br />
			
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Log in"/>	
		</fieldset>
	</form>
</div>
    
    <div style="display:none;" id="access1"><form id="login-form" action="#" method="post">
		<fieldset>
		
			<legend>Log in</legend>
			
			<label for="login">Email</label>
			<input type="text" id="login" name="login"/>
			<div class="clear"></div>
			
			<label for="password">Password</label>
			<input type="password" id="password" name="password"/>
			<div class="clear"></div>
			
			<label for="remember_me" style="padding: 0;">Remember me?</label>
			<input type="checkbox" id="remember_me" style="position: relative; top: 3px; margin: 0; " name="remember_me"/>
			<div class="clear"></div>
			
			<br />
			
			<input type="submit" style="margin: -20px 0 0 287px;" class="button" name="commit" value="Log in"/>	
		</fieldset>
	</form>
	</div>
</body>

</html>