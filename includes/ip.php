<?php

include_once("config.php");




function netmaskok($netmask)
{

$test=decbin($netmask);

$last1=strrpos($test,"1");
$test=substr($test,0,$last1+1);
if(strpos($test,"0"))
{
return FALSE;

}
else
{

return TRUE;
}



}

function makeoctet($ip,$netmask)
{


if(netmaskok($netmask)==FALSE)
{

return FALSE;

}

$ip=decbin($ip);


$iplen=strlen($ip);
for($iplen;$iplen<=7;$iplen++)
{

$ip="0".$ip;



}



$last=1;
$dec=decbin($netmask);





 $last1=strrpos($dec,"1")+1;

$beforelast1=substr($dec,0,$last1);



if($netmask<128 && $netmask!=0 && $netmask>255)
{
//strpos($beforelast1,"0")==0 && $dec!="0" && $last1!=1
return FALSE;

}


$bl=strlen($beforelast1);
$al=8-$bl;

$fix=substr($ip,0,$bl);
$start=$fix;
$end=$fix;

for($n=1; $n<=$al;$n++)
{

$start=$start."0";



}





for($n=1; $n<=$al;$n++)
{

$end=$end."1";

}



if($dec=="0")
{
$end="11111111";
$start="00000000";
}


$start=bindec($start);
$end=bindec($end);

$data['start']=$start;
$data['end']=$end;
return $data;

}

$ip="192.168.1.1";
$netmask="255.255.0.0";

function getips($ip,$netmask)
{

$ips=explode(".",$ip);
$netmasks=explode(".",$netmask);

$n=0;
while($n<4)
{

 $ip=$ips[$n];
 $netmask=$netmasks[$n];

$ret[$n]=makeoctet($ip,$netmask);
if($ret[$n]==FALSE)
{

return False;
}
$n++;
}

$ret1['start']=$ret[0]['start'].".".$ret[1]['start'].".".$ret[2]['start'].".".$ret[3]['start'];
$ret1['end']=$ret[0]['end'].".".$ret[1]['end'].".".$ret[2]['end'].".".$ret[3]['end'];
return $ret1;

}

function generateips($ip,$netmask)
{
	@@include_once("config.php");
$netmask1=$netmask;
$ips=explode(".",$ip);
$netmasks=explode(".",$netmask);

$n=0;
while($n<4)
{

 $ip=$ips[$n];
 $netmask=$netmasks[$n];

$ret[$n]=makeoctet($ip,$netmask);
if($ret[$n]==FALSE)
{

return False;
}
$n++;
}

$a1=$ret[0]['start'];
$b1=$ret[1]['start'];
$c1=$ret[2]['start'];
$d1=$ret[3]['start'];
$a2=$ret[0]['end'];
$b2=$ret[1]['end'];
$c2=$ret[2]['end'];
$d2=$ret[3]['end'];
$netid=0;
$query="INSERT INTO ips(ip,poolid) VALUES";
$len=0;
while( $d2 >= $d1 || $c2 > $c1 || $b2 > $b1 || $a2 > $a1){
if($d1 > 255){
$d1 = 1;
$c1 ++;
}
if($c1 > 255){
$c1 = 1;
$b1 ++;
}
if($b1 > 255){
$b1 = 1;
$a1 ++;
}
$ip="$a1.$b1.$c1.$d1";
if($netid==0)
{
$gateway=0;
$netid=$ip;
	
}
elseif($gateway==0)
{
$gateway=$ip;

	mysql_query("INSERT INTO ippools SET netid='$netid',netmask='$netmask1',gateway='$gateway'");
	$pid=mysql_query("SELECT * from ippools WHERE netid='$netid' AND netmask='$netmask1' AND gateway='$gateway' order by id desc");
	$pid=mysql_fetch_array($pid);
	$pid=$pid['id'];
}
else
{
	$query.="('$ip','$pid'),";
	$len++;
	if($len==100)
	{
		$lastcomma=strrpos($query,",");
$query=substr($query,0,$lastcomma);
mysql_query($query);
echo mysql_error();
$query="INSERT INTO ips(ip,poolid) VALUES";
	$len=0;	
		
	}
}


$d1 ++;
}


//echo $query;

$lastcomma=strrpos($query,",");
$query=substr($query,0,$lastcomma);
mysql_query($query);
echo mysql_error();
mysql_query("DELETE from ips WHERE ip='$ip'");
}






?>
