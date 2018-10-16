<?php 
require '../php_codes/db.php';

$table=<<<EOT
 (Select Max(Distributor.DistributorID) AS DistributorID,Max(DistributorName) AS DistributorName,MAX(Subscription_Date) AS Subscription_Date,Max(Status) as Status from Distributor Left Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Group By Distributor.DistributorID,Subscription_Date) temp
EOT;

$primary_key='DistributorID';

$columns=array(
	array('db'=>'DistributorName','dt'=>0),
	array('db'=>'Subscription_Date','dt'=>1)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing'")
);

 ?>
