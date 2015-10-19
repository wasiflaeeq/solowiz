<?php

include_once("config.php");


function login($username,$pass)
{


$password=md5($pass);

$res=selectall('users',"username='$username' AND password='$password'");
if(mysql_num_rows($res)>0)
{
$user=mysql_fetch_array($res);
$id=$user['id'];

return $id;
}
else
{
return false;	
	
}





}


function selectall($table,$condition)
{

return $query=mysql_query("SELECT * FROM $table WHERE $condition");

}




function insert()
{

$q="INSERT INTO ";

$numargs = func_num_args();
$arg_list = func_get_args();
$cols="(";
$vals=" VALUES(";
$n=0;
 for ($i = 0; $i < $numargs; $i++) {
     
	if($n==0)
	{
		$q.="`".$arg_list[$i]."`";
		$n=1;
	}
	else 
	if($n==1)
	{
		$cols.="`".$arg_list[$i]."`,";
		$n=2;
	}
	else
	if($n==2)
	{
		$vals.=$arg_list[$i].",";
		$n=1;
	}
  
    }

$vals=substr($vals,0,-1);
$cols=substr($cols,0,-1);
$vals.=")";
$cols.=")";
$q.=$cols . $vals;
mysql_query($q);

}



function sms_check_session($sender)
{
	$res=selectall('sms_sessions',"cellnumber='$sender'");
	$user=mysql_fetch_array($res);
	$id=$user['id'];
	if($id==FALSE)
	{
	
		return FALSE;
		
	}
	else
	{
	
		return TRUE;
	}

}



?>