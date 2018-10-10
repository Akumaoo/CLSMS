<?php 

// if(!empty($_POST))
// {
	require 'db.php';

	// $packname=$_POST['pn'];
	$packname='Try Package';
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

		$update="Update Notification SET NotificationSeen=? Where SerialID=?";
		$query=sqlsrv_query($conn,$update,array('Seen',$serial_list[$x]));
	}
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
// }

 ?>