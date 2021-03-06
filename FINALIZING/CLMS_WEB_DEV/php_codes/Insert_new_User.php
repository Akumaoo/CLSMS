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
	// $role='Staff';
	// $dept='ELEM';
	if($_FILES['ava']['size']>0)
	{
		$avaname=$dept.'_'.$_FILES['ava']['name'];
		$avasize=$_FILES['ava']['size'];
		$temp_path=$_FILES['ava']['tmp_name'];
		$dir='../img/Avatars/'.$avaname;
	}
	else
	{
		
		$avaname='no_image.png';
		$avasize=0;
	}

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
		if(in_array($F_ext,$allowed_ext))
		{
			if($avasize<=$maxsize)
			{	
				$insertsql="Insert INTO [User](UserName,Password,FirstName,LastName,Avatar,Email,Role,DepartmentID) VALUES(?,?,?,?,?,?,?,?)";
				if($_FILES['ava']['size']>0)
				{
					if(move_uploaded_file($temp_path,$dir))
					{
						$queryinsert=sqlsrv_query($conn,$insertsql,array($usern,$pass,$FName,$LName,$avaname,$mail,$role,$dept));
						if($queryinsert)
						{
							$scs['status']="success";
						}
						else
						{
							$scs['status']='<br><strong>ERROR ON:</strong> Inserting New User';
						}
					}
					else
					{
						$scs['status']='<br>Fail To Move Avatar To Database Image Path';
					}
				}
				else
				{
					$queryinsert=sqlsrv_query($conn,$insertsql,array($usern,$pass,$FName,$LName,$avaname,$mail,$role,$dept));
					if($queryinsert)
					{
						$scs['status']="success";
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Inserting New User';
					}
				}
				
			}
			else
			{
				$scs['status']='<br>Avatar File Size Must Not Exceed 200Kb';
			}
		}
		else
		{
			$scs['status']='<br>Avatar Must Be PNG Or JPEG Format'.$F_ext;
		}
		 
	}
	else
	{
		$scs['status']='<br>Username Already Exist!';
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>