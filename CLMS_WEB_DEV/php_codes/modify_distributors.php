<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$id=$input['DistributorID'];
$name=$input['DistributorName'];
$noi=$input['NameOfIncharge'];
$contact=$input['ContactNumber'];
$mail=$input['Email'];

if($input['action']=='edit')
{
	if($name!="" && $noi!="" && $contact!="")
	{
		$updatesql="Update Distributor SET DistributorName=?,NameOfIncharge=?,ContactNumber=?,Email=? WHERE DistributorID=?";
		$queryup=sqlsrv_query($conn,$updatesql,array($name,$noi,$contact,$mail,$id),$opt);
	}
}
else if($input['action']=='delete')
{
	$sqldel="Delete From Distributor WHERE DistributorID=?";
	$delquery=sqlsrv_query($conn,$sqldel,array($id),$opt);
}
echo json_encode($input);

 ?>