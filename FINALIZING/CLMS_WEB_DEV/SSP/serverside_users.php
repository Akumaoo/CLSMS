<?php 
require '../php_codes/db.php';


$table=<<<EOT
 (SELECT * from [User]) temp
EOT;

$primary_key='UserID';

$columns=array(
	array('db'=>'UserID','dt'=>0),
	array('db'=>'UserName','dt'=>1),
	array('db'=>'FirstName','dt'=>2),
	array('db'=>'LastName','dt'=>3),
	array('db'=>'Email','dt'=>4),
	array('db'=>'Role','dt'=>5),
	array('db'=>'DepartmentID','dt'=>6)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,'Remove IS NULL')
);

 ?>
