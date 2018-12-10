<?php 
require '../../php_codes/db.php';

$table=<<<EOT
 (Select Department.DepartmentID as dept,Organization.OrganizationID,STRING_AGG(ProgramID,', ') as Programs,Remove_org from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Inner Join Program On Organization.OrganizationID=Program.OrganizationID Group By Organization.OrganizationID,Department.DepartmentID,Remove_org) temp
EOT;

$primary_key='OrganizationID';

$columns=array(
	array('db'=>'OrganizationID','dt'=>0),
	array('db'=>'Programs','dt'=>1)

);

require( '../ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null," Remove_org IS NOT NULL")
);

 ?>
