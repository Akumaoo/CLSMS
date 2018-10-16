<?php 

if(!empty($_POST))
{
	require 'db.php';

	// $_POST['pn']='DUMMY';
	// $_POST['type']='DeleyedDeliver_P2';
	if(!empty($_POST['pn']))
	{
		function GetNotID($siD,$t)
		{
			require 'db.php';
			$sql="Select max(NotificationID) as NotificationID from Notification Where SerialID=? and NotificationType=? ANd NotificationSeen=?";
			$sqlquery=sqlsrv_query($conn,$sql,array($siD,$t,'NotSeen'));
			$row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC);
			$id=$row['NotificationID'];
			return $id;
		}
		function getSID($sn)
		{
			require 'db.php';
			$sql="Select SerialID from Serial Where SerialName=?";
			$query=sqlsrv_query($conn,$sql,array($sn));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$id=$row['SerialID'];
			return $id;
		}

		$sn=$_POST['pn'];
		$type=$_POST['type'];
		$sID=getSID($sn);
		$id=GetNotID($sID,$type);

		$update="Update Notification SET NotificationSeen=? Where NotificationID=?";
		$query=sqlsrv_query($conn,$update,array('Seen',$id));
		
		if($query)
		{
			$msg='success';
		}
		else
		{
			$msg='fail';
		}

	
	}
	else if(!empty($_POST['date']))
	{
		$ser=$_POST['serial'];
		$date=strtotime($_POST['date']);
		$newdate=date('Y-m-d',$date);
		$dept=$_POST['dept'];

		// $ser='DUMMY';
		// $newdate='2018-10-11';
		// $dept="ELEM";

		function getSerialID($sna){
			require 'db.php';
			$sql="Select SerialID from Serial Where SerialName=?";
			$query=sqlsrv_query($conn,$sql,array($sna));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$id=$row['SerialID'];
			return $id;
		}

		$sid=getSerialID($ser);

		$sqlup="Update ReceiveSerial Set RS_Type=? Where DepartmentID=? AND Status=? AND RS_Type IS NULL AND SerialID=?";
		$upquery=sqlsrv_query($conn,$sqlup,array('Old',$dept,'Received',$sid));

		if($upquery)
		{

		

			$getRSsql="Select NotificationID From Notification Where SerialID=? AND NotificationType=? AND Date_Receive_Redflag=?";
			$getRSquery=sqlsrv_query($conn,$getRSsql,array($sid,'Received',$newdate));
			$rows=sqlsrv_fetch_array($getRSquery,SQLSRV_FETCH_ASSOC);
			$RSID=$rows['NotificationID'];

			$updsql="Update Notification Set NotificationSeen=? Where NotificationID=?";
			$queryup=sqlsrv_query($conn,$updsql,array('Seen',$RSID));
			if($queryup)
			{
				$msg='success';
			}
		}

	}
		header('Content-type: application/json');
		echo json_encode($msg);
}

 ?>