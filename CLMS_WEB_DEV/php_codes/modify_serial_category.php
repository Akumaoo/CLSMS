<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
$id=$input['CategoryID'];

if($input['action']=='delete')
{
	$sql='Delete From Categorize_Serials Where CategoryID=?';
	$query=sqlsrv_query($conn,$sql,array($id));

}
echo json_encode($input);
 ?>