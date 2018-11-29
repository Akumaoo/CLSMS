<?php 
require '../php_codes/db.php';

$sname=$_POST['sname'];
// $sname='Adventure Box';

$table=<<<EOT
 (Select asd.SubscriptionID as sub,
CONCAT(NumberOfItemReceived,'/',
(CASE 
		When Programs IS NULL
		THEN 
			(Frequency)
		ELSE
			(Frequency*(Select Count(*) as nums from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
			Inner Join Category_Serials_Program On Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID
			Inner Join Program On Category_Serials_Program.ProgramID=Program.ProgramID Where SerialName='$sname'))
		END 
)) AS numrec,
asd.DepartmentID as dept, SerialName,asd.Remove as remv,asd.Status as stat,dsa.SubscriptionID,Programs,NumberofItemsReceived_Prog,dsa.DepartmentID from 
(Select Categorize_Serials.SubscriptionID,Frequency,NumberOfItemReceived,Department.DepartmentID, SerialName,Subscription.Remove,Subscription.Status from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
Inner Join Department On Categorize_Serials.DepartmentID=Department.DepartmentID
Where SerialName='$sname') as asd Full Join
(Select Category_Serials_Program.SubscriptionID,STRING_AGG(Program.ProgramID,', ') as Programs,NumberofItemsReceived_Prog,Organization.DepartmentID from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID
Inner Join Category_Serials_Program On Subscription.SubscriptionID=Category_Serials_Program.SubscriptionID
Inner Join Program On Category_Serials_Program.ProgramID=Program.ProgramID 
Inner Join Organization On Program.OrganizationID=Organization.OrganizationID
Where SerialName='$sname' Group By Category_Serials_Program.SubscriptionID,NumberofItemsReceived_Prog,Organization.DepartmentID) as dsa ON asd.DepartmentID=dsa.DepartmentID
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
