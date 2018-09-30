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

	if((CheckDisbtributor($distname)!="NotValid" && CheckSerial($sn)!="NotValid" && CheckPackName($PN)!="NotValid"))
	{
		$dID=CheckDisbtributor($distname);
		$SID=CheckSerial($sn);
		$PID=CheckPackName($PN);
		// inserting on subscription table
		$sqlinsert="Insert Into [Subscription](DistributorID,SerialID,Orders,Cost,NumberOfItemReceived,Status) Values(?,?,?,?,?,?)";
		$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$orders,$Cost,$NIR,$stat),$opt);

		// inserting on delivery table
		$sqlinserdel="Insert Into Delivery(SerialID,DateofIssue,IssueNumber,VolumeNumber,PackageID) Values(?,?,?,?,?)";
		$querydel=sqlsrv_query($conn,$sqlinserdel,array($SID,$DOI,$IN,$VN,$PID),$opt);

		if($query && $querydel)
		{
			$scs['status']="success";
		}
		else
		{
			$scs['status']='fail';
		}
		 header('Content-type: application/json');
		echo json_encode($scs);
	}

}

 ?>