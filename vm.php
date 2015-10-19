<?php
include("header.php");
include_once("includes/vzhandler_functions.php");
$id=$_GET['id'];
$vm=mysql_query("SELECT * from vm WHERE id=$id");
$vm=mysql_fetch_array($vm);

if(isset($_GET['action']))
{
	
	$act=$_GET['action'];
	
	if($act=='start')
	{
		echo "<span class='msg'>".startvps($id)."</span>";
	}
	else if($act=='stop')
	{
		echo "<span class='err'>".stopvps($id)."</span>";
	}
	else if($act=='reboot')
	{
		echo "<span class='msg'>".restartvps($id)."</span>";
	}
	
	
}
?>

<div class="thetitle"><?php echo $vm['name']; ?></div>
<div class="status">Status: <span class="<?php

$status=status($id);
//$status="Error";
if($status=="Running")
{
echo 'statuson';
}
else
{
echo 'statusoff';
}
?>"> <?php echo $status; ?></span></div>

<table width="880px" align="center">
<tr class="actions">
<td width="35%" align="center">
  <a href="vm.php?id=<?php echo $_GET['id']; ?>&amp;action=start"><img src="images/on.png" />
<br>
[START]</a></td>

<td width="32%" align="center"><a href="vm.php?id=<?php echo $_GET['id']; ?>&amp;action=stop"><img src="images/off.png" /><br>
  [STOP]</a></td>

<td width="33%" align="center"><a href="vm.php?id=<?php echo $_GET['id']; ?>&amp;action=reboot"><img src="images/offon.png" /><br>
  [RESTART]</a></td>

</tr>
</table>



<table  style="margin-top:50px;" width="880px" align="center">
<tr class="actions">
<td width="17%" class="title">Main IP address:</td>

<td class="text" width="21%"><?php echo $vm['ipaddress']; ?> [<a target="_blank" href="http://<?php echo $vm['ipaddress']; ?>">http</a>]&nbsp;</td>

<td width="62%" >&nbsp;</td>

</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text">&nbsp;</td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text">&nbsp;</td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title"><span class="text">SSH IP:</span></td>
  <td class="text"><?php echo $vm['ipaddress']; ?></td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title"><span class="text">Root Password:</span></td>
  <td class="text"><?php echo $vm['password']; ?></td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text">&nbsp;</td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">PuTTY:</td>
  <td class="text"><a href="putty.exe">Download</a></td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text">&nbsp;</td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text"><a href="makeimage.php?id=<?php echo $id;?>">Create OS Image</a></td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text">&nbsp;</td>
  <td >&nbsp;</td>
</tr>
<tr class="actions">
  <td class="title">&nbsp;</td>
  <td class="text"><a href="#"  onclick="if (confirm('Are you sure you want to delete this VM permanently?') )location.href='index.php?action=delvm&id=<?php echo $id;?>';">Delete</a></td>
  <td >&nbsp;</td>
</tr>
</table>


<?php
include("footer.php");

?>