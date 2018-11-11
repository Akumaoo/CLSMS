<?php 
require '../php_codes/db.php';

$data=$_POST['data'];

$table=<<<EOT
 (Select  ReceivedSerialID,DepartmentID,SerialName,TypeName,ReceiveSerial.Status AS RS_Status,Subscription.Status AS Sub_Status from ReceiveSerial Inner Join Serial ON ReceiveSerial.SerialID=Serial.SerialID
Inner Join Subscription On Serial.SerialID=Subscription.SerialID) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'TypeName','dt'=>3)

);

require( 'ssp.php' );
if($data!="")
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"RS_Status='Received' AND Sub_Status='OnGoing' AND DepartmentID='".$data."'")
	);
}
else
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"RS_Status='Received' AND Sub_Status='OnGoing'")
	);
}

 ?>
