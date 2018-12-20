<?php 
require 'db.php';
if($_POST['action']=='update')
{
	session_start();
	if(isset($_SESSION['Dept']))
	{
		$dept=$_SESSION['Dept'];
	}
	else
	{
		$dept="COLLEGE";
	}
	$FName=$_POST['FN'];
	$LName=$_POST['LN'];
	$mail=$_POST['mail'];
	$usern=$_POST['username'];
	$prev_ava=$_POST['prev_ava'];
	$uID=$_POST['uID'];

	// $FName='Aku1';
	// $LName='Mao1';
	// $mail='akumao1@gmail.com';
	// $usern='akumao1';
	// $prev_ava='609282.jpg';
	// $uID=182;

	function CheckDup($n,$ID)
	{
		require 'db.php';
		$sql="Select * from [User] Where UserName=? AND UserID!=?";
		$query=sqlsrv_query($conn,$sql,array($n,$ID));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function getCava($UID)
	{
		require 'db.php';
		$sql="Select * from [User] Where UserID=?";
		$query=sqlsrv_query($conn,$sql,array($UID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$data=$row['Avatar'];

		return $data;
	}

	if(CheckDup($usern,$uID))
	{	
		if($_FILES['ava']['size']!=0)
		{
			$avaname=$dept.'_'.$_FILES['ava']['name'];
			$avasize=$_FILES['ava']['size'];
			$avatype=$_FILES['ava']['type'];
			$temp_path=$_FILES['ava']['tmp_name'];
			$dir='../img/Avatars/'.$avaname;
			$maxsize=200000;

			$ext=explode('.',$avaname);
			$F_ext=strtolower(end($ext));

			$allowed_ext=array('jpg','jpeg','png','PNG');
			

			if(($avasize<=$maxsize) && (in_array($F_ext,$allowed_ext)))
			{	
				$insertsql="Update [User] Set FirstName=?,LastName=?,Email=?,UserName=?,Avatar=? Where UserID=?";
				if(move_uploaded_file($temp_path,$dir))
				{	$c_img=getCava($uID);
					$queryinsert=sqlsrv_query($conn,$insertsql,array($FName,$LName,$mail,$usern,$avaname,$uID));
					if($queryinsert)
					{
						
						if($c_img!="no_image.png")
						{
							if(unlink('../img/Avatars/'.$prev_ava))
							{
								$ul=true;
							}
							else
							{
								$ul=false;
							}
						}
						else
						{
							$ul=true;
						}

						if($ul)
						{
							$scs['status']="success";
							$_SESSION['Avatar']=$avaname;
							$scs['FN']=$FName;
							$scs['LN']=$LName;
							$scs['Email']=$mail;
							$scs['UserName']=$usern;
						}
						else
						{
							$scs['status']='fail '.$c_img.'||asd';
						}
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Updating User Settings';
					}
				}
				else
				{
					$scs['status']='<br><strong>ERROR ON:</strong> Moving The Temporary File To Folder';
				}
			}
			else
			{
				$scs['status']='<br>Image Size Is Too Big Or Extension Type Is Not JPEG/PNG';
			}

		}
		else
		{
			$insertsql="Update [User] Set FirstName=?,LastName=?,Email=?,UserName=? Where UserID=?";;
			$query=sqlsrv_query($conn,$insertsql,array($FName,$LName,$mail,$usern,$uID));
			if($query)
			{
				$scs['status']="success";
				$scs['FN']=$FName;
				$scs['LN']=$LName;
				$scs['Email']=$mail;
				$scs['UserName']=$usern;
			}
			else
			{
				$scs['status']='<br><strong>ERROR ON:</strong> Updating User Settings';
			}
		}
		
	}
	else
	{
		$scs['status']='<br>Username <strong>'.$usern.'</strong> Already In Used Please Try Another One';
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}



 ?>