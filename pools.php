<?php
include("header.php");
include("includes/ip.php");
if(isset($_POST['addips']))
{
	$ip=$_POST['ip'];
	$netmask=$_POST['netmask'];
	generateips($ip,$netmask);
	
	
}
else if(isset($_GET['action']) && $_GET['action']=='delpool')
{
	$pid=$_GET['id'];
/////////check if IP any IP of this pool is assigned to any VM
$checkip=mysql_query("SELECT vm.id as vmid, vm.name as vmname FROM vm,ips WHERE vm.ipaddress=ips.ip AND poolid=$pid");
if(mysql_num_rows($checkip)>0)
{
	
echo "You can not delete this IP pool because IP's of this pool are assigned to following virtual machines <br />";
	
}
else
{
	
	mysql_query("DELETE FROM ips WHERE poolid=$pid");
		mysql_query("DELETE FROM ippools WHERE id=$pid");
		echo "IP Pool Delete Successfuly!";
	
}
while($ip=mysql_fetch_array($checkip))
	{
		echo "<a href='vm.php?id=".$ip['vmid']."'>".$ip['vmname']."</a><br />";
		
		
		
}
		

}
	


?>
<style type="text/css">
<!--
.d {
	font-size: 9px;
}
-->
</style>

<div class="thetitle">IP Pools<span class="links"><a href="addpool.php">Add IP Pool</a></span></div>
<table width='922'>
		<tr style='font-weight:bold;'> <td width="104">NetID</td> <td width="117">Subnet Mask</td> <td width="130">Gateway IP</td> <td width="146">Primary DNS</td> <td width="207"> Secondary DNS</td>
		  <td colspan='3'>Actions</td>
        </tr>
		
		<?php
		$pools=mysql_query("SELECT * from ippools");
		while($pool=mysql_fetch_array($pools))
		{
			?>
		
			<tr>
			<td>
			<?php echo $pool[netid]; ?>
			</td>
			<td>
			<?php echo $pool[netmask]; ?>
			</td>
			<td>
			<?php echo $pool[gateway]; ?>
			</td>
			<td>
			<?php echo $pool[dns1]; ?>
			</td>
			<td>
			<?php echo $pool[dns2]; ?></td>
			<td width="98" class="d">
			  <a href="ips.php?pid=<?php echo $pool[id]; ?>">View IPs</a></td>

			<td width="88" class="d"><a href="#"  onclick="if (confirm('Are you sure you want to delete this IP Pool?') )location.href='pools.php?action=delpool&id=<?php echo $pool['id'];?>';">Delete</a></td>
			</tr>
		<?php	
		}
		?>
</table>
		
		



<?php
include("footer.php");

?>