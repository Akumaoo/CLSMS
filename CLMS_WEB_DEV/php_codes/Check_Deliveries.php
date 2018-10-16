<?php 
require 'db.php';

$date_today=date("Y/m/d");

//get all deliveries
$sqltxt="Select * from Subscription Where InitialDeliveryDate IS NOT NULL AND IDD_Phase!=?";
$query=sqlsrv_query($conn,$sqltxt,array('Complete'));
if(sqlsrv_has_rows($query))
{	
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$SubID=$row["SubscriptionID"];
		$ERD=$row['InitialDeliveryDate']->format("Y/m/d");
		$phase=$row['IDD_Phase'];
		$sid=$row['SerialID'];
		if($ERD<$date_today)
		{
			if($phase=="Phase1")
			{				
				$phase2_date=date("Y/m/d",strtotime($ERD.'+ 6 month'));
				$sqlupdate="Update Subscription Set IDD_Phase=?,InitialDeliveryDate=? Where SubscriptionID=?";
				$queryupdate=sqlsrv_query($conn,$sqlupdate,array('Phase2',$phase2_date,$SubID));

				$sqlinsert="Insert Into Notification(SerialID,NotificationType,NotificationSeen,Date_Receive_RedFlag) Values(?,?,?,?)";
				$queryinsert=sqlsrv_query($conn,$sqlinsert,array($sid,'DeleyedDeliver_P1','NotSeen',$date_today));

			}
			else
			{	
				if(checkNotifSerial($sid))
				{
					if(checkNotifSerial_P2($sid,$date_today))
					{
						$sqlinsert="Insert Into Notification(SerialID,NotificationType,NotificationSeen,Date_Receive_RedFlag) Values(?,?,?,?)";
						$queryinsert=sqlsrv_query($conn,$sqlinsert,array($sid,'DeleyedDeliver_P2','NotSeen',$date_today));
					}
				}	
			}
		}
	}
}

function checkNotifSerial($sid)
{
	require 'db.php';
	$sql="Select * from Notification Where SerialID=? AND NotificationType=? AND NotificationSeen=?";
	$query=sqlsrv_query($conn,$sql,array($sid,'DeleyedDeliver_P2','NotSeen'));

	if(sqlsrv_has_rows($query))
	{
		return false;
	}
	else
	{
		return true;
	}
}
function checkNotifSerial_P2($si,$d)
{
	require 'db.php';
	$sql2="Select * from Notification Where SerialID=? AND NotificationType=? AND NotificationSeen=? AND Date_Receive_RedFlag=?";
	$query2=sqlsrv_query($conn,$sql2,array($si,'DeleyedDeliver_P2','Seen',$d));

	if(sqlsrv_has_rows($query2))
	{
		return false;
	}
	else
	{
		return true;
	}
}

 ?>