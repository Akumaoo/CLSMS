<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
$sID=$input['SerialID'];

	if($input["action"]==="edit")
	{
		$type=$input['TypeName'];
		$orig=$input['Origin'];
		if($type!='stat' && $orig!='stat')
		{

			$sqltxt="Update Serial SET TypeName=?,Origin=? Where SerialID=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($type,$orig,$sID));
			
			if($queryedit)
			{
				$input['status']='success';
			}
			else
			{
				$input['status']='fail';		
			}

		}
		else if( $orig=='stat')
		{

			$sqltxt="Update Serial SET TypeName=? Where SerialID=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($type,$sID));
			
			if($queryedit)
			{
				$input['status']='success';
			}
			else
			{
				$input['status']='fail';		
			}
		}
		else if($type=='stat')
		{
			$sqltxt="Update Serial SET Origin=? Where SerialID=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($orig,$sID));
			
			if($queryedit)
			{
				$input['status']='success';
			}
			else
			{
				$input['status']='fail';		
			}
		}
		else
		{
			$input['status']='fail';
		}
		
	}
	else if($input["action"]==='delete')
	{
		$sqltxtdel="Delete FROM Serial Where SerialID=?";
		$querydel=sqlsrv_query($conn,$sqltxtdel,array($sID));
	}


	echo json_encode($input);
 ?>