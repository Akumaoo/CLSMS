<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$delID=$input['DeliveryID'];
$input['action']='delete';

if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM Delivery Where DeliveryID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($delID));
}

echo json_encode($input);

 ?>