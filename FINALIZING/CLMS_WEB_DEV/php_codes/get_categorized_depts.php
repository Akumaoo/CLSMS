<?php 
require 'db.php';
if(isset($_POST['sname']))
{
	$sname=$_POST['sname'];
	// $sname='DUMMY';

	$sqlgetID="Select SubscriptionID from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID Where SerialName=? AND Status=?";
	$sqlqueryID=sqlsrv_query($conn,$sqlgetID,array($sname,'OnGoing'));
	$row=sqlsrv_fetch_array($sqlqueryID,SQLSRV_FETCH_ASSOC);
	$sID=$row['SubscriptionID'];

	$dept_list=[];
	$inc=0;
	$sql="Select * from 
	(Select CategoryID,DepartmentID as dept_main from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as asd
	Left join
	(Select Category_Serials_Program.CategoryID_Program,Organization.DepartmentID as dept_prog,Organization.OrganizationID,Category_Serials_Program.ProgramID from Organization inner join Program On Organization.OrganizationID=Program.OrganizationID Inner Join Category_Serials_Program On Program.ProgramID=Category_Serials_Program.ProgramID
	Inner Join Subscription On Category_Serials_Program.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as dsa
	On asd.dept_main=dsa.dept_prog";
	$sqlquery=sqlsrv_query($conn,$sql,array('OnGoing',$sID,'OnGoing',$sID));
	if(sqlsrv_has_rows($sqlquery))
	{	
		echo "<ul>";
		echo "<li></li>";

		while($row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC))
		{
			if(!in_array($row['dept_main'],$dept_list))
			{
				array_push($dept_list,$row['dept_main']);
			}
			
		}

		for($x=0;$x<count($dept_list);$x++)
		{
			echo "<li><input type='checkbox' class='dept_cb' name='dept' value='".$dept_list[$x]."'>".$dept_list[$x]."</li>";
		}
		
		echo '</ul>';
	}
}

 ?>