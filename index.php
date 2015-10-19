<?php
include("header.php");
if(isset($_POST['cvm']))
{
	 $tid=$_POST['tempid'];
	$host=$_POST['hostname'];
	$pass=$_POST['password'];
	$disk=$_POST['disk'];
	$ipid=$_POST['ip'];
	$ip=mysql_query("SELECT * FROM ips WHERE id=$ipid");
	$ip=mysql_fetch_array($ip);
	$ip=$ip['ip'];
	
	echo"<span class='msg'>";
	include_once("includes/vzhandler_functions.php");
	createvps($host,$tid,$ip,$disk,$pass);
echo "</span>";
	
}else if(isset($_GET['action']) && $_GET['action']=='delvm')
{
	$id=$_GET['id'];
	include_once("includes/vzhandler_functions.php");
	deletevps($id);
	
	echo "<span class='msg'>VM Delete Successfuly</span>";
	
}

?>

<div class="thetitle">Virtual Machines <span class="links"><a href="images.php?addvm">Add New VM</a></span></div>
<table width='939'>
		<tr style='font-weight:bold;'> <td width="50">VMid</td> <td width="206">Hostname</td> <td width="374">Operating System</td> <td width="150">Current State [<a href="index.php?status">update</a>]</td> </tr>
		
		<?php
		$vms=mysql_query("SELECT * from vm");
		while($vm=mysql_fetch_array($vms))
		{
			if(isset($_GET['status']))
			{
				include_once("includes/vzhandler_functions.php");
				$id=$vm['id'];
				$status=status($id);
				mysql_query("UPDATE vm SET state='$status' WHERE id=$id");
				$vm['state']=$status;
			}

			
			?>
		
			<tr>
			<td>
			<?php echo $vm[id]; ?>
			</td>
			<td>
			<a  href="vm.php?id=<?php echo $vm[id]; ?>"><?php echo $vm[name]; ?></a>
			</td>
			<td>
			<?php echo $vm[os]; ?>
			</td>
			<td>
			<?php echo $vm[state]; ?>
			</td>
			</tr>
		<?php	
		}
			if(mysql_num_rows($vms)<=0){
			
			?>
           <span class="notfound"> No Virtual Machines Found, Please add one by <a href="images.php?addvm">clicking here</a></span>
            <?php
			
			
			}
	
		?>
</table>
		
		



<?php
include("footer.php");

?>