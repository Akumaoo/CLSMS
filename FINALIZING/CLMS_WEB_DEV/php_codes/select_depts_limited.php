<?php 
require 'db.php';

// $_POST['type']='check_dept';
// $_POST['dept']='College';
// $_POST['sn']='DUMMY';
$sn=$_POST['sn'];
function getSubID($sname)
{
	require 'db.php';
	$getsID="Select SubscriptionID from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID Where SerialName=? AND Status=?";
	$getquery=sqlsrv_query($conn,$getsID,array($sname,'OnGoing'));
	$rowsid=sqlsrv_fetch_array($getquery,SQLSRV_FETCH_ASSOC);
	$sub=$rowsid['SubscriptionID'];

	return $sub;
}

if($_POST['type']=='check_dept')
{
	$dept=$_POST['dept'];
	$subID=getSubID($sn);

	

	$sql="Select Organization.DepartmentID,Organization.OrganizationID from Organization Inner Join Program On Organization.OrganizationID=Program.OrganizationID
			Inner Join Category_Serials_Program On Program.ProgramID=Category_Serials_Program.ProgramID
			Inner Join Subscription On Category_Serials_Program.SubscriptionID=Subscription.SubscriptionID
			Where Subscription.SubscriptionID=? AND DepartmentID=? Group By Organization.OrganizationID,Organization.DepartmentID";
	$query=sqlsrv_query($conn,$sql,array($subID,$dept));
	if(sqlsrv_has_rows($query))
	{	$data['orgs']='';

		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
			$data['orgs'].="<li class='tag_".$dept."'><input type='checkbox' class='org_cb' name='org' value='".$row['OrganizationID']."'>".$row['OrganizationID']."</li>";
		}
	}
	
}
else if($_POST['type']=='check_org')
{
	$org=$_POST['org'];
	$subID=getSubID($sn);
	$sql="Select Organization.DepartmentID,Organization.OrganizationID,Category_Serials_Program.ProgramID from Organization Inner Join Program On Organization.OrganizationID=Program.OrganizationID
			Inner Join Category_Serials_Program On Program.ProgramID=Category_Serials_Program.ProgramID
			Inner Join Subscription On Category_Serials_Program.SubscriptionID=Subscription.SubscriptionID
			Where Subscription.SubscriptionID=? AND Organization.OrganizationID=? Group By Organization.OrganizationID,Organization.DepartmentID,Category_Serials_Program.ProgramID";
	$query=sqlsrv_query($conn,$sql,array($subID,$org));
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