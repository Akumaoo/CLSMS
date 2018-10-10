<?php 
require 'php_codes/db.php';
if(isset($_POST['send_ID']))
{
	$RSid=$_POST['send_ID'];
	$Sname=$_POST['send_name'];

	$sql="Select * from ReceiveSerial Where ReceivedSerialID=?";
	$query=sqlsrv_query($conn,$sql,array($RSid));
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$Dept=$row['DepartmentID'];
		$Stat=$row['Status'];
		$seen=$row['RS_Seen'];
		$Contno=$row['ControlNumber'];
		$comment=$row['Staff_Comment'];
		$DS=$row['DateReceiveNotif_Give']->format('Y/m/d');
	}

	echo '<div class="form-panel site-min-height">
	<div class="row">
		<div class="RS_header">
			<div class="RS_header_left">
				<h5><strong>Department Name:</strong> '.$Dept.'</h5>
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
		<div class="col-lg-10" style="margin-left: 66px;margin-top: 40px;">
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
</div>';
}
 ?>