<?php 
require 'php_codes/db.php';

$date_today=date("Y/m/d");

//get all deliveries
$sqltxt="Select PackageID,ExpectedReceiveDate,Package_Phase,PackageName from Package_Delivery WHERE ReceiveDate IS NULL";
$query=sqlsrv_query($conn,$sqltxt,array());
if(sqlsrv_has_rows($query))
{	
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$PID=$row["PackageID"];
		$ERD=$row['ExpectedReceiveDate']->format("Y/m/d");
		$pack_phase=$row['Package_Phase'];
		$pack_name=$row['PackageName'];

		if($ERD<$date_today)
		{
			if($pack_phase=="Phase1")
			{				
				$phase2_date=date("Y/m/d",strtotime($ERD.'+ 6 month'));
				$sqlupdate="Update Package_Delivery Set Package_Phase=?,ExpectedReceiveDate=? Where PackageID=?";
				$queryupdate=sqlsrv_query($conn,$sqlupdate,array('Phase2',$phase2_date,$PID),$opt);

				$sid=getSerialID($PID);
				for($x=0;$x<count($sid);$x++)
				{
					$sqlinsert="Insert Into Notification(SerialID,NotificationType,NotificationSeen,Date_Receive_RedFlag) Values(?,?,?,?)";
					$queryinsert=sqlsrv_query($conn,$sqlinsert,array($sid[$x],'DeleyedDeliver_P1','NotSeen',$date_today));
				}
			}
			else
			{
				$sid=getSerialID($PID);
				for($x=0;$x<count($sid);$x++)
				{
					if(checkNotifSerial($sid[$x]))
					{
						$sqlinsert="Update Notification SET NotificationType=?,NotificationSeen=?,Date_Receive_RedFlag=? WHERE SerialID=? AND NotificationType!=?";
						$queryinsert=sqlsrv_query($conn,$sqlinsert,array('DeleyedDeliver_P2','NotSeen',$date_today,$sid[$x],'Received'));
					}	
				}
			}
		}
	}
}
function getSerialID($pack){
	require 'db.php';
	$sql="Select SerialID from Delivery Where PackageID=?";
	$query=sqlsrv_query($conn,$sql,array($pack));
	$id=array();
	$x=0;
	if(sqlsrv_has_rows($query))
	{
		
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$id[$x]=$row['SerialID'];
			$x++;
		}
	}
	return $id;
}
function checkNotifSerial($sid)
{
	require 'db.php';
	$sql="Select SerialID from Notification Where SerialID=? AND NotificationType!=? AND NotificationSeen=?";
	$query=sqlsrv_query($conn,$sql,array($sid,'Received','Seen'));

	if(sqlsrv_has_rows($query))
	{
		return true;
	}
	else
	{
		return false;
	}
}

 ?>