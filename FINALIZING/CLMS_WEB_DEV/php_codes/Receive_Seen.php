<?php 
require 'db.php';

function getRS_LIST($dept)
{
	require 'db.php';
	$rs_list=[];
	$inc=0;
	$getsql="Select ReceivedSerialID from ReceiveSerial Where DepartmentID=? AND Status=?";
	$getquery=sqlsrv_query($conn,$getsql,array($dept,'NotReceived'));
	if(sqlsrv_has_rows($getquery))
	{
		while($row=sqlsrv_fetch_array($getquery,SQLSRV_FETCH_ASSOC))
		{
			$rs_list[$inc]=$row['ReceivedSerialID'];
			$inc++;
		}
	}
	return $rs_list;
}
function GetNumsRows($rsID)
{
	require 'db.php';
	$sql="Select Count(*) as num_rows from
	(Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from Delivery_Subs Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
	Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE Subscription.Status='OnGoing') as asd
	Left Join
	(Select Organization.DepartmentID,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
	Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
	Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
	WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status='NotReceived' AND dsa.Status_Prog='NotReceived' OR (asd.Status IS NOT NULL AND dsa.Status_Prog IS NULL)) AND asd.ReceivedSerialID=?";
	$query=sqlsrv_query($conn,$sql,array($rsID));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$num_rows=$row['num_rows'];

	return $num_rows;
}

// $rs_list=array(2170,2171);
// $cn_list=array(1,2);
// $rem_list=array('Received','Received');
// $_POST['type']='receive';

if($_POST['type']=='seen')
{
	$dept=$_POST['dept'];
	$rs_list=getRS_LIST($dept);

	for($x=0;$x<count($rs_list);$x++)
	{
		$sql="Update ReceiveSerial SET Staff_Seen=? Where ReceivedSerialID=?";
		$query=sqlsrv_query($conn,$sql,array('Seen',$rs_list[$x]));
		if($query)
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
else if($_POST['type']=='receive')
{

	$rs_list=$_POST['rs_list'];
	$cn_list=$_POST['cn_list'];
	$rem_list=$_POST['rem_list'];
	if(!empty($_POST['rs_prog_list']))
	{
		$rs_prog_list=$_POST['rs_prog_list'];
	}
	else
	{
		$rs_prog_list=array();
	}
	
	
	$date=date('Y/m/d');
	if(count($rs_prog_list)>0)
	{
		$type='Multiple';
	}
	else
	{
		$type='Single';
	}


	for($x=0;$x<count($rs_list);$x++)
	{

		if($rem_list[$x]=='Received')
		{
			if($type=='Single')
			{
				$sql="Update ReceiveSerial SET Status=?,DateReceiveNotif_Receive=?,Staff_Comment=?,ControlNumber=? WHERE ReceivedSerialID=?";
				$query=sqlsrv_query($conn,$sql,array('Received',$date,$rem_list[$x],$cn_list[$x],$rs_list[$x]));
				if($query)
				{
					
					$msg='success';
					
				}
				else
				{
					$msg='fail';
				}
			}
			else
			{
				$rows=GetNumsRows($rs_list[$x]);
				if($rows==1)
				{
					$sql_dept="Update ReceiveSerial SET Status=?,DateReceiveNotif_Receive=?,Staff_Comment=? WHERE ReceivedSerialID=?";
					$query_dept=sqlsrv_query($conn,$sql_dept,array('Received',$date,$rem_list[$x],$rs_list[$x]));
				}

				$sql="Update ReceiveSerial_Program SET Status_Prog=?,DateReceiveNotif_Receive_Prog=?,Staff_Comment_Prog=?,ControlNumber_Prog=? WHERE ReceiveSerialID_Program=?";
				$query=sqlsrv_query($conn,$sql,array('Received',$date,$rem_list[$x],$cn_list[$x],$rs_prog_list[$x]));
				if($query)
				{
					
					$msg='success';
					
				}
				else
				{
					$msg='fail';
				}

			}
		}
		else
		{
			if($type=='Single')
			{
				$sql="Update ReceiveSerial SET Staff_Comment=? WHERE ReceivedSerialID=?";
				$query=sqlsrv_query($conn,$sql,array($rem_list[$x],$rs_list[$x]));
				if($query)
				{
					
					$msg='success';
					
				}
				else
				{
					$msg='fail';
				}
			}
			else
			{
				$sql="Update ReceiveSerial_Program SET Staff_Comment_Prog=? WHERE ReceiveSerialID_Program=?";
				$query=sqlsrv_query($conn,$sql,array($rem_list[$x],$rs_prog_list[$x]));
				if($query)
				{
					
					$msg='success';
					
				}
				else
				{
					$msg='fail';
				}
			}

		}
	}
	header('Content-type: application/json');
	echo json_encode($msg);
}


 ?>