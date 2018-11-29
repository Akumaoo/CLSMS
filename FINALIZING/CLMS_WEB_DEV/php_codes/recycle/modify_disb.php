<?php 
require "../db.php";

$input=filter_input_array(INPUT_POST);


	if($input["action"]==='retrieve')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$sqltxtdel="Update Distributor SET Remove=?,Remove_Remarks=? Where DistributorID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array(NULL,NULL,$ret_list[$x]));
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
	else if($input["action"]==='PRS')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$sqltxtdel="Delete from Distributor Where DistributorID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>