<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
if(isset($_POST['DeptID']))
{
	$deptID=$_POST['DeptID'];
	$sID=$_POST['sID'];

	function checkDup($dtID,$serID)
	{
		require 'db.php';
		$sqldup='Select * from Categorize_Serials Where DepartmentID=? And SerialID=?';
		$querydup=sqlsrv_query($conn,$sqldup,array($dtID,$serID));
		if(sqlsrv_has_rows($querydup))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function checkname($dept)
	{
		require 'db.php';
		$sql='Select * from Department Where DepartmentID=?';
		$query=sqlsrv_query($conn,$sql,array($dept));
		if(sqlsrv_has_rows($query))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(checkDup($deptID,$sID) && checkname($deptID))
	{
		$sqlinsert="Insert Into Categorize_Serials(DepartmentID,SerialID) VALUES(?,?)";
		$queryinsert=sqlsrv_query($conn,$sqlinsert,array($deptID,$sID));
		if($queryinsert)
		{
			$input['status']='success';
		}
		else
		{
			$input['status']='fail';		
		}
	}
	else
	{
		$input['status']='fail';		
	}

}
else
{

	$id=$input['CategoryID'];

	if($input['action']=='delete')
	{
		$sql='Delete From Categorize_Serials Where CategoryID=?';
		$query=sqlsrv_query($conn,$sql,array($id));

	}

}
header('Content-type: application/json');
echo json_encode($input);
 ?>