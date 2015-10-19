<?php
include("header.php");
$id=$_GET['ost'];
$sql=mysql_query("SELECT * from images WHERE id=$id");
$os=mysql_fetch_array($sql);



?>
<div class="thetitle">Create a New VM</div>
<form name="addvm" action="index.php" method="post">
<table width='800px'>
		<tr>
		  <td width="157">OS Template Selected:</td>
        
        <td width="631"><div style="width:150px; float:left; text-align:center">
			<img src="logos/<?php if($os[logo]=="") echo 'default.jpg'; else echo $os[logo]; ?>" /><br />

            <?php echo $os[name]; ?>
         
            </div>
            <input type="hidden" name="tempid" value="<?php echo $id; ?>"/>
  <br></td></tr>
		<tr>
		  <td>Hostname:</td>
		  <td>&nbsp;<input type="text" name="hostname" /></td>
  </tr>
		<tr>
		  <td>Root Password:</td>
		  <td>&nbsp;<input type="password" name="password" /></td>
  </tr>
		<tr>
		  <td>Disk Space:</td>
		  <td>&nbsp;
		    <select name="disk">
		      <option value="2"> 2GB </option>
		      <option value="5"> 5GB </option>
		      <option value="10"> 10GB </option>
		      <option value="20"> 20GB </option>
		      <option value="25"> 25GB </option>
		      <option value="40"> 40GB </option>
		      <option value="50"> 50GB </option>
		      <option value="60"> 60GB </option>
		      <option value="100"> 100GB </option>
		      <option value="125"> 125GB </option>
		      <option value="150"> 150GB </option>
          </select></td>
  </tr>
		<tr>
		  <td>IP address:</td>
		  <td>&nbsp;<?php
          $ips=mysql_query("SELECT * FROM ips WHERE vmid=0 AND reserved=0");
		  echo '<select name="ip">';
		  while($ip=mysql_fetch_array($ips))
		  	  {		
					$ipid=$ip['id'];
					$ipadd=$ip['ip'];
						echo "<option value='$ipid'> $ipadd </option>";
						
						
					
			
				
				  
			  }
			  	echo '</select>';
			  
		  
		  
		  
		  ?></td>
  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td><input type="submit" value="Create VM based on above Information" name="cvm" />
		  &nbsp;[May take 5 to 10 minutes to create a VM]</td>
    </tr>
</table>
		</form>
		



<?php
include("footer.php");

?>