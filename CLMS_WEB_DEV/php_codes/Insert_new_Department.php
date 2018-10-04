<?php 
require 'db.php';

if(!empty($_POST))
{
	$name=$_POST['Dname'];
	$id=$_POST['id'];
	function CheckDup($Did)
	{
		require 'db.php';
		$sql="Select * from Department Where DepartmentID=?";
		$query=sqlsrv_query($conn,$sql,array($Did));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	if(CheckDup($id))
	{
		$insertsql="Insert INTO Department(DepartmentID,DepartmentName) VALUES(?,?)";
		$queryinsert=sqlsrv_query($conn,$insertsql,array($id,$name));
		if($queryinsert)
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