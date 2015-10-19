<?php
include_once("config.php");


function createvps($hostname, $templateid, $ipaddress, $hdd,$password){
		include_once("config.php");
		
		
		
		$template="SELECT filename FROM images WHERE id=$templateid";
		$template=mysql_query($template);
		$template=mysql_fetch_array($template);
		$template=$template[0];
		$sql="INSERT INTO vm SET name='$hostname', password='$password', os='$template', ipaddress='$ipaddress'";
		mysql_query($sql);
		$last_id="SELECT id from vm ORDER BY id DESC";
		$last_id=mysql_query($last_id);
		$last_id=mysql_fetch_array($last_id);
		$id=$last_id[0];
		
		
		
		$sql="UPDATE ips SET vmid=$id WHERE ip='$ipaddress'";
		mysql_query($sql);
		
		$create="create ".$id." --ostemplate ".$template;
		vzctl($create);
		vzctl("start ".$id);
		vzctl("set ".$id." --onboot yes --save");
		vzctl("set ".$id." --ipadel all --save");
		vzctl("set ".$id." --ipadd ".$ipaddress." --save");
		vzctl("set ".$id." --nameserver 208.67.222.222 --save");
		vzctl("set ".$id." --nameserver 208.67.220.220 --save");
		vzctl("set ".$id." --userpasswd root:".$password." --save");

		sethostname($id,$hostname);
		$hddh=$hdd+1;
		vzctl("set ".$id." --diskspace ".$hdd."G:".$hddh."G --save");
		$ret=startvps($id);
		if($ret="VPS is being Started!")
		{
		return "VPS Created Successfully";	
		}
		else
		{
		return "Error Occured! This could be a corupt OS Image";
		
		}
		

		
	
}


function createtemplate($name,$parent){
	$pid=$parent;
	$parent=templatebasename($parent);
	$desc="Based on ".$parent;
	$filename=$parent."-".$name;

	//$cpold="cp -R /vz/private/".$pid." /vz/template/cache/".$filename;
//	doexecute($cpold);

//$command="cd /vz/private/".$pid."
//tar --numeric-owner -zcf /vz/template/cache/".$filename.".tar.gz *";
//	$command="vzdump --compress --dumpdir /vz/template/cache/ --stop ".$pid;
$command='tar --create --gzip --numeric-owner --directory="/vz/private/'.$pid.'/" --file="/vz/template/cache/'.$filename.'".tar.gz "./"';

	doexecute($command);
	 $insert="INSERT INTO images SET name='$name', description='$desc', filename='$filename', logo='$logo'";
	  mysql_query($insert);
      echo "OS Image Added!";
	  
	
	
	
	
	
	
	
	
	}
	
	
	
function templatebasename($id){
	include_once("config.php");
		$parent=mysql_query("SELECT * FROM vm WHERE id=$id");
		$parent=mysql_fetch_array($parent);
		$parent=$parent['os'];
	
	$pos=strpos($parent,"-");
		$pos=strpos($parent,"-",$pos+1);
	$pos3=strpos($parent,"-",$pos+1);
	if($pos3>0)
	{
	$filename=substr($parent,0,$pos3);
	}
	else
	{
		$filename=$parent;
	}
	
	
	
	return  $filename;
	}
function deletevps($id){
		include_once("config.php");
	
	
		$sql="DELETE FROM vm WHERE id=$id";
		mysql_query($sql);
		$sql="UPDATE ips SET vmid=0 WHERE vmid=$id";
		mysql_query($sql);

		stopvps($id);
		$delete="destroy ".$id;
		vzctl($delete);
	
}

function sethostname($id,$hostname)
{
	
	vzctl("set ".$id." --hostname ".$hostname." --save");
	
}



function startvps($id)
{
	
$ret=vzctl("start ".$id);
if($ret=="")
	{
		return "Either VPS is already Running or an error occured";
	}
	else
	{
	return "VPS is being Started!";	
	}
}

function stopvps($id)
{
	
	$ret=vzctl("stop ".$id);
	if($ret=="")
	{
		return "Either VPS is already stopped or an error occured";
	}
	else
	{
	return $ret;	
	}
}

function restartvps($id)
{
	
	vzctl("restart ".$id);
	return "Restart Command Sent to VPS";
	
}

//createvps("wasiflaeeq",1,"192.168.1.15",15);


function vzctl($command)
{
	
	$command="/usr/sbin/vzctl ".$command;
	
	return doexecute($command);

	
	
}


function doexecute($command)
{
	include("config.php");
	$data="";
	// if (!function_exists("ssh2_connect")) die("function ssh2_connect doesn't exist");
if(!(@@$con = ssh2_connect($sshhost, 22))){
} else {
    if(!ssh2_auth_password($con, $sshuser, $sshpass)) {
    } else {
       
//echo "logged in";
        // execute a command
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "fail: unable to execute command\n";
        } else {
            // collect returning data from command
            stream_set_blocking($stream, true);
            $results = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
             	
            fclose($stream);
        }
    }
	
	
	}
	 
	return $data;
	
	
	}

function status($id)
{
	
	
$res=vzctl("status ".$id);
$res = str_replace("\n","",$res); 
if($res=="CTID ".$id." exist unmounted down")
{

return "Turned Off";
	
}
elseif($res=="CTID ".$id." exist mounted running")
{

return "Running";
	
}
elseif($res=="CTID ".$id." deleted unmounted down")
{

return "Does not exist/ Being Created";
	
}
	
	
	
	
}


?>