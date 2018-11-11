<?php 
require '../php_codes/db.php';

$sname=$_POST['sname'];

$table=<<<EOT
 (Select CategoryID,SerialName,Department.DepartmentID,DepartmentName,CONCAT(NumberOfItemReceived,'/',Frequency) AS numrec,Subscription.Status From Department Inner Join Categorize_Serials ON Department.DepartmentID=Categorize_Serials.DepartmentID Inner Join Subscription ON Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID) temp
EOT;

$primary_key='CategoryID';

$columns=array(
	array('db'=>'DepartmentID','dt'=>0),
	array('db'=>'DepartmentName','dt'=>1),
	array('db'=>'numrec','dt'=>2)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"Status='OnGoing' And SerialName='".$sname."'")
);

 ?>
