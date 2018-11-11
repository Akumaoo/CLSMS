<?php 
require '../php_codes/db.php';


$table=<<<EOT
 (SELECT * from Department) temp
EOT;

$primary_key='DepartmentID';

$columns=array(
	array('db'=>'DepartmentID','dt'=>0),
	array('db'=>'DepartmentName','dt'=>1)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,null)
);

 ?>
