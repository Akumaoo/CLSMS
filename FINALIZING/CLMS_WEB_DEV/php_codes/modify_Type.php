<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$id=$input['TypeID'];
$name=$input['TypeName'];


if($input['action']=='edit')
{

	function checktypedup($n)
	{
		require 'db.php';
		$sql="Select * from [Type] Where TypeName=?";
		$query=sqlsrv_query($conn,$sql,array($n));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	if(checktypedup($name))
	{
		$updatesql="Update [Type] SET TypeName=? WHERE TypeID=?";
		$queryup=sqlsrv_query($conn,$updatesql,array($name,$id));
	}
}
else if($input['action']=='delete')
{
	$sqldel="Delete From [Type] WHERE TypeID=?";
	$delquery=sqlsrv_query($conn,$sqldel,array($id));
}
echo json_encode($input);

 ?>