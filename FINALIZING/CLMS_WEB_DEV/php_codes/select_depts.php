<?php 
require 'db.php';

// $_POST['type']='check_dept';
// $_POST['dept']='College';

if($_POST['type']=='check_dept')
{
	$dept=$_POST['dept'];
	$sql="Select OrganizationID from Department Left Join Organization On Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
	$query=sqlsrv_query($conn,$sql,array($dept));
	if(sqlsrv_has_rows($query))
	{	$data['orgs']='';
		
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				if(isset($row['OrganizationID'][0]))
				{
					$data['orgs'].="<li class='tag_".$dept."'><input type='checkbox' class='org_cb' name='org' value='".$row['OrganizationID']."'>".$row['OrganizationID']."</li>";
				}
			}
		
	}
	
}
else if($_POST['type']=='check_org')
{
	$org=$_POST['org'];
	$sql="Select ProgramID from Organization Inner Join Program On Organization.OrganizationID=Program.OrganizationID Where Organization.OrganizationID=?";
	$query=sqlsrv_query($conn,$sql,array($org));
	if(sqlsrv_has_rows($query))
	{	$data['progs']="";
	
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$data['progs'].="<li class='tag_".$org."'><input type='checkbox' class='prog_cb' name='progs' value='".$row['ProgramID']."'>".$row['ProgramID']."</li>";

		}
		
	}
	
}

header('Content-type: application/json');
echo json_encode($data);


 ?>