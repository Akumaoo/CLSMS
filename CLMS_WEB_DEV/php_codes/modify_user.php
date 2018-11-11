<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$Uid=$_POST['UserID'];

if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM [User] Where UserID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($Uid));
}
echo json_encode($input);

 ?>
