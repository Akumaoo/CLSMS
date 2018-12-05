<?php 
require 'db.php';

if(!empty($_POST))
{
	$name=$_POST['Dname'];
	$NOI=$_POST['NOI'];

	// $name='hajie';
	// $NOI='asd';
	$contact=$_POST['CN'];

	if(!isset($_POST['mail']))
	{
		$mail=NULL;
	}
	else
	{
		$mail=$_POST['mail'];
	}
	function CheckDup($Dname)
	{
		require 'db.php';
		$sql="Select * from Distributor Where DistributorName=?";
		$query=sqlsrv_query($conn,$sql,array($Dname));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	if(CheckDup($name))
	{
		$insertsql="Insert INTO Distributor(DistributorName,NameOfIncharge,ContactNumber,Email) VALUES(?,?,?,?)";
		$queryinsert=sqlsrv_query($conn,$insertsql,array($name,$NOI,$contact,$mail));
		if($queryinsert)
		{
			$scs['status']="success";
		}
		else
		{
			$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Distributor';
		}
		
	}
	else
	{
		$scs['status']='<br>Distributor Name Already Exist!';
	}
	 header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>