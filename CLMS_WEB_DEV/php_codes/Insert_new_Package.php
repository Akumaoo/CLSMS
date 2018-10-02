<?php 

require 'db.php';

if(!empty($_POST))
{
	$Pname=$_POST['Pname'];
	$ERD=$_POST['ERD'];
	$PP='Phase1';
	$Dname=$_POST['Dname'];

	function CheckDup($pn)
	{
		require 'db.php';
		$dubsql="Select * from Package_Delivery where PackageName=?";
		$dubquery=sqlsrv_query($conn,$dubsql,array($pn),$opt);
		if(sqlsrv_has_rows($dubquery))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function GetDisbID($dn)
	{
		require 'db.php';
		$sql="Select DistributorID FROM Distributor WHERE DistributorName=?";
		$getquery=sqlsrv_query($conn,$sql,array($dn),$opt);
		if(sqlsrv_has_rows($getquery))
		{
			while($getid=sqlsrv_fetch_array($getquery,SQLSRV_FETCH_ASSOC))
			{
				$dID=$getid['DistributorID'];
			}
			return $dID;
		}
		else
		{
			return 'NotValid';
		}
	}
	if(GetDisbID($Dname)!='NotValid' && CheckDup($Pname))
	{
		$disbID=GetDisbID($Dname);
		$sqlinsert="Insert INTO Package_Delivery(PackageName,ReceiveDate,ExpectedReceiveDate,Package_Phase,DistributorID) Values(?,?,?,?,?)";
		$query=sqlsrv_query($conn,$sqlinsert,array($Pname,NULL,$ERD,$PP,$disbID),$opt);

		if($query)
		{
			$msg['status']="success";
		}
		else
		{
			$msg['status']='fail';
		}
		 header('Content-type: application/json');
		echo json_encode($msg);
	}
}
 ?>
