<?php 
require '../php_codes/db.php';


$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,Orders,Cost,NumberOfItemReceived,Status,Archive,Subscription_Date From Distributor Inner Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Inner Join Serial ON Subscription.SerialID=Serial.SerialID) temp
EOT;

$primary_key='SubscriptionID';

$columns=array(
	array('db'=>'SubscriptionID','dt'=>0),
	array('db'=>'DistributorName','dt'=>2),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'Orders','dt'=>3),
	array('db'=>'Cost','dt'=>4),
	array('db'=>'NumberOfItemReceived','dt'=>5),
	array('db'=>'Subscription_Date','dt'=>6),
	array('db'=>'Status','dt'=>7),
	array('db'=>'Archive','dt'=>8)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Archive='Archived'" )
);

 ?>
