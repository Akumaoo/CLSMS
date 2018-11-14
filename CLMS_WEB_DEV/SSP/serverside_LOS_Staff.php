<?php 
require '../php_codes/db.php';

$deptID=$_POST['dept'];

$table=<<<EOT
 (Select CategoryID,SerialName,CONCAT(NumberOfItemReceived,'/',Frequency) as deliv_stat,Usage_Stat,DepartmentID,Status,TypeName from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID ) temp
EOT;

$primary_key='CategoryID';

$columns=array(
	array('db'=>'CategoryID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'TypeName','dt'=>2),
	array('db'=>'deliv_stat','dt'=>3),
	array('db'=>'Usage_Stat','dt'=>4)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' And DepartmentID='".$deptID."'")
);

 ?>
