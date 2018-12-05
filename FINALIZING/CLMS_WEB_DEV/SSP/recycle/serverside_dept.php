<?php 
require '../../php_codes/db.php';


$table=<<<EOT
 (Select Department.DepartmentID,STRING_AGG(OrganizationID,', ') as Organizations,Remove,Remove_Remarks from Department Left Join Organization On Department.DepartmentID=Organization.DepartmentID Group By Department.DepartmentID,Remove,Remove_Remarks) temp
EOT;

$primary_key='DepartmentID';

$columns=array(
	array('db'=>'DepartmentID','dt'=>0),
	array('db'=>'Organizations','dt'=>1),
	array('db'=>'Remove_Remarks','dt'=>2)

);

require( '../ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,'Remove IS NOT NULL')
);

 ?>
