<?php 
require 'db.php';

// $_POST['type']='check_org';
// $_POST['org']='SICS';
function sanitize($str)
{
	$sanitize_str=htmlentities(str_replace("'","", str_replace('"', '', $str)));

	return $sanitize_str;
}

if($_POST['type']=='check_dept')
{
	$dept=$_POST['dept'];


	$sql="Select Count(*) as num_rows from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
	$query=sqlsrv_query($conn,$sql,array($dept));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$num_row=$row['num_rows'];

	if($num_row==0)
	{
		$data['data_type']="Single";
	}	
	else
	{
		$data['data_type']="Multiple";
	}

	if($data['data_type']=='Multiple')
	{
		$sql="Select OrganizationID from Department Left Join Organization On Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
		$query=sqlsrv_query($conn,$sql,array($dept));
		if(sqlsrv_has_rows($query))
		{	
			$data['orgs']='';
			
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				if(isset($row['OrganizationID'][0]))
				{
					$data['orgs'].='<option value="'.$row['OrganizationID'].'">'.$row['OrganizationID'].'</option>';
				}
			}
		}
	}

}
else if($_POST['type']=='check_org')
{
	$org=$_POST['org'];
	$org_string="";
	for($z=0;$z<count($org);$z++)
	{
		if($z==0)
		{
			$org_string.=" Organization.OrganizationID='".sanitize($org[$z])."'";
		}
		else
		{
			$org_string.=" OR Organization.OrganizationID='".sanitize($org[$z])."'";
		}
	}

	$sql="Select ProgramID from Organization Inner Join Program On Organization.OrganizationID=Program.OrganizationID Where (".$org_string.")";
	$query=sqlsrv_query($conn,$sql,array());
	if(sqlsrv_has_rows($query))
	{	$data['progs']='';
	
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$data['progs'].='<option value="'.$row['ProgramID'].'">'.$row['ProgramID'].'</option>';

		}
		
	}
	
}



header('Content-type: application/json');
echo json_encode($data);


 ?>