<?php 
require 'db.php';	
if(isset($_POST['sname']))
{
	$sname=$_POST['sname'];
	$depts=$_POST['depts'];
	// $sname='Catholic Historical Review';
	// $depts=['ELEM'];

	function GetCurrentList($sname)
	{
		$categ_list=[];
		$inc=0;
		require 'db.php';
		$sql="Select CategoryID,SerialName,DepartmentID from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And SerialName=?";
		$query=sqlsrv_query($conn,$sql,array('OnGoing',$sname));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$categ_list[$inc]=$row['CategoryID'];
				$inc++;
			}
		}
		return $categ_list;
	}
	function GetSubID($sname)
	{
		require 'db.php';
		$sql='Select SubscriptionID from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID Where SerialName=? AND Status=?';
		$query=sqlsrv_query($conn,$sql,array($sname,'OnGoing'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$subID=$row['SubscriptionID'];
		return $subID;
	}

	$categ_list=GetCurrentList($sname);
	$subID=GetSubID($sname);

	if(count($categ_list)>0)
	{
		for($x=0;$x<count($categ_list);$x++)
		{
			$sqldel="Delete from Categorize_Serials Where CategoryID=?";
			$sqlquerydel=sqlsrv_query($conn,$sqldel,array($categ_list[$x]));
		}
	}
	else
	{
		$sqlquerydel=true;
	}

	for($y=0;$y<count($depts);$y++)
	{
		$sqlinsert="Insert Into Categorize_Serials(DepartmentID,SubscriptionID,NumberOfItemReceived,Usage_Stat) Values(?,?,?,?)";
		$queryinsert=sqlsrv_query($conn,$sqlinsert,array($depts[$y],$subID,0,0));
	}

	if($queryinsert && $sqlquerydel)
	{
		$scs['status']='success';
	}
	header('Content-type: application/json');
	echo json_encode($scs);
}

 ?>