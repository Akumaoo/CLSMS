<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
if(isset($input['Category_ID']))
{
	$categID=$input['Category_ID'];
	$usage=$input['Usage'];

	$sql="Update Categorize_Serials SET Usage_Stat=? Where CategoryID=?";
	$query=sqlsrv_query($conn,$sql,array($usage,$categID));

	if($query)
	{
		$input['scs']='success';
	}
	else
	{
		$input['scs']='fail';
	}

}
header('Content-type: application/json');
echo json_encode($input);
 ?>