<?php
include("header.php");

?>
<div class="thetitle">Add new OS Image</div>
<form action="images.php" enctype="multipart/form-data" method="post">
<table width='800px'>
		<tr>
		  <td width="157">Name:</td>
        
        <td width="631">&nbsp;<input name="osname" type="text" id="osname" /></td></tr>
		<tr>
		  <td>Description:</td>
		  <td>&nbsp;<textarea name="desc" id="desc"></textarea></td>
  </tr>
		<tr>
		  <td>OS file:</td>
		  <td>&nbsp;<input name="osimg" type="file" id="osimg" /> <span style="font-size:13px">name MUST be in the form osname-version-arch-type.tar.gz  &nbsp; &nbsp; example: centos-5.4-x86-wordpress.tar.gz</span></td>
	    </tr>
        <tr>
		  <td>Logo</td>
		  <td>&nbsp;<input name="logo" type="file" id="logo" /> <span style="font-size:13px">OPTIONAL</span></td>
	    </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;<input name="addimg" type="submit" value="Add this OS Image" /></td>
		  </tr>
</table>
		
		
</form>


<?php
include("footer.php");

?>