<?php 
require 'db.php';

if(!empty($_POST))
{
	$serialname=$_POST['sername'];
	$orig=$_POST['origin'];
	$type=$_POST['stype'];
// $serialname='test';
// $orig='Local';
// $type='Journal';

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
		$sqlins="Insert Into Serial(TypeName,SerialName,Origin) VALUES(?,?,?)";
		$query=sqlsrv_query($conn,$sqlins,array($type,$serialname,$orig));
		if($query)
		{

			$scs['status']='success';
		}
		else
		{
			$scs['status']='<br><strong>ERROR ON:</strong>Inserting The New Serial';
		}
	}
	else
	{
		$scs['status']='<br>Serial Name Already Exist!';
	}

header('Content-type: application/json');
echo json_encode($scs);
}
 ?>