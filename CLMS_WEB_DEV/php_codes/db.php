<?php
$serverName = "DESKTOP-QERUPN0\SQLEXPRESS";
$connectionInfo = array( "Database"=>"CLSMS");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn)
{
	die('Cannot Connect To Database');
}
?>