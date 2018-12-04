<?php 
require '../php_codes/db.php';

$dept=$_POST['depts'];
// $rid=1;

$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,Frequency,Cost,Status,IDD_Phase,InitialDeliveryDate,Subscription_Date,Subscription_End_Date,Subscription.Remove,Subscription.Archive as arc From Distributor Left Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Inner Join Serial ON Subscription.SerialID=Serial.SerialID ) temp
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

require( 'ssp.php' );


if($_POST['rid']=="")
{
	echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' AND Subscription_Date IS NULL AND DistributorName='".$dept."' AND Remove IS NULL AND arc is NULL"));
}
else
{
	$rid=$_POST['rid'];
	echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' AND ((Subscription_Date BETWEEN LEFT('".$rid."',4) AND RIGHT('".$rid."',4)) Or Status='OnGoing') AND DistributorName='".$dept."' AND Remove IS NULL AND arc is NULL" ));
}



 ?>
