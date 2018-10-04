<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);
$sID=$input['SerialID'];
$sname=$input['SerialName'];
$type=$input['TypeName'];

if($type!='stat')
{
	function getTypeID($tn)
	{
		require 'db.php';
		$sql='Select TypeID From [Type] where TypeName=?';
		$query=sqlsrv_query($conn,$sql,array($tn));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$name=$row['TypeID'];
			}
			return $name;
		}
		else
		{
			return "NotValid";
		}
	}

	if($input["action"]==="edit")
	{
		if(getTypeID($type)!="NotValid")
		{
			$id=getTypeID($type);
			$sqltxt="Update Serial SET SerialName=?,TypeID=? Where SerialID=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($sname,$id,$sID));
			
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

}
	echo json_encode($input);
 ?>