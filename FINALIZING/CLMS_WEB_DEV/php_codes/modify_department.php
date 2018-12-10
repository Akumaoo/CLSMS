<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
// $input['action']='delete_org';
// $input['reason']='asd';
// $input['orgID']='SICS';

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
else if($input['action']=='delete_org')
{
	$reason=$input['reason'];
	$orgID=$input['orgID'];
	// $reason='asdas';
	// $sID=34;

	$sqltxtdel="Update Organization SET Remove_org=?,Remove_Remarks_org=? Where OrganizationID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$orgID));
	
	header('Content-type: application/json');
	echo json_encode($input);
}


 ?>