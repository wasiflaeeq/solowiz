<?php
@session_start();
include("includes/config.php");

if(isset($_GET['logout']))
{
$_SESSION['loggedin']=false;
session_destroy();
	header("location: login.php");
}
if(!isset($_SESSION['loggedin']))
{
	header("location: login.php");
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SoloWIZ VM Enterprise Edition (My Control Panel)</title>
<script type="text/javascript" src="js/jquery-1.5.2.min.js"></script>

<script type="text/javascript" src="js/simple.js"></script>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body style="padding:0px; margin:0px;">

<div style="width:100%; background-image:url(images/main_01.png); z-index:1; height:64px;">
<div style=" height:64px; width: 280px; float:left; background-repeat:no-repeat;">
&nbsp;<a href="index.php"><img src="images/solowiz-logo2.png"  height="50" border="0"/></a></div>
<div class="topmenu" style=" height:34px; width: 600px; padding-top:30px; margin-left:70px; float:left; background-repeat:no-repeat;">
  &nbsp; <a href="index.php">Virtual Machines</a> | <a href="images.php">OS Images</a> | <a href="pools.php">IP Pools</a> | <a href="changepass.php">Change Password</a> | <a href="?logout">Logout</a></div>
</div>

<div style="text-align:center; width:100%;">
<div id="loading" style="display:none; height:20px; z-index:2; background-color:#F36; color:#FFF; font-weight:bold; text-align:center; width:0px; margin: 0 auto; overflow:hidden;">
Loading ...
</div>
<div style="text-align:left; width:1020px; margin: 0 auto;">
&nbsp;
<div style="background-image:url(images/main_17.png); height:29px; background-repeat:no-repeat;">
</div>
<div style="background-image:url(images/main_18.png); background-repeat:repeat-y;">
<div id="main" style="display:inline-block; padding-left:50px; padding-right:20px;"> 