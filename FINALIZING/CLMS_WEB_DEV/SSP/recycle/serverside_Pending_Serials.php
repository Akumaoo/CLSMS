<?php 
require '../../php_codes/db.php';

$table=<<<EOT
 (Select SerialName,ReceivedSerialID,ReceiveSerial.DepartmentID,DateReceiveNotif_Give,Staff_Seen,ReceiveSerial.Remove as remv_main,ReceiveSerial.Remove_Remarks
 from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status='NotReceived' And ReceiveSerial.Remove IS NOT NULL) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'DateReceiveNotif_Give','dt'=>3),
	array('db'=>'Staff_Seen','dt'=>4),
	array('db'=>'Remove_Remarks','dt'=>5)

);

require( '../ssp.php' );

echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
);


 ?>
