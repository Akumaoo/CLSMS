<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$Uid=$_POST['UserID'];
$uname=$_POST['UserName'];
$FN=$_POST['FirstName'];
$LN=$_POST['LastName'];
$mail=$_POST['Email'];
$role=$_POST['Role'];
$dept=$_POST['DepartmentID'];

if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM [User] Where UserID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($Uid));
}

function getListSerials($pd)
{
	require 'db.php';
	$serial_list=[];
	$inc=0;
	$sql="Select SerialID from Delivery Where PackageID=?";
	$query=sqlsrv_query($conn,$sql,array($pd),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$serial_list[$inc]=$row['SerialID'];
			$inc++;
		}
		return $serial_list;
	}
	else
	{
		return 'NotValid';
	}

}
echo json_encode($input);

 ?>
