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

$date_today=date('Y-m-d');
$c_year=date('Y');
$sub_date=$c_year.'-08-01';

if($date_today<$sub_date)
{
	$bet="DATEADD(YEAR,-1,CONCAT(DATEPART(YYYY,GETDATE()),'-08-01'))  AND  CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')";
}
else
{
	$bet="CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))";
}

?>