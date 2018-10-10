<?php 

if(!empty($_POST))
{
	require 'db.php';

	if(!empty($_POST['pn']))
	{

		$packname=$_POST['pn'];
		$serial_list=array();
		$inc=0;

		$getlist="Select SerialID from Delivery Inner Join Package_Delivery ON Delivery.PackageID=Package_Delivery.PackageID Where PackageName=?";
		$querylist=sqlsrv_query($conn,$getlist,array($packname));
		if(sqlsrv_has_rows($querylist))
		{
			while($row=sqlsrv_fetch_array($querylist,SQLSRV_FETCH_ASSOC))
			{
				$serial_list[$inc]=$row['SerialID'];
				$inc++;
			}
		}

		for($x=0;$x<count($serial_list);$x++)
		{

			$update="Update Notification SET NotificationSeen=? Where SerialID=? AND NotificationType!=?";
			$query=sqlsrv_query($conn,$update,array('Seen',$serial_list[$x],'Received'));
		}
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
		// $ser=$_POST['serial'];
		// $date=strtotime($_POST['date']);
		// $newdate=date('Y-m-d',$date);

		$ser='DUMMY';
		$newdate='2018-10-11';


		function getSerialID($sna){
			require 'db.php';
			$sql="Select SerialID from Serial Where SerialName=?";
			$query=sqlsrv_query($conn,$sql,array($sna));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$id=$row['SerialID'];
			return $id;
		}

		$sid=getSerialID($ser);

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
		header('Content-type: application/json');
		echo json_encode($msg);
}

 ?>