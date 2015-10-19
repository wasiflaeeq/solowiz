<?php
include_once("vzhandler_functions.php");

$action=$_GET["action"];


if($action=="create")
{
	

$hostname=$_GET["hostname"];
$password=$_GET["password"];
$temp=$_GET["template"];
$hdd=$_GET["hdd"];
$ip=$_GET['ip'];

echo createvps($hostname,$temp,$ip,$hdd);

	
}
else if($action=="stop")
{
	$id=$_GET["id"];
	echo stopvps($id);
	
}

else if($action=="start")
{
	$id=$_GET["id"];
	echo startvps($id);
	
}
else if($action=="restart")
{
	$id=$_GET["id"];
	echo restartvps($id);
	
}



?>