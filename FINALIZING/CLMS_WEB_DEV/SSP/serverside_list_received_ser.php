<?php 
require '../php_codes/db.php';

function sanitize($str)
{
	$sanitize_str=htmlentities(str_replace("'","", str_replace('"', '', $str)));

	return $sanitize_str;
}

$dept=sanitize($_POST['dept']);


$table=<<<EOT
 	(Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment
  from Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID  Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
		Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE (Subscription_Date Between $bet OR Subscription.Status='OnGoing') AND Receive_Date=DateReceiveNotif_Give And ReceiveSerial.Remove IS NULL AND ReceiveSerial.Status='Received' AND ReceiveSerial.DepartmentID='$dept') temp
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
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"" )
);

 ?>
