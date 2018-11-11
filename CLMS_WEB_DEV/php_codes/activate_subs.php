<?php

require 'db.php'; 

// $_POST['disb']='Try';
if(!empty($_POST['disb']))
{

	function getDID($d)
	{
		require 'db.php';
		$sqlget="Select DistributorID from Distributor Where DistributorName=?";
		$queryget=sqlsrv_query($conn,$sqlget,array($d));
		$row=sqlsrv_fetch_array($queryget,SQLSRV_FETCH_ASSOC);
		$id=$row['DistributorID'];
		return $id;

	}
	function getSN($sid)
	{
		require 'db.php';
		$sqlget="Select SerialName from Serial Where SerialID=?";
		$queryget=sqlsrv_query($conn,$sqlget,array($sid));
		$row=sqlsrv_fetch_array($queryget,SQLSRV_FETCH_ASSOC);
		$n=$row['SerialName'];
		return $n;

	}
	$dID=getDID($_POST['disb']);
	$data['subsID_list']=array();
	$data['snames']=array();
	$inc=0;


	$sql="Select * from Subscription Where DistributorID=? AND Subscription_Date IS NULL AND Status='OnGoing'";
	$query=sqlsrv_query($conn,$sql,array($dID),$opt);
	$data['numrows']=sqlsrv_num_rows($query);

	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$data['subsID_list'][$inc]=$row['SubscriptionID'];
		$data['snames'][$inc]=getSN($row['SerialID']);
		$inc++;
	}

header('Content-type: application/json');
echo json_encode($data);
}
else if(!empty($_POST['SED']))
{
	function getSType($sid)
	{
		require 'db.php';
		$sql="Select Origin from Serial Where SerialName=?";
		$query=sqlsrv_query($conn,$sql,array($sid));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$stype=$row['Origin'];
		return $stype;
	}

	$SED=$_POST['SED'];
	$SSD=$_POST['SSD'];
	$sub=$_POST['SUB'];
	$snam=$_POST['sn'];

	// $SED='2018-11-30';
	// $SSD='2018-11-30';
	// $sub='1234';
	// $snam='Dummy';

	$RT=getSType($snam);


	// $today_date=date('Y/m/d');
	if($RT=='Local')
	{
		$ERD=date("Y/m/d",strtotime($SSD.'+ 4 month'));
	}
	else if($RT=='International')
	{
		$ERD=date("Y/m/d",strtotime($SSD.'+ 6 month'));	
	}

	$sql="Update Subscription SET IDD_Phase=?,InitialDeliveryDate=?,Subscription_Date=?,Subscription_End_Date=? WHERE SubscriptionID=?";
	$query=sqlsrv_query($conn,$sql,array('Phase1',$ERD,$SSD,$SED,$sub));
	if($query)
	{
		$scs['status']='success';
	}
	else
	{
		$scs['status']='fail';	
	}

header('Content-type: application/json');
echo json_encode($scs);
}

 ?>