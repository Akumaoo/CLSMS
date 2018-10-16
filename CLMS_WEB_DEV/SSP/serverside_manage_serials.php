<?php 
require '../php_codes/db.php';


$table=<<<EOT
 (SELECT DISTINCT CS2.SerialID,SerialName,TypeName, 
							    SUBSTRING(
							        (
							            SELECT ', '+CS1.DepartmentID  AS [text()]
							            FROM Categorize_Serials CS1
										WHERE CS1.SerialID=CS2.SerialID
							            ORDER BY CS1.SerialID
							            FOR XML PATH ('')
							        ), 2, 1000) [Departments]
							FROM Categorize_Serials CS2 Inner JOIN Serial ON CS2.SerialID=Serial.SerialID LEFT Join [Type] ON Serial.TypeID=[Type].TypeID) temp
EOT;

$primary_key='SerialID';

$columns=array(
	array('db'=>'SerialID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'TypeName','dt'=>2),
	array('db'=>'Departments','dt'=>3)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_GET, $sql_details, $table, $primary_key, $columns,null,null)
);

 ?>
