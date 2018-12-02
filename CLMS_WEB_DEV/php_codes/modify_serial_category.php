<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);

// $input['cID']=118;
// $input['type']='Multiple';
// $input['plus_minus']='Add';
// $input['stud_emp']='Student';

if(isset($input['cID']))
{
	function getprevdata($categID,$type,$p)
	{
		if($type=='Single')
		{
			$table='Categorize_Serials';
			$pk='CategoryID';
			if($p=='Student')
			{
				$col='Usage_Stat_Student';
			}
			else
			{
				$col='Usage_Stat_Employee';
			}
		}
		else
		{
			$table='Category_Serials_Program';
			$pk='CategoryID_Program';
			if($p=='Student')
			{
				$col='Usage_Stat_Student_Prog';
			}
			else
			{
				$col='Usage_Stat_Employee_Prog';
			}
		}

		require "db.php";
		$sql="Select ".$col." from ".$table." Where ".$pk."=?";
		$query=sqlsrv_query($conn,$sql,array($categID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$data=$row[$col];

		return $data;

	}

	$categID=$input['cID'];
	$type=$input['type'];
	$plus_minus=$input['plus_minus'];
	$stud_emp=$input['stud_emp'];

	$data=getprevdata($categID,$type,$stud_emp);
	if($plus_minus=='Add')
	{
		$data++;
	}
	else
	{
		$data--;
	}

	if($type=='Single')
	{
		$table='Categorize_Serials';
		$pk='CategoryID';
		if($stud_emp=='Student')
		{
			$col='Usage_Stat_Student';
		}
		else
		{
			$col='Usage_Stat_Employee';
		}
	}
	else
	{
		$table='Category_Serials_Program';
		$pk='CategoryID_Program';
		if($stud_emp=='Student')
		{
			$col='Usage_Stat_Student_Prog';
		}
		else
		{
			$col='Usage_Stat_Employee_Prog';
		}
	}

	$sql="Update ".$table." SET ".$col."=? Where ".$pk."=?";
	$query=sqlsrv_query($conn,$sql,array($data,$categID));

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