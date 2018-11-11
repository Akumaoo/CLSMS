<?php 
require '../php_codes/db.php';

$disb=$_POST['disb'];
$phase=$_POST['phase'];

$table=<<<EOT
 (Select SubscriptionID,DistributorName,SerialName,InitialDeliveryDate,Subscription.Status AS Sub_stat,IDD_Phase from Distributor Inner Join Subscription On Distributor.DistributorID=Subscription.DistributorID Inner Join Serial On Subscription.SerialID=Serial.SerialID) temp
EOT;

$primary_key='SubscriptionID';

$columns=array(
	array('db'=>'SubscriptionID','dt'=>0),
	array('db'=>'DistributorName','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'InitialDeliveryDate','dt'=>3),
	array('db'=>'Sub_stat','dt'=>4)

);

require( 'ssp.php' );
if($disb!="")
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"InitialDeliveryDate<CONVERT(VARCHAR(10), GETDATE(), 110) AND Sub_stat='OnGoing' AND IDD_Phase='".$phase."' And DistributorName='".$disb."'")
	);
}
else
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"InitialDeliveryDate<CONVERT(VARCHAR(10), GETDATE(), 110) AND Sub_stat='OnGoing' AND IDD_Phase!='Complete'")
	);
}

 ?>
