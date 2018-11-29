<?php 
require '../php_codes/db.php';

$table=<<<EOT
(Select *  FROM
	(Select Distributor.DistributorID AS DistributorID,DistributorName AS DistributorName,
		(CASE
			WHEN Subscription_Date IS NOT NULL
			THEN
			(CASE
			WHEN DATEADD(month, DATEDIFF(month, 0, Subscription_Date), 0) BETWEEN DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,Subscription_Date),'-08-01')), 0) AND DATEADD(month, DATEDIFF(month, 0, CONCAT(DATEPART(YYYY,DATEADD(year,1,Subscription_Date)),'-05-01')), 0)
			THEN CONCAT(DATEPART(YYYY,Subscription_Date),'-',DATEPART(YYYY,DATEADD(year,1,Subscription_Date)))
			ELSE
				CONCAT(DATEPART(YYYY,DATEADD(year,-1,Subscription_Date)),'-',DATEPART(YYYY,Subscription_Date))
			 END)
		END)
		 AS Subscription_Year
		,Status,Subscription.Remove as remv from Distributor Inner Join Subscription ON Distributor.DistributorID=Subscription.DistributorID Group By Distributor.DistributorID,Subscription_Date,DistributorName,Status,Subscription.Remove) AS SUB GROUP BY Subscription_Year,SUB.DistributorID,SUB.DistributorName,SUB.Status,SUB.remv) temp
EOT;

$primary_key='DistributorID';

$columns=array(
	array('db'=>'DistributorName','dt'=>0),
	array('db'=>'Subscription_Year','dt'=>1)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' AND remv IS NULL")
);

 ?>
