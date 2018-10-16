<?php 
require '../php_codes/db.php';

$dept=$_POST['depts'];
// $rid=1;

$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,Orders,Cost,NumberOfItemReceived,Status,IDD_Phase,InitialDeliveryDate,Subscription_Date,Subscription_End_Date From Distributor Left Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Inner Join Serial ON Subscription.SerialID=Serial.SerialID ) temp
EOT;

$primary_key='SubscriptionID';

$columns=array(
	array('db'=>'SubscriptionID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'Orders','dt'=>2),
	array('db'=>'Cost','dt'=>3),
	array('db'=>'NumberOfItemReceived','dt'=>4),
	array('db'=>'Status','dt'=>5),
	array('db'=>'IDD_Phase','dt'=>6),
	array('db'=>'InitialDeliveryDate','dt'=>7),
	array('db'=>'Subscription_End_Date','dt'=>8)
);

require( 'ssp.php' );


if($_POST['rid']=="")
{
	echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' AND Subscription_Date IS NULL AND DistributorName='".$dept."'"));
}
else
{
	$rid=$_POST['rid'];
	echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' AND Subscription_Date='".$rid."' AND DistributorName='".$dept."'" ));
}



 ?>
