<?php 
require '../php_codes/db.php';
$date=date('Y');

$table=<<<EOT
 (Select DeliveryID,DistributorName,SerialName,DateofIssue,VolumeNumber,Copies,Receive_Date,IssueNumber,Status from Delivery Inner Join Serial ON Delivery.SerialID=Serial.SerialID inner join Subscription ON Subscription.SerialID=Serial.SerialID Inner Join Distributor On Subscription.DistributorID=Distributor.DistributorID) temp
EOT;

$primary_key='DeliveryID';

$columns=array(
	array('db'=>'DeliveryID','dt'=>0),
	array('db'=>'DistributorName','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'DateofIssue','dt'=>3),
	array('db'=>'VolumeNumber','dt'=>4),
	array('db'=>'IssueNumber','dt'=>5),
	array('db'=>'Copies','dt'=>6),
	array('db'=>'Receive_Date','dt'=>7)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Receive_Date>='".$date."' AND Status='OnGoing'" )
);

 ?>
