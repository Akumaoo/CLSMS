<?php 
require '../../php_codes/db.php';

$table=<<<EOT
 (Select  ReceivedSerialID,DepartmentID,SerialName,TypeName,Staff_Seen,ReceiveSerial.Status AS RS_Status,Subscription.Status AS Sub_Status,DateReceiveNotif_Give,ReceiveSerial.Remove as rem,ReceiveSerial.Remove_Remarks as remarks from ReceiveSerial Inner Join Serial ON ReceiveSerial.SerialID=Serial.SerialID
Inner Join Subscription On Serial.SerialID=Subscription.SerialID) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'TypeName','dt'=>3),
	array('db'=>'DateReceiveNotif_Give','dt'=>4),
	array('db'=>'Staff_Seen','dt'=>5),
	array('db'=>'remarks','dt'=>6)

);

require( '../ssp.php' );

echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"RS_Status='NotReceived' AND Sub_Status='OnGoing' AND rem IS NOT NULL")
);


 ?>
