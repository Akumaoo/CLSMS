<?php 
require 'db.php';

if(!empty($_POST))
{
	$serialname=$_POST['sername'];
	$dept=$_POST['depts'];
	$type=$_POST['stype'];
// $serialname='NEW';
// $dept=array('ELEM','SHS');
// $type='Magazine';

	function checkSer($n)
	{
		require 'db.php';
		$sql="Select * from Serial Where SerialName=?";
		$query=sqlsrv_query($conn,$sql,array($n));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function getTID($tn)
	{
		require 'db.php';
		$sql="Select TypeID from [Type] Where TypeName=?";
		$query=sqlsrv_query($conn,$sql,array($tn));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$id=$row['TypeID'];
		return $id;
	}
	function GetNewSID($sn)
	{
		require 'db.php';
		$sql="Select SerialID from Serial Where SerialName=?";
		$query=sqlsrv_query($conn,$sql,array($sn));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$id=$row['SerialID'];
		return $id;
	}

	if(checkSer($serialname))
	{
		$TID=getTID($type);
		$sqlins="Insert Into Serial(TypeID,SerialName) VALUES(?,?)";
		$query=sqlsrv_query($conn,$sqlins,array($TID,$serialname));
		if($query)
		{
			$new_SID=GetNewSID($serialname);
			for($x=0;$x<count($dept);$x++)
			{
				$sqlindept="Insert Into Categorize_Serials(DepartmentID,SerialID) VALUES(?,?)";
				$querydept=sqlsrv_query($conn,$sqlindept,array($dept[$x],$new_SID));
			}

			$scs['status']='success';
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