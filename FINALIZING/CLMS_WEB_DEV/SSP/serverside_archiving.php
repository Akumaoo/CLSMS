<?php 
require '../php_codes/db.php';


$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,Frequency,Cost,Status,Archive,
(CASE
WHEN Subscription_Date IS NOT NULL
THEN
	(CASE
		WHEN DATEADD(month, DATEDIFF(month, 0, Subscription_Date), 0) BETWEEN DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,Subscription_Date),'-08-01')), 0) AND DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,DATEADD(year,1,Subscription_Date)),'-05-01')), 0)
		THEN CONCAT(DATEPART(YYYY,Subscription_Date),'-',DATEPART(YYYY,DATEADD(year,1,Subscription_Date)))
		ELSE
			CONCAT(DATEPART(YYYY,DATEADD(year,-1,Subscription_Date)),'-',DATEPART(YYYY,Subscription_Date))
			END)
END) as Sub_year

 From Distributor Inner Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Inner Join Serial ON Subscription.SerialID=Serial.SerialID) temp
EOT;

$primary_key='SubscriptionID';

$columns=array(
	array('db'=>'SubscriptionID','dt'=>0),
	array('db'=>'DistributorName','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'Frequency','dt'=>3),
	array('db'=>'Cost','dt'=>4),
	array('db'=>'Sub_year','dt'=>5),
	array('db'=>'Status','dt'=>6),
	array('db'=>'Archive','dt'=>7)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Archive='Archived'" )
);

 ?>
