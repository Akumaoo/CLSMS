<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
// $input['reason']='rety';
// $input['sID']=34;
// $input['action']='delete';


	if($input["action"]==="edit")
	{	$sID=$input['SerialID'];
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
		
		echo json_encode($input);
	}
	else if($input["action"]==='delete')
	{
		$reason=$input['reason'];
		$sID=$input['sID'];
		// $reason='asdas';
		// $sID=34;
	
		$sqltxtdel="Update Serial SET Remove=?,Remove_Remarks=? Where SerialID=?";
		$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$sID));
		
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>