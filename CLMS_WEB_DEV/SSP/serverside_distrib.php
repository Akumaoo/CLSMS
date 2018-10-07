<?php 
require '../php_codes/db.php';

$table=<<<EOT
 (Select * from Distributor) temp
EOT;

$primary_key='DistributorID';

$columns=array(
	array('db'=>'DistributorID','dt'=>0),
	array('db'=>'DistributorName','dt'=>1),
	array('db'=>'NameOfIncharge','dt'=>2),
	array('db'=>'ContactNumber','dt'=>3),
	array('db'=>'Email','dt'=>4)
);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,null )
);

 ?>
