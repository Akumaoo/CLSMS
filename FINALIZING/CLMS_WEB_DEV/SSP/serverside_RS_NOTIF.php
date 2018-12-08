<?php 
require '../php_codes/db.php';

// $_POST['data']='ELEM';
// $_POST['date']='Dec-07-2018';

if($_POST['data']!="")
{
	$data="AND asd.DepartmentID='".$_POST['data']."'";
	$date=strtotime($_POST['date']);
	$newdate=date('Y-m-d',$date);

	$date_string_up="AND (DateReceiveNotif_Receive='".$newdate."')";
	$date_string_down="WHERE DateReceiveNotif_Receive_Prog='".$newdate."'";
}
else
{
	$data="";
	$date_string_up="";
	$date_string_down="";
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
)as Staff_Comment,Admin_Seen from
	(Select Admin_Seen,ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from  Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
	Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND Receive_Date=DateReceiveNotif_Give $date_string_up) as asd
	Left Join
	(Select Organization.DepartmentID,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
	Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
	Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID  $date_string_down) as dsa ON asd.DepartmentID=dsa.DepartmentID 
	WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status='Received' OR dsa.Status_Prog='Received') $data
	) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'ProgramID','dt'=>2),
	array('db'=>'SerialName','dt'=>3),
	array('db'=>'TypeName','dt'=>4)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
);


 ?>
