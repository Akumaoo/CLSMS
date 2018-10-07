<?php 
require '../php_codes/db.php';

$table=<<<EOT
 (Select Package_Delivery.PackageID,DistributorName,PackageName,ReceiveDate,ExpectedReceiveDate,Package_Phase from Package_Delivery Inner join Distributor ON Package_Delivery.DistributorID=Distributor.DistributorID ) temp
EOT;

$primary_key='PackageID';

$columns=array(
	array('db'=>'PackageID','dt'=>0),
	array('db'=>'DistributorName','dt'=>1),
	array('db'=>'PackageName','dt'=>2),
	array('db'=>'ReceiveDate','dt'=>3),
	array('db'=>'ExpectedReceiveDate','dt'=>4),
	array('db'=>'Package_Phase','dt'=>5),
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,"ReceiveDate IS NULL" )
);

 ?>
