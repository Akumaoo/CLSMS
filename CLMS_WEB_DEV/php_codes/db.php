<?php
$serverName = "DESKTOP-CROM8BD\SQLEXPRESS";
$connectionInfo = array( "Database"=>"CLSMS");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!$conn)
{
	die('Cannot Connect To Database');
}
?>