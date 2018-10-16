<?php 
require '../php_codes/db.php';

$deptID=$_POST['dept'];

$table=<<<EOT
 (Select Categorize_Serials.SerialID,SerialName,TypeName,DepartmentID  From [Type] Inner Join Serial On [Type].TypeID=Serial.TypeID Inner Join Categorize_Serials On Serial.SerialID=Categorize_Serials.SerialID) temp
EOT;

$primary_key='SerialID';

$columns=array(
	array('db'=>'SerialID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'TypeName','dt'=>2)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"DepartmentID='".$deptID."'")
);

 ?>
