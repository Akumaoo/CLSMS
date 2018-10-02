<?php
$serverName = "ACER\SQLEXPRESS";
$connectionInfo = array( "Database"=>"CLSMS");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

$opt=array('Scrollable'=>'keyset');

if(!$conn)
{
	die('Cannot Connect To Database');
}
?>