<?php 
require 'db.php';

if(!empty($_POST))
{
	$distname=$_POST['dname'];
	$type=$_POST['type'];
	$sn=$_POST['sname'];
	$freq=$_POST['freq'];
	$cost=$_POST['cost'];

	// $distname="UMX";
	// $type="POST-PAID";
	// $sn="DUMMY";
	// $freq=6;
	// $cost=6;
	
	$date_today=date('Y/m/d');

function CheckDisbtributor($disb){
	require 'db.php';
	$Dname=$disb;
	$checksql="Select * from [Distributor] Where [Distributor].[DistributorName]=?";
	$query=sqlsrv_query($conn,$checksql,array($Dname),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$DisbID=$row["DistributorID"];
			return $DisbID;
		}
	}
	else
	{
		return "NotValid";
	}
}
function CheckSerial($ser)
{
	require 'db.php';
	$Sname=$ser;
	$checksqlser="Select * from [Serial] Where [Serial].[SerialName]=?";
	$queryser=sqlsrv_query($conn,$checksqlser,array($Sname),$opt);
	if(sqlsrv_has_rows($queryser))
	{
		while($row=sqlsrv_fetch_array($queryser,SQLSRV_FETCH_ASSOC))
		{
			$SerID=$row["SerialID"];
			return $SerID;
		}
	}
	else
	{
		return "NotValid";
	}
}
function CheckDup($sid)
{
	require 'db.php';
	$sql="Select * from Subscription Where SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array($sid,'OnGoing'));
	if(sqlsrv_has_rows($query))
	{
		return true;
	}
	else
	{
		return false;
	}
}

	if((CheckDisbtributor($distname)!="NotValid" && CheckSerial($sn)!="NotValid" && !CheckDup(CheckSerial($sn))))
	{
		$dID=CheckDisbtributor($distname);
		$SID=CheckSerial($sn);

		if($type=="PRE-PAID")
		{
		
			// inserting on subscription table
			$sqlinsert="Insert Into [Subscription](DistributorID,SerialID,Orders,Cost,NumberOfItemReceived,Status) Values(?,?,?,?,?,?)";
			$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$freq,$cost,0,'OnGoing'));

			if($query)
			{
				$scs['status']="success";
			}
			else
			{
				$scs['status']='fail';
			}
		}
		else
		{
			$SED=$_POST['SED'];
			$RT=$_POST['RT'];
			// $SED='2018-10-10';
			// $RT='Local';
			if($RT=='Local')
			{
				$ERD=date("Y/m/d",strtotime($date_today.'+ 4 month'));
			}
			else if($RT=='International')
			{
				$ERD=date("Y/m/d",strtotime($date_today.'+ 6 month'));	
			}
			$sqlinsert="Insert Into Subscription(DistributorID,SerialID,Orders,Cost,NumberOfItemReceived,Status,IDD_Phase,InitialDeliveryDate,Subscription_Date,Subscription_End_Date) Values(?,?,?,?,?,?,?,?,?,?)";
			$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$freq,$cost,0,'OnGoing','Phase1',$ERD,$date_today,$SED));

			if($query)
			{
				$scs['status']="success";
			}
			else
			{
				$scs['status']='fail';
			}	
		}
		 
	}
	else
	{
		$scs['status']='fail';
	}

header('Content-type: application/json');
echo json_encode($scs);
}

 ?>