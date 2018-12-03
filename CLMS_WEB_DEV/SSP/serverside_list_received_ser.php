<?php 
require '../php_codes/db.php';
$dept=$_POST['dept'];

$sqltype="Select Count(*) as nums from Department INNER Join Organization ON Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
$querytype=sqlsrv_query($conn,$sqltype,array($dept));
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
 	(Select ReceivedSerialID,asd.DepartmentID,dsa.ReceiveSerialID_Program,dsa.ProgramID,
	(CASE
		WHEN dsa.ProgramID IS NULL
		THEN asd.ControlNumber
		ELSE
			dsa.ControlNumber_Prog
		END
	)as ControlNumber,asd.SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,
	(CASE
		WHEN dsa.ProgramID IS NULL
		THEN asd.Staff_Comment
		ELSE 
			dsa.Staff_Comment_Prog
		END
	)as Staff_Comment from
		(Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID  Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
		Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE Subscription.Status='OnGoing' AND Receive_Date=DateReceiveNotif_Give) as asd
		Left Join
		(Select Organization.DepartmentID,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
		Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
		Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
		WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status='Received' OR dsa.Status_Prog='Received') AND asd.DepartmentID='$dept') temp
EOT;

$primary_key='ControlNumber';

if($type=='Single')
{
	$columns=array(
		array('db'=>'ControlNumber','dt'=>0),
		array('db'=>'SerialName','dt'=>1),
		array('db'=>'VolumeNumber','dt'=>2),
		array('db'=>'IssueNumber','dt'=>3),
		array('db'=>'DateofIssue','dt'=>4),
		array('db'=>'Staff_Comment','dt'=>5)
	);
}
else
{
	$columns=array(
		array('db'=>'ProgramID','dt'=>0),
		array('db'=>'ControlNumber','dt'=>1),
		array('db'=>'SerialName','dt'=>2),
		array('db'=>'VolumeNumber','dt'=>3),
		array('db'=>'IssueNumber','dt'=>4),
		array('db'=>'DateofIssue','dt'=>5),
		array('db'=>'Staff_Comment','dt'=>6)
	);
}

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"" )
);

 ?>
