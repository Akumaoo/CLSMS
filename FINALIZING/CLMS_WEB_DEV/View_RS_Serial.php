<?php 
require 'php_codes/db.php';
if(isset($_POST['RSID']))
{
	$RSid=$_POST['RSID'];
	$Sname=$_POST['sername'];

	
	$type=$_POST['type'];
	if($type=='pending')
	{
		$stat='NotReceived';
	}
	else
	{
		$stat='Received';
	}

	$sql="Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,TypeName,VolumeNumber,IssueNumber,DateofIssue,ReceiveSerial.Status,Staff_Comment,Staff_Seen,DateReceiveNotif_Give from
Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID  
WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing')
 AND ReceiveSerial.Remove IS NULL AND ReceiveSerial.Status='".$stat."' AND ReceivedSerialID=? AND Receive_Date=DateReceiveNotif_Give";
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
		echo '<div id="back"></div>	
			<div class="form-panel">
	<div id="view_ser_content">
	<div class="row">
		<div class="RS_header">
			<div class="RS_header_left">
				<h5><strong>Department Name:</strong> '.$Dept;
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
 	if($('span#dept').text()=="")
 	{
 		$('#back').append('<a id="refresh" href="javascript:void(0)" style="margin-left:10px;">Go Back To List</a>');
 		 
 		$('#refresh').click(function() {
			location.reload();
		});
 	}
 </script>
