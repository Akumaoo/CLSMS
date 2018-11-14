<?php 
require '../php_codes/db.php';
$dept=$_POST['dept'];

$table=<<<EOT
 (Select ControlNumber,SerialName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,DepartmentID,ReceiveSerial.Status as RS_STAT from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Inner Join Delivery_Subs On Subscription.SubscriptionID=Delivery_Subs.SubscriptionID) temp
EOT;

$primary_key='ControlNumber';

$columns=array(
	array('db'=>'ControlNumber','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'VolumeNumber','dt'=>2),
	array('db'=>'IssueNumber','dt'=>3),
	array('db'=>'DateofIssue','dt'=>4),
	array('db'=>'Staff_Comment','dt'=>5)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"DepartmentID='".$dept."' AND RS_STAT='Received'" )
);

 ?>
