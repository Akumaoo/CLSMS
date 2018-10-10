<?php 
require 'db.php';

if(!empty($_POST))
{
	$distname=$_POST["Disb"];
	$sn=$_POST["Serial"];
	$orders=$_POST["Freq"];
	$Cost=$_POST["Cost"];
	$NIR=0;
	$stat="OnGoing";
	$Scopy=$_POST['Copy'];
	//check if value are null
	if(!$_POST['DOI'])
	{
		$DOI=NULL;
	}
	else
	{
		$DOI=$_POST['DOI'];
	}
	if($_POST['IN']==0)
	{
		$IN=NULL;
	}
	else
	{
		$IN=$_POST['IN'];
	}
	if($_POST['VN']==0)
	{
		$VN=NULL;
	}
	else
	{
		$VN=$_POST['VN'];
	}
	
	$PN=$_POST['PN'];

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
function CheckPackName($pn)
{
	require 'db.php';
	$sql="Select PackageID FROM Package_Delivery Where PackageName=?";
	$query=sqlsrv_query($conn,$sql,array($pn),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$id=$row['PackageID'];
			return $id;
		}
	}
	else
	{
		return 'NotValid';
	}
}
function CheckPackDistributor($pn2)
{
	require 'db.php';
	$cpd="Select DistributorID From Package_Delivery Where PackageName=?";
	$cpdquery=sqlsrv_query($conn,$cpd,array($pn2),$opt);
	if(sqlsrv_has_rows($cpdquery))
	{
		while($row=sqlsrv_fetch_array($cpdquery,SQLSRV_FETCH_ASSOC))
		{
			$Disb_id=$row['DistributorID'];
			return $Disb_id;
		}
	}
	else
	{
		return 'NotValid';
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

	if((CheckDisbtributor($distname)!="NotValid" && CheckSerial($sn)!="NotValid" && CheckPackName($PN)!="NotValid" && (CheckPackDistributor($PN)==CheckDisbtributor($distname)) && !CheckDup(CheckSerial($sn))))
	{
		$dID=CheckDisbtributor($distname);
		$SID=CheckSerial($sn);
		$PID=CheckPackName($PN);
		// inserting on subscription table
		$sqlinsert="Insert Into [Subscription](DistributorID,SerialID,Orders,Cost,NumberOfItemReceived,Status,Subscription_Date) Values(?,?,?,?,?,?,?)";
		$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$orders,$Cost,$NIR,$stat,$date_today));

		if($query)
		{
		// inserting on delivery table
		$sqlinserdel="Insert Into Delivery(SerialID,DateofIssue,IssueNumber,VolumeNumber,PackageID,Copies) Values(?,?,?,?,?,?)";
		$querydel=sqlsrv_query($conn,$sqlinserdel,array($SID,$DOI,$IN,$VN,$PID,$Scopy));

			if($querydel)
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
			$scs['status']='fail';
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