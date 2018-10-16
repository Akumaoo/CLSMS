<?php 
require 'db.php';

if(!empty($_POST))
{
	$FName=$_POST['FN'];
	$LName=$_POST['LN'];
	$mail=$_POST['mail'];
	$usern=$_POST['username'];
	$pass=md5($_POST['pass1']);
	$role=$_POST['role'];
	if($_POST['dept']=='stat')
	{
		$dept=NULL;

	}
	else
	{
		$dept=$_POST['dept'];
	}

	// all about photo
	// $avaname='asdsa';
	// $FName='asd';
	// $LName='asd';
	// $mail='asd';
	// $usern='asd';
	// $pass='asd';
	// $role='Admin';
	// $dept='';

	$avaname=$_FILES['ava']['name'];
	$avasize=$_FILES['ava']['size'];
	$avatype=$_FILES['ava']['type'];
	$temp_path=$_FILES['ava']['tmp_name'];
	$dir='../img/Avatars/'.$avaname;
	$maxsize=200000;

	$ext=explode('.',$avaname);
	$F_ext=strtolower(end($ext));

	$allowed_ext=array('jpg','jpeg','png');


	function CheckDup($n)
	{
		require 'db.php';
		$sql="Select * from [User] Where UserName=?";
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

	if(CheckDup($usern))
	{
		if(($avasize<=$maxsize) && (in_array($F_ext,$allowed_ext)))
		{	
			$insertsql="Insert INTO [User](UserName,Password,FirstName,LastName,Avatar,Email,Role,DepartmentID) VALUES(?,?,?,?,?,?,?,?)";
			if(move_uploaded_file($temp_path,$dir))
			{
				$queryinsert=sqlsrv_query($conn,$insertsql,array($usern,$pass,$FName,$LName,$avaname,$mail,$role,$dept));
				if($queryinsert)
				{
					$scs['status']="success";
				}
				else
				{
					$scs['status']='fail';
				}
			}
			else
			{
				$scs['status']='fail';
			}
		}
		else
		{
			$scs['status']='fail';
		}
		 
	}
	else
	{
		$scs['status']='fail';
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>