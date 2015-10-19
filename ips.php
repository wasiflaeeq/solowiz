<?php
include("header.php");
include("includes/ip.php");
if(isset($_POST['addips']))
{
	$ip=$_POST['ip'];
	$netmask=$_POST['netmask'];
	generateips($ip,$netmask);
	
	
}
else if(isset($_POST['updatens']))
{
	$dns1=$_POST['dns1'];
	$dns2=$_POST['dns2'];
$poolid=$_GET['pid'];

mysql_query("UPDATE ippools SET dns1='$dns1', dns2='$dns2' WHERE id=$poolid");

	
	
}
else if(isset($_GET['reserve']))
{
	$rid=$_GET['reserve'];
	
	mysql_query("UPDATE ips SET reserved=1 WHERE id=$rid");
	
	
}
else if(isset($_GET['unreserve']))
{
	$rid=$_GET['unreserve'];
	
	mysql_query("UPDATE ips SET reserved=0 WHERE id=$rid");
	
	
}

	


?>
<style type="text/css">
<!--
.d {
	font-size: 9px;
}
-->
</style>
<?php
$pid=$_GET['pid'];
$pool1=mysql_query("SELECT * from ippools WHERE id=$pid");
$pool=mysql_fetch_array($pool1);
		
?>
<div class="thetitle"><a href="pools.php">IP Pools</a> >> <?php echo $pool[netid]; ?> <span class="links"><a href="addpool.php">Add IP Pool</a></span></div>
<table width='800px'>
		<tr style='font-weight:bold;'> <td width="105">NetID</td> <td width="117">Subnet Mask</td> <td width="129">Gateway IP</td> <td width="147">Primary DNS</td> <td width="128"> Secondary DNS</td>
		  <td colspan='3'>&nbsp;</td>
        </tr>
		
	
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
            <form name="updatens" action="<?php echo $_SERVER['PHP_SELF']."?pid=$pid"; ?>" method="post">
			<input type="text" name="dns1" value="<?php echo $pool[dns1]; ?>" />
			</td>
			<td>
						<input type="text" name="dns2" value="<?php echo $pool[dns2]; ?>" />
			<td width="48" class="d">&nbsp;<input type="submit" value="Update DNS" name="updatens" /></form></td>
			<td width="48" class="d">&nbsp;</td>
			<td width="42" class="d">&nbsp;</td>
			</tr>
		
</table>
	<table style="margin-top:40px;" width='800px'>
    
    <?php
	
	$ips=mysql_query("SELECT * FROM ips WHERE poolid=$pid");
	while($ip=mysql_fetch_array($ips))
	{
	?>	
		<tr>
        <td>&nbsp;
        <?php echo $ip[ip]; ?>
        </td>
                <td><?php
		$vmid=$ip[vmid];
		if($vmid==0)
		{
			if($ip['reserved']==0)
			{

		echo "Free IP [<a href='ips.php?pid=".$_GET['pid']."&reserve=".$ip['id']."'>Reserve</a>]";	
			}
			else
			{
			echo "Reserved IP [<a href='ips.php?pid=".$_GET['pid']."&unreserve=".$ip['id']."'>Unreserve</a>]";	
			}
		}
		else
		{
			
		$vm=mysql_query("SELECT name FROM vm WHERE id=$vmid");
		$vm=mysql_fetch_array($vm);
		echo "<a href='vm.php?id=$vmid'>$vm[name]</a>";
			
		}
		?></td>
        
        </tr>
		
		
		<?php
		
	}
    
    ?>

</table>	
		



<?php
include("footer.php");

?>