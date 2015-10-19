<?php
include_once("includes/vzhandler_functions.php");
$id=2;
$res=vzctl("status ".$id);
$res = str_replace("\n","",$res); 
if($res=="CTID ".$id." exist unmounted down")
{

echo "Down";
	
}
elseif($res=="CTID ".$id." exist mounted running")
{

echo "Up";
	
}
elseif($res=="CTID ".$id." deleted unmounted down")
{

echo "Error";
	
}



?>