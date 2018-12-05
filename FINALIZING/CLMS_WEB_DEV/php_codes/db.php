<?php
$serverName = "DESKTOP-QERUPN0\SQLEXPRESS";
$connectionInfo = array( "Database"=>"CLSMS");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

// opt to be able to use the sqlsrv_num_rows you need to SQLSRV_CURSOR_FORWARD cursor type
$opt=array('Scrollable'=>'keyset');

if(!$conn)
{
	die('Cannot Connect To Database');
}

$sql_details=array(
	'db'=>'CLSMS',
	'host'=>'DESKTOP-QERUPN0\SQLEXPRESS'
);

?>