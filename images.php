<?php
include("header.php");
if(isset($_POST['addimg']))
{
	
	$name=$_POST['osname'];
	$desc=$_POST['desc'];
	
	$logo=$_POST['logo'];
	
if ((($_FILES["osimg"]["type"] == "application/x-gzip") OR ($_FILES["osimg"]["type"] == "application/gzip")))
  {
  if ($_FILES["osimg"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["osimg"]["error"] . "<br />";
    }
  else
    {
   		include_once("includes/vzhandler_functions.php");


      move_uploaded_file($_FILES["osimg"]["tmp_name"],"ostmp/".$_FILES["osimg"]["name"]);
	 
	  $filename=$_FILES["osimg"]["name"];
	  $filename=str_replace(".tar.gz","",$filename);
	  $logo="";
	 $insert="INSERT INTO images SET name='$name', description='$desc', filename='$filename', logo='$logo'";
	  mysql_query($insert);
		echo "<span class='msg'>OS Image Added Successfuly!</span>";
		
		
		
		if ((($_FILES["logo"]["type"] == "image/jpeg") OR ($_FILES["logo"]["type"] == "image/jpg") OR ($_FILES["logo"]["type"] == "image/gif") OR ($_FILES["logo"]["type"] == "image/png") OR ($_FILES["logo"]["type"] == "image/x-png")))
  {
  if ($_FILES["logo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["logo"]["error"] . "<br />";
    }
  else
    {

if($_FILES["logo"]["type"]=="image/jpeg" OR $_FILES["logo"]["type"]=="image/jpg")
{
	$filetype="jpg";	
}
else if($_FILES["logo"]["type"]=="image/gif")
{
	$filetype="gif";	
}
else if($_FILES["logo"]["type"]=="image/png" OR $_FILES["logo"]["type"]=="image/x-png")
{
	$filetype="png";
	
}


	$id=mysql_query("SELECT * FROM images WHERE name='$name' AND description='$desc' AND filename='$filename' ORDER BY id DESC");
	$id=mysql_fetch_array($id);
	$id=$id['id'];
	$filetype=strtolower($filetype);
	$saveto="logos/" . $id.".jpg";
	move_uploaded_file($_FILES["logo"]["tmp_name"],$saveto);
	chmod($saveto,0777);
	$filename=$saveto;
// Set a maximum height and width
$width=93;
$height=107;

// Content type



// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

$ratio_orig = $width_orig/$height_orig;

if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}

// Resample
$image_p = imagecreatetruecolor($width, $height);
if($filetype=="jpg")
$image = imagecreatefromjpeg($filename);
else if($filetype=="gif")
{
$image = imagecreatefromgif($filename);


$colorTransparent = imagecolortransparent($image);
imagepalettecopy($image, $image_p);
imagefill($image_p, 0, 0, $colorTransparent);
imagecolortransparent($image_p, $colorTransparent);

imagetruecolortopalette($image_p, true, 256);

}
else if($filetype=="png")
{
$image = imagecreatefrompng($filename);
$colorTransparent = imagecolortransparent($image);
imagepalettecopy($image, $image_p);
imagefill($image_p, 0, 0, $colorTransparent);
imagecolortransparent($image_p, $colorTransparent);

imagetruecolortopalette($image_p, true, 256);


}
else if($filetype=="bmp")
$image = imagecreatefromwbmp($filename);

imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output


imagejpeg($image_p,$saveto);
	
	imagedestroy($image_p);


imagedestroy($image);
	
	$logo=$id.".jpg";

	mysql_query("UPDATE images SET logo='$logo' WHERE id=$id");





	}}}


		
		
		
    doexecute("mv $dir/ostmp/* /vz/template/cache/"); 
    
  }
else
  {
  		echo "<span class='err'>Wrong OS File</span>";

  }
  
	
	
}




	
	


	
	if(isset($_POST['baseid'])){
		include_once("includes/vzhandler_functions.php");
		$parent=$_POST['baseid'];
		$newname=$_POST['osname'];
		createtemplate($newname,$parent);
		
		
		}
	
if(isset($_GET['delimg']))
{
	
	include_once("includes/vzhandler_functions.php");
	
$imgid=$_GET['id'];
$img=mysql_query("SELECT * FROM images WHERE id=$imgid");
$img=mysql_fetch_array($img);
$filename=$img['filename'];
doexecute("rm -f /vz/template/cache/".$filename.".tar.gz");
mysql_query("DELETE FROM images WHERE id=$imgid");
echo "OS Image Deleted Successfully!";	
	
}

?>
<div class="thetitle"><?php if(isset($_GET['addvm'])){echo "Create a new VM";}else{echo 'OS Images <span class="links"><a href="addimage.php">Add New OS Image</a></span>';}?></div>
<?php if(isset($_GET['addvm'])){echo'<div> click on an OS Images to create a VM based on that Image </div>'; } ?>
<table width='800px'>
		<tr>
        <td>
		<?php
		$vms=mysql_query("SELECT * from images");
		while($vm=mysql_fetch_array($vms))
		{
			?>
		<div class="actions" style="width:150px; height:210px; float:left; text-align:center">
			<div style="height:100px;"><a href="createvm.php?ost=<?php echo $vm[id]; ?>"><img  src="logos/<?php if($vm['logo']=="") echo 'default.jpg'; else echo $vm['logo']; ?>" /></div> </a><br />
<span style="color:#F30">[<a onclick="if (confirm('Are you sure you want to delete this OS Image permanently?') )location.href='images.php?delimg=delimg&id=<?php echo $vm['id'];?>';" href="#">x</a>]</span>
            <?php echo $vm['name']; ?><br />

            <span style="font-size:12px"><?php echo $vm['filename']; ?></span>
            </a>
            </div>
			
		<?php	
		}
		if(mysql_num_rows($vms)<=0){
			
			?>
           <span class="notfound"> No OS Images Found, Please add one by <a href="addimage.php">clicking here</a></span>
            <?php
			
			
			}
		?>
        </td></tr>
</table>
		
		



<?php
include("footer.php");

?>