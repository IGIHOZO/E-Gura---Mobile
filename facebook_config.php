<?php
$domain = $_SERVER['DOCUMENT_ROOT'];
if ($domain=="/home/eguraco1/mobile.e-gura.com") {
	require_once("/home/eguraco1/public_html/vendor/autoload.php");
}else{
	require_once("vendor/autoload.php");
}
if (!session_id()) 
{
	session_start();
}

$facebook = new \Facebook\Facebook([
	'app_id'	=>   '661336524468482',
	'app_secret'=>	 'b0449b1660772a8689ea82834ac4b447',
	'default_graph_version'  => 'v2.10'
]);
?>