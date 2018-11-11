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
	else if(!empty($_POST['type']))
	{	
		$type=$_POST['type'];

		if($type=='per dept')
		{
			$dept=$_POST['dept'];
			// $dept="SEAIDITE";

			function getRSID_List($dept){
				require 'db.php';
				$rs_list=[];
				$inc=0;
				$sql="Select  ReceivedSerialID,DepartmentID,SerialName,TypeName,ReceiveSerial.Status,Subscription.Status from ReceiveSerial Inner Join Serial ON ReceiveSerial.SerialID=Serial.SerialID
					Inner Join Subscription On Serial.SerialID=Subscription.SerialID WHERE ReceiveSerial.Status=? AND Subscription.Status=? AND DepartmentID=? AND Admin_Seen IS NULL";
				$query=sqlsrv_query($conn,$sql,array('Received','OnGoing',$dept));
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$rs_list[$inc]=$row['ReceivedSerialID'];
					$inc++;
				}
				return $rs_list;
			}
			$rsID_list=getRSID_List($dept);

			for($x=0;$x<count($rsID_list);$x++)
			{
				$sqlup="Update ReceiveSerial Set Admin_Seen=? Where ReceivedSerialID=?";
				$upquery=sqlsrv_query($conn,$sqlup,array('Seen',$rsID_list[$x]));

			}
			$msg='success';
		}
		else
		{
			function getRSID_List($dept){
				require 'db.php';
				$rs_list=[];
				$inc=0;
				$sql="Select  ReceivedSerialID,DepartmentID,SerialName,TypeName,ReceiveSerial.Status,Subscription.Status from ReceiveSerial Inner Join Serial ON ReceiveSerial.SerialID=Serial.SerialID
					Inner Join Subscription On Serial.SerialID=Subscription.SerialID WHERE ReceiveSerial.Status=? AND Subscription.Status=? AND Admin_Seen IS NULL";
				$query=sqlsrv_query($conn,$sql,array('Received','OnGoing'));
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$rs_list[$inc]=$row['ReceivedSerialID'];
					$inc++;
				}
				return $rs_list;
			}
			$rsID_list=getRSID_List($dept);

			for($x=0;$x<count($rsID_list);$x++)
			{
				$sqlup="Update ReceiveSerial Set Admin_Seen=? Where ReceivedSerialID=?";
				$upquery=sqlsrv_query($conn,$sqlup,array('Seen',$rsID_list[$x]));

			}
			$msg='success';

		}

	}
		header('Content-type: application/json');
		echo json_encode($msg);
}

 ?>