<?php 
require 'db.php';

// $input['action']='delete';
// $id=27;

// $input['action']='edit';
// $id=25;
// $name='new23';
// $noi='New';
// $contact='123';
// $mail='hajie@gmail.com';

$input=filter_input_array(INPUT_POST);
$id=$input['DistributorID'];

if($input['action']=='edit')
{
	$name=$input['DistributorName'];
	$noi=$input['NameOfIncharge'];
	$contact=$input['ContactNumber'];
	$mail=$input['Email'];

	if($name!="" && $noi!="" && $contact!="")
	{
		$updatesql="Update Distributor SET DistributorName=?,NameOfIncharge=?,ContactNumber=?,Email=? WHERE DistributorID=?";
		$queryup=sqlsrv_query($conn,$updatesql,array($name,$noi,$contact,$mail,$id));
	}
}
else if($input['action']=='delete')
{
	$sqldel="Delete From Distributor WHERE DistributorID=?";
	$delquery=sqlsrv_query($conn,$sqldel,array($id));
}
echo json_encode($input);

 ?>