<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);

if($input['action']=='edit')
{
	$id=$input['DepartmentID'];
	$name=$input['DepartmentName'];
	$updatesql="Update Department SET DepartmentName=? WHERE DepartmentID=?";
	$queryup=sqlsrv_query($conn,$updatesql,array($name,$id));
	echo json_encode($input);
}
else if($input['action']=='delete')
{
	$reason=$input['reason'];
	$deptID=$input['deptID'];
	// $reason='asdas';
	// $sID=34;

	$sqltxtdel="Update Department SET Remove=?,Remove_Remarks=? Where DepartmentID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$deptID));
	
	header('Content-type: application/json');
	echo json_encode($input);
}


 ?>