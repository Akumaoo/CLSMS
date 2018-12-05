<?php 
require '../php_codes/db.php';

$deptID=$_POST['dept'];
// $deptID='College';

$sqltype="Select Count(*) as nums from Department INNER Join Organization ON Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
$querytype=sqlsrv_query($conn,$sqltype,array($deptID));
$row=sqlsrv_fetch_array($querytype,SQLSRV_FETCH_ASSOC);
$datatype=$row['nums'];

if($datatype==0)
{
  $type='Single';
}
else
{
  $type='Multiple';
}

$table=<<<EOT
 (Select 
	(CASE
		WHEN CategoryID_Program IS NULL
		THEN CategoryID
		ELSE CategoryID_Program
		END
	) as CategoryID,SerialName,TypeName,sub_stat,
	CONCAT(
	(CASE
		WHEN CategoryID_Program IS NULL
		THEN NumberOfItemReceived
		ELSE NumberofItemsReceived_Prog
		END
	),'/',Frequency) as deliv_stat,
	(
	CASE
		WHEN CategoryID_Program IS NULL
		THEN Usage_Stat
		ELSE Usage_stat_Prog
		END
	) as Usage_Stat,asd.DepartmentID,ProgramID from
		(Select Serial.SerialID,CategoryID,Categorize_Serials.SubscriptionID,SerialName,TypeName,Serial.Origin,Subscription.Status as sub_stat,Archive,Subscription_Date,Frequency,Department.DepartmentID,NumberOfItemReceived,(Usage_Stat_Employee+Usage_Stat_Student) as Usage_Stat,Subscription.Remove from Serial Inner Join Subscription ON Serial.SerialID=Subscription.SerialID
		Inner Join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
		Inner JOin Department On Categorize_Serials.DepartmentID=Department.DepartmentID) as asd
	Left JOin
		(Select SubscriptionID,CategoryID_Program,Category_Serials_Program.ProgramID,NumberofItemsReceived_Prog,DepartmentID,(Usage_Stat_Employee_Prog+Usage_Stat_Student_Prog) as Usage_stat_Prog from Category_Serials_Program Inner Join Program ON Category_Serials_Program.ProgramID=Program.ProgramID 
		Inner Join Organization On Program.OrganizationID=Organization.OrganizationID) as dsa On asd.DepartmentID=dsa.DepartmentID
		Where (asd.SubscriptionID=dsa.SubscriptionID OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND (asd.Archive IS NULL AND asd.Remove IS NULL) AND asd.DepartmentID='$deptID' AND (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR sub_stat='OnGoing')) temp
EOT;

$primary_key='CategoryID';
if($type=='Single')
{
	$columns=array(
	array('db'=>'CategoryID','dt'=>0),
	array('db'=>'SerialName','dt'=>1),
	array('db'=>'TypeName','dt'=>2),
	array('db'=>'sub_stat','dt'=>3),
	array('db'=>'deliv_stat','dt'=>4),
	array('db'=>'Usage_Stat','dt'=>5)

	);

}
else
{
	$columns=array(
	array('db'=>'CategoryID','dt'=>0),
	array('db'=>'ProgramID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'TypeName','dt'=>3),
	array('db'=>'sub_stat','dt'=>4),
	array('db'=>'deliv_stat','dt'=>5),
	array('db'=>'Usage_Stat','dt'=>6)

	);
}


require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
);

 ?>
