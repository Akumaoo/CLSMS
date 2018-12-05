<?php 
require '../php_codes/db.php';
$dept=$_POST['dept'];

$table=<<<EOT
 (Select Department.DepartmentID as dept,Organization.OrganizationID,STRING_AGG(ProgramID,', ') as Programs from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Inner Join Program On Organization.OrganizationID=Program.OrganizationID Group By Organization.OrganizationID,Department.DepartmentID) temp
EOT;

$primary_key='OrganizationID';

$columns=array(
	array('db'=>'OrganizationID','dt'=>0),
	array('db'=>'Programs','dt'=>1)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"dept='".$dept."'")
);

 ?>
