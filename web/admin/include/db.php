<?php 
include('mysqlio.php'); 
unset($webdb);
$webdb			=	array();
$webdb['datesite_login']	=	"http://hg84088.com/";
$webdb['user']	=	"haonjnj";
$webdb['pawd']	=	"jiajia";
$webdb['uid']	=	"1";
$sql="select cookie,hg_action from sys_admin";
$query=$mysqlio->query($sql);
$rows	=	$query->fetch_array();
$webdb["cookie"]=$rows['cookie'];
$webdb['datesite']	=	$rows['hg_action'];
?>