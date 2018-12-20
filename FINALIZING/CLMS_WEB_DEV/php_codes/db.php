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

// ***IF ONLINE WITH USER AUTH***

// $serverName = "den1.mssql7.gear.host";
// $connectionInfo = array( "Database"=>"clsms", "UID"=>"clsms", "PWD"=>"Vq3MB7_2_TVd");
// $conn = sqlsrv_connect( $serverName, $connectionInfo);

// // opt to be able to use the sqlsrv_num_rows you need to SQLSRV_CURSOR_FORWARD cursor type
// $opt=array('Scrollable'=>'keyset');

// if(!$conn)
// {
// 	die('Cannot Connect To Database!!!');
// }

// $sql_details=array(
// 	'db'=>'clsms',
// 	'host'=>'den1.mssql7.gear.host',
// 	'user'=>'clsms',
// 	'pass'=>'Vq3MB7_2_TVd'
// );

?>