<?php 
require 'db.php';
if(isset($_POST['sname']))
{
	$sname=$_POST['sname'];
	// $sname='DUMMY';

	$sqlgetID="Select SerialID from Serial Where SerialName=?";
	$sqlqueryID=sqlsrv_query($conn,$sqlgetID,array($sname));
	$row=sqlsrv_fetch_array($sqlqueryID,SQLSRV_FETCH_ASSOC);
	$sID=$row['SerialID'];

	// GET FREQ
	$sqlfreq="Select Frequency from Subscription Where SerialID=? AND Status=?";
	$sqlfrequery=sqlsrv_query($conn,$sqlfreq,array($sID,'OnGoing'));
	$rowfreq=sqlsrv_fetch_array($sqlfrequery,SQLSRV_FETCH_ASSOC);
	$freq=$rowfreq['Frequency'];

	$sql="Select Department.DepartmentID From Department Inner Join Categorize_Serials ON Department.DepartmentID=Categorize_Serials.DepartmentID Inner Join Subscription ON Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.SerialID=? AND Status=? AND NumberOfItemReceived!=?";
	$sqlquery=sqlsrv_query($conn,$sql,array($sID,'OnGoing',$freq));
	if(sqlsrv_has_rows($sqlquery))
	{	
		echo "<ul>";
		echo "<li><input type='checkbox' value='SA' class='SA'>Select All</li>";

		while($row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC))
		{
			echo "<li><input type='checkbox' name='dept' value='".$row['DepartmentID']."'>".$row['DepartmentID']."</li>";
		}
		echo '</ul>';
	}
}

 ?>