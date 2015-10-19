<?php
include("../config.php");
include("../database_functions.php");
$sender=$_GET['sender'];
$msg=$_GET['msg'];


if(sms_check_session($sender)==FALSE)
{
	
	$username=substr($msg,0,strpos($msg," "));
	$password=substr($msg,strpos($msg," ")+1);
	$id=login($username,$password);
	if($id!=FALSE)
	{
		insert("sms_sessions","uid",$id,"cellnumber","'$sender'");
		
		echo "Hi $username, Welcome to solowiz VM sms interface";
	
	}
	else
	{
	
		echo "Sorry, but your username or Password is wrong,";
	
	}

}
else
{

	echo "You're already logged in";

}



?>