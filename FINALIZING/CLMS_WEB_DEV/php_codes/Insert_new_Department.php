<?php 
require 'db.php';
// $_POST['deptID']='dept3';
// $_POST['orgID']='dept3_org2';
// $_POST['progID']='dept3_prog3,dept3_prog4';

if(!empty($_POST))
{
	$deptID=$_POST['deptID'];
	if(!empty($_POST['orgID']))
	{
		$orgID=$_POST['orgID'];
		$progID_list_string=$_POST['progID'];

		$progID_list_array=explode(',',$progID_list_string);
	}
	
	function CheckDup($table,$PK,$Did)
	{
		require 'db.php';
		$sql="Select * from ".$table." Where ".$PK."=?";
		$query=sqlsrv_query($conn,$sql,array($Did));
		if(sqlsrv_has_rows($query))
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	if(CheckDup('Department','DepartmentID',$deptID))
	{
		$insertsql="Insert INTO Department(DepartmentID) VALUES(?)";
		$queryinsert=sqlsrv_query($conn,$insertsql,array($deptID));
		if($queryinsert)
		{
			if(isset($orgID))
			{
				if(CheckDup('Organization','OrganizationID',$orgID))
				{
					$insertsqlorg="Insert INTO Organization(OrganizationID,DepartmentID) VALUES(?,?)";
					$queryinsertorg=sqlsrv_query($conn,$insertsqlorg,array($orgID,$deptID));
					if($queryinsertorg)
					{
						for($x=0;$x<count($progID_list_array);$x++)
						{
							$insertsqlprog="Insert INTO Program(ProgramID,OrganizationID) VALUES(?,?)";
							$queryinsertprog=sqlsrv_query($conn,$insertsqlprog,array($progID_list_array[$x],$orgID));
						}

						if($queryinsertprog)
						{
							$scs['status']='success';
						}
						else
						{
							$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Program';
						}
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Organization';
					}
				}
				else
				{
					$scs['status']='<br>Organization Already Exist!';
				}
			}
			else
			{
				$scs['status']='success';
			}
		}
		else
		{
			$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Department';
		}
	}
	else
	{
		$checksql="Select Count(OrganizationID) as num_org from Organization Where DepartmentID=?";//Check to See if The Current Dept is Labeled as Single Dept
		$checkquery=sqlsrv_query($conn,$checksql,array($deptID));
		$row=sqlsrv_fetch_array($checkquery,SQLSRV_FETCH_ASSOC);
		$num_org=$row['num_org'];

		if($num_org!=0)
		{
			if(isset($orgID))
			{
				if(CheckDup('Organization','OrganizationID',$orgID))
				{
					$insertsqlorg="Insert INTO Organization(OrganizationID,DepartmentID) VALUES(?,?)";
					$queryinsertorg=sqlsrv_query($conn,$insertsqlorg,array($orgID,$deptID));
					if($queryinsertorg)
					{
						for($x=0;$x<count($progID_list_array);$x++)
						{
							$insertsqlprog="Insert INTO Program(ProgramID,OrganizationID) VALUES(?,?)";
							$queryinsertprog=sqlsrv_query($conn,$insertsqlprog,array($progID_list_array[$x],$orgID));
							if($queryinsertprog)
							{
								$scs['status']='success';
							}
							else
							{
								$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Program';
							}
						}
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Inserting New Organization';
					}
				}
				else
				{
					$scs['status']='<br> Organization Already Exist!';
				}
			}
			else
			{
				$scs['status']='<br><strong>ERROR ON:</strong> Missing Organization And Program List';
			}
		}
		else
		{
			$scs['status']='<br>Department Already Exist And Have Been Labeled As Single Department, Please Remove The Current Department First If You Want To Make It As Multi-Department';				
		}				
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>