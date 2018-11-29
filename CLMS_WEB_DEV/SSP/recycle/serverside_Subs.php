<?php 
require '../../php_codes/db.php';
// $rid=1;

$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,Frequency,Cost,Status,IDD_Phase,InitialDeliveryDate,Subscription_Date,Subscription_End_Date,Subscription.Remove as remv,Subscription.Archive as arc From Distributor Left Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Inner Join Serial ON Subscription.SerialID=Serial.SerialID ) temp
EOT;

$primary_key='SubscriptionID';

$columns=array(
	array('db'=>'SubscriptionID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'Frequency','dt'=>2),
	array('db'=>'Cost','dt'=>3),
	array('db'=>'Status','dt'=>4),
	array('db'=>'IDD_Phase','dt'=>5),
	array('db'=>'InitialDeliveryDate','dt'=>6),
	array('db'=>'Subscription_End_Date','dt'=>7)
);

require( '../ssp.php' );

	echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"remv IS NOT NULL AND arc is NULL"));




 ?>
