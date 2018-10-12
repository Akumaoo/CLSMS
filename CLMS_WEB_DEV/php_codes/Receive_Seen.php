<?php 
require 'db.php';

function getSN($s)
{
	require 'db.php';
	$getsql="Select SerialID from Serial Where SerialName=?";
	$getquery=sqlsrv_query($conn,$getsql,array($s));
	$row=sqlsrv_fetch_array($getquery,SQLSRV_FETCH_ASSOC);
	$id=$row['SerialID'];
	return $id;
}

if($_POST['type']=='seen')
{
	$dept=$_POST['dept'];
	$sn=$_POST['sn'];
	$sID=getSN($sn);



	$sql="Update ReceiveSerial SET RS_Seen=? WHERE DepartmentID=? AND SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array('Seen',$dept,$sID,'NotReceived'));
	if($query)
	{
		$msg='success';
	}
	else
	{
		$msg='fail';
	}
	header('Content-type: application/json');
	echo json_encode($msg);
}
else if($_POST['type']=='receive')
{
	// $contno=12312312;
	// $comms='TY';
	// $ser='Journal of Abnormal Psychology (APA)';
	// $dept='ELEM';

	$contno=$_POST['cono'];
	$comms=$_POST['coms'];
	$ser=$_POST['ser'];
	$dept=$_POST['depart'];
	$sID=getSN($ser);
	$date=date('Y/m/d');

	$sql="Update ReceiveSerial SET Status=?,Staff_Comment=?,ControlNumber=? WHERE DepartmentID=? AND SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array('Received',$comms,$contno,$dept,$sID,'NotReceived'));
	if($query)
	{
		$insertxt="Insert Into Notification(SerialID,NotificationType,NotificationSeen,Date_Receive_RedFlag) VALUES(?,?,?,?)";
		$queryinsert=sqlsrv_query($conn,$insertxt,array($sID,'Received','NotSeen',$date));
		if($queryinsert)
		{
			$msg='success';
		}
		else
		{
			$msg='fail';
		}
	}
	header('Content-type: application/json');
	echo json_encode($msg);
}


 ?>