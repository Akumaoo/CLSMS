<?php 
require '../php_codes/db.php';

$deptID=$_POST['dept'];

$table=<<<EOT
 (SELECT * from Serial) temp
EOT;

$primary_key='SerialID';

$columns=array(
	array('db'=>'SerialID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'TypeName','dt'=>2),
	array('db'=>'Origin','dt'=>3)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"DepartmentID='".$deptID."'")
);

 ?>
