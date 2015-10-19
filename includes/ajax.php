<?php
include("config.php");


$do=$_GET[action];
	if($do=="vmlist")
	{
		$res="<a id='cvm'>Create a VM</a><br /><hr /><table width='800px'>
		<tr style='font-weight:bold;'> <td>VMid (in DB)</td> <td>Hostname</td> <td>Operating System</td> <td>Current State</td> <td colspan='4'> Actions</td> </tr>
		";
		$vms=mysql_query("SELECT * from vm");
		while($vm=mysql_fetch_array($vms))
		{
		
			$res.="<tr>
			<td>
			".$vm[id]."
			</td>
			<td>
			".$vm[name]."
			</td>
			<td>
			".$vm[os]."
			</td>
			<td>
			".$vm[state]."
			</td>
			<td>
			<img class='start' id='start_".$vm[id]."' src='images/start.png'>
			</td>
			<td>
			<img class='restart' id='restart_".$vm[id]."' src='images/restart.png'>
			</td>
			<td>
			<img class='stop' id='stop_".$vm[id]."' src='images/stop.png'>
			</td>
			<td>
			<img class='suspend' id='suspend_".$vm[id]."' src='images/suspend.png'>
			</td>
			</tr>";
			
		}
		$res.="</table>";
		
		echo $res;
	}


	else	if($do=="images")
	{
		$res="<table><tr>";
$n=1;

		$imgs=mysql_query("SELECT * from images");
		while($img=mysql_fetch_array($imgs))
		{
			$res.="<td><img image='$img[name]' class='createvm' id='$img[0]' src='logos/$img[4]'></td>";
		
			
		}
		$res.="</tr></table>";
		
		echo $res;
	}
	else if($do=="start")
	{
		
		$id=$_GET['id'];
		
		echo "Started VM ".$id;
		
	}
	else if($do=="stop")
	{
		
		$id=$_GET['id'];
		
		echo "Stopped VM ".$id;
		
	}
	else if($do=="restart")
	{
		
		$id=$_GET['id'];
		
		echo "Restarted VM ".$id;
		
	}
	else if($do=="suspend")
	{
		
		$id=$_GET['id'];
		
		echo "Suspended VM ".$id;
		
	}
?>