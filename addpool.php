<?php
include("header.php");

?>
<div class="thetitle">Add an IP address Pool</div>
<form action="pools.php" method="post">
<table width='800px'>
		<tr>
		  <td width="157">IP address:</td>
        
        <td width="631">&nbsp;<input checkthis="ip" name="ip" type="text" id="ip" />
          [You can enter any IP address from your IP pools assigned by your Network]</td></tr>
		<tr>
		  <td>Subnet Mask:</td>
		  <td>&nbsp;<input  name="netmask" type="text" id="netmask" /> 
		    [ex: 255.255.255.248]</td>
  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;<input id="mysubmit" name="addips" type="submit" value="Add Pool"></td>
	    </tr>
</table>
		
		
</form>


<?php
include("footer.php");

?>