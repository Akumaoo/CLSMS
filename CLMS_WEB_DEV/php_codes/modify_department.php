<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$id=$input['DepartmentID'];



if($input['action']=='edit')
{
	$name=$input['DepartmentName'];
	$updatesql="Update Department SET DepartmentName=? WHERE DepartmentID=?";
	$queryup=sqlsrv_query($conn,$updatesql,array($name,$id));
}
else if($input['action']=='delete')
{
	$sqldel="Delete From Department WHERE DepartmentID=?";
	$delquery=sqlsrv_query($conn,$sqldel,array($id));
}
echo json_encode($input);

 ?>