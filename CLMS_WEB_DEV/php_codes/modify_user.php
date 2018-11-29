<?php 
require 'db.php';
$input=filter_input_array(INPUT_POST);
if($input['action']=='delete')
{
	$reason=$input['reason'];
	$uID=$input['uID'];
	// $reason='asdas';
	// $sID=34;

	$sqltxtdel="Update [User] SET Remove=?,Remove_Remarks=? Where UserID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$uID));
	
	header('Content-type: application/json');
	echo json_encode($input);
}
 ?>
