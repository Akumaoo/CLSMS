<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
$id=$input['ReceivedSerialID'];

if($input['action']=='delete')
{
	$sql='Delete From ReceiveSerial Where ReceivedSerialID=?';
	$query=sqlsrv_query($conn,$sql,array($id));
}

echo json_encode($input);
 ?>