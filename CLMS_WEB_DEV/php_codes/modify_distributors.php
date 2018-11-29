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


if($input['action']=='edit')
{
	$id=$input['DistributorID'];
	$name=$input['DistributorName'];
	$noi=$input['NameOfIncharge'];
	$contact=$input['ContactNumber'];
	$mail=$input['Email'];

	if($name!="" && $noi!="" && $contact!="")
	{
		$updatesql="Update Distributor SET DistributorName=?,NameOfIncharge=?,ContactNumber=?,Email=? WHERE DistributorID=?";
		$queryup=sqlsrv_query($conn,$updatesql,array($name,$noi,$contact,$mail,$id));
	}
	echo json_encode($input);
}
else if($input['action']=='delete')
{
	$reason=$input['reason'];
	$disbID=$input['disbID'];


	$sqltxtdel="Update Distributor SET Remove=?,Remove_Remarks=? Where DistributorID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$disbID));
	
	header('Content-type: application/json');
	echo json_encode($input);
}


 ?>