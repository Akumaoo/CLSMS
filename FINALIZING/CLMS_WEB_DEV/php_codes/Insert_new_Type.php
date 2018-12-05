<?php 
require 'db.php';

if(!empty($_POST))
{
	$name=$_POST['tn'];
	function CheckDup($n)
	{
		require 'db.php';
		$sql="Select * from [Type] Where TypeName=?";
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

	if(CheckDup($name))
	{
		$insertsql="Insert INTO [Type](TypeName) VALUES(?)";
		$queryinsert=sqlsrv_query($conn,$insertsql,array($name));
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