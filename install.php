<?php
include("includes/config.php");
$file_content = file('solowiz.sql');
$query = "";
foreach($file_content as $sql_line){
  if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
    $query .= $sql_line;
    if (substr(rtrim($query), -1) == ';'){
     // echo $query;
      $result = mysql_query($query)or die(mysql_error());
      $query = "";
    }
  }
 }

?>