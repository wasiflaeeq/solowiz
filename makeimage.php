<?php
include("header.php");
include_once("includes/vzhandler_functions.php");
$id=$_GET['id'];
?>
<div class="thetitle">Create sub OS Image</div>
<form action="images.php" method="post">
<table width='800px'>
<tr>
		  <td width="157">Base VM: </td>
        
        <td width="631">&nbsp;<input type="hidden" name="baseid" value="<?php echo $id; ?>"><?php 
		$name=mysql_query("SELECT * FROM vm WHERE id=$id");
		$name=mysql_fetch_array($name);
		echo $name=$name['name'];
		?>&nbsp;</td></tr>
		<tr>
		<tr>
		  <td width="157">New OS Image Name:</td>
        
        <td width="631">&nbsp;<?php echo templatebasename($id);?>-<input name="osname" type="text" id="osname" /></td></tr>
		
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;<input name="createimg" type="submit" value="Create this OS Image" /></td>
		  </tr>
</table>
		
		
</form>


<?php
include("footer.php");

?>