<?php 
require 'php_codes/db.php';
if(isset($_POST['RSID']))
{
	$RSid=$_POST['RSID'];
	$Sname=$_POST['sername'];
	if($_POST['prog']!="")
	{
		$prog="AND ProgramID='".$_POST['prog']."'";
	}
	else
	{
		$prog="";
	}
	
	$type=$_POST['type'];
	if($type=='pending')
	{
		$stat='NotReceived';
	}
	else
	{
		$stat='Received';
	}

	$sql="Select ReceivedSerialID,asd.DepartmentID,dsa.ReceiveSerialID_Program,dsa.ProgramID,
		(CASE
			WHEN dsa.ProgramID IS NULL
			THEN asd.ControlNumber
			ELSE
				dsa.ControlNumber_Prog
			END
		)as ControlNumber,asd.SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,
		(CASE
			WHEN dsa.ProgramID IS NULL
			THEN stat_main
			ELSE
				stat_prog
			END
		)as Status,
		(CASE
			WHEN dsa.ProgramID IS NULL
			THEN asd.Staff_Comment
			ELSE 
				dsa.Staff_Comment_Prog
			END
		)as Staff_Comment,asd.Staff_Seen,asd.DateReceiveNotif_Give from
			(Select ReceivedSerialID,Staff_Seen,ReceiveSerial.Status as stat_main,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment,ReceiveSerial.Remove,ReceiveSerial.Status,Subscription.Status as subs_stat,DateReceiveNotif_Give from Delivery_Subs Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
			Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE Subscription.Status='OnGoing') as asd
			Left Join
			(Select Organization.DepartmentID,ReceiveSerial_Program.Status_Prog as stat_prog,ReceiveSerialID_Program,ReceiveSerial_Program.ProgramID,SerialName,Staff_Comment_Prog,ControlNumber_Prog,Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
			Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID 
			Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
			WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status='".$stat."' OR dsa.Status_Prog='".$stat."') AND ReceivedSerialID=? ".$prog;
	$query=sqlsrv_query($conn,$sql,array($RSid));
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$Dept=$row['DepartmentID'];
		$Stat=$row['Status'];
		$seen=$row['Staff_Seen'];
		$Contno=$row['ControlNumber'];
		$comment=$row['Staff_Comment'];
		$DS=$row['DateReceiveNotif_Give']->format('Y/m/d');
	}
		echo '<div>
			<a id="refresh" href="javascript:void(0)" style="margin-left:10px;">Go Back To List</a>
			</div>';	
	echo '<div class="form-panel">
	<div id="view_ser_content">
	<div class="row">
		<div class="RS_header">
			<div class="RS_header_left">
				<h5><strong>Department Name:</strong> '.$Dept;
				if($_POST['prog']!="")
				{
					echo ' ['.$_POST["prog"].']';
				}
				echo '</h5>
				<h5><strong>Serial Name:</strong> '.$Sname.'</h5>
			</div>
			<div class="RS_header_right">
				<h5><strong>Status:</strong> '.$Stat;
				if($seen=='Seen')
				{
					echo '[Seen]</h5>';
				}
				else
				{
					echo '[NotSeen]</h5>';
				}
				echo '
				<h5><strong>Date Send:</strong> '.$DS.'</h5>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10" style="margin-left: 66px;">
			<hr class="theme_hr">
		</div>
	</div>
	<div class="row">
		<div class="RS_MSG">
			<div class="RS_header_left">
				<h7><strong>Comment:</strong></h7>
			</div>
			<div class="RS_header_right">
				<h7><strong>Control No:</strong> '.$Contno.'</h7>
			</div>
		</div>
	</div>
	<div class="row">
		<div>
			<p class="RS_comment"> '.$comment.'</p>
		</div>
	</div>
	</div>
</div>';
}
 ?>
 <script>
 	$('#refresh').click(function() {
		location.reload();
	});
 </script>
