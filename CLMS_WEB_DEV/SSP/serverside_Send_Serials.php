<?php 
require '../php_codes/db.php';

$table=<<<EOT
 (Select ReceivedSerialID,DepartmentID,SerialName,Status,DateReceiveNotif_Give,RS_Seen,TypeName from ReceiveSerial INNER JOIN Serial ON ReceiveSerial.SerialID=Serial.SerialID Inner Join [Type] On Serial.TypeID=[Type].TypeID) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'TypeName','dt'=>3),
	array('db'=>'DateReceiveNotif_Give','dt'=>4),
	array('db'=>'RS_Seen','dt'=>5),
	array('db'=>'Status','dt'=>6)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Status='NotReceived'" )
);

 ?>
