<?php 
require 'db.php';

// $_POST['rs_list']=array(2245,2246);
// $_POST['cn_list']=array(95,96);
// $_POST['rem_list']=array('Received','Received');
// $_POST['type']='receive';

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
	
	
	$date=date('Y/m/d');
	for($x=0;$x<count($rs_list);$x++)
	{

		if($rem_list[$x]=='Received')
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
	}
	header('Content-type: application/json');
	echo json_encode($msg);
}


 ?>