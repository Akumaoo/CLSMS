<?php 
require '../php_codes/db.php';

function sanitize($str)
{
	$sanitize_str=htmlentities(str_replace("'","", str_replace('"', '', $str)));

	return $sanitize_str;
}
$sname=sanitize($_POST['sname']);
// $sname='Adventure Box';

$table=<<<EOT
 (Select asd.SubscriptionID as sub,
CONCAT(NumberOfItemReceived,'/',Frequency) AS numrec,
 asd.DepartmentID as dept, SerialName,asd.Remove as remv,asd.Status as stat,dsa.SubscriptionID,Programs,dsa.DepartmentID from 
(Select Categorize_Serials.SubscriptionID,Frequency,NumberOfItemReceived,Department.DepartmentID, SerialName,Subscription.Remove,Subscription.Status from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
Inner Join Department On Categorize_Serials.DepartmentID=Department.DepartmentID
Where SerialName='$sname') as asd Full Join
(Select Category_Serials_Program.SubscriptionID,STRING_AGG(Program.ProgramID,', ') as Programs,Organization.DepartmentID from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
Inner Join Category_Serials_Program On Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID
Inner Join Program On Category_Serials_Program.ProgramID=Program.ProgramID 
Inner Join Organization On Program.OrganizationID=Organization.OrganizationID
Where SerialName='$sname' Group By Category_Serials_Program.SubscriptionID,Organization.DepartmentID) as dsa ON asd.DepartmentID=dsa.DepartmentID
) temp
EOT;

$primary_key='sub';

$columns=array(
	array('db'=>'dept','dt'=>0),
	array('db'=>'Programs','dt'=>1),
	array('db'=>'numrec','dt'=>2)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"stat='OnGoing' AND remv IS NULL")
);

 ?>
