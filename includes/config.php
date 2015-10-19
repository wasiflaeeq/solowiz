<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "solowiz";
$port="8800";
$smshost="";

$dir="/var/www/html/";

$sshhost="192.168.1.150";
$sshuser="root";
$sshpass="solowiz";


$con=mysql_connect($hostname,$username,$password);
mysql_select_db($database,$con);




?>