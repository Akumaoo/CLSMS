<?php 
require 'db.php';

if(!empty($_POST))
{
	$SN=$_POST['SN'];
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
	$cop=$_POST['Copy'];
	$packname=$_POST['Pack_name'];

	function GetSerialID($sn)
	{
		require 'db.php';
		$getsidsql="Select SerialID from Serial Where SerialName=?";
		$getidquery=sqlsrv_query($conn,$getsidsql,array($sn),$opt);
		if(sqlsrv_has_rows($getidquery))
		{
			while($row=sqlsrv_fetch_array($getidquery,SQLSRV_FETCH_ASSOC))
			{
				$rid=$row['SerialID'];
			}
			return $rid;
		}
		else
		{
			return 'NotValid';
		}
	}

	function GetPackID($pn)
	{
		require 'db.php';
		$sqlpn="Select PackageID from Package_Delivery Where PackageName=?";
		$pnquery=sqlsrv_query($conn,$sqlpn,array($pn),$opt);
		if(sqlsrv_has_rows($pnquery))
		{
			while($row=sqlsrv_fetch_array($pnquery,SQLSRV_FETCH_ASSOC))
			{
				$pID=$row['PackageID'];
			}
			return $pID;
		}
		else
		{
			return 'NotValid';
		}
	}

	function CheckDup($sid,$pid)
	{
		require 'db.php';
		$dupsql="Select * from Delivery Where SerialID=? AND PackageID=?";
		$dupquery=sqlsrv_query($conn,$dupsql,array($sid,$pid),$opt);
		if(sqlsrv_has_rows($dupquery))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(GetSerialID($SN)!='NotValid')
	{
		$serial_id=GetSerialID($SN);
		$pack_id=GetPackID($packname);
		if(!CheckDup($serial_id,$pack_id))
		{
			$insertsql="Insert Into Delivery(SerialID,DateofIssue,IssueNumber,VolumeNumber,PackageID,Copies) Values(?,?,?,?,?,?)";
			$insertquery=sqlsrv_query($conn,$insertsql,array($serial_id,$DOI,$IN,$VN,$pack_id,$cop),$opt);

			if($insertquery)
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
}
 ?>
