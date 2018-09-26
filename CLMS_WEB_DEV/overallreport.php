<?php
require 'php_codes/db.php';
echo '

<div class="container custom_table">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="or" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">Department</th>
				<th class="radio-label-center">Course</th>
				<th class="radio-label-center">Type of Publication</th>
				<th class="radio-label-center">Title</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center"># of Received Issues</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';

		$sqltxt='SELECT Department.DepartmentName, Course.CourseName, "Type".TypeName, Serial.SerialName, Subscription.Orders, Distributor.DistributorName, Subscription.Cost, Subscription.NumberOfItemReceived, Subscription."Status"
				FROM Distributor
				LEFT JOIN Subscription
					ON Subscription.DistributorID = Distributor.DistributorID
				LEFT JOIN Serial
					On Serial.SerialID = Subscription.SerialID
				LEFT JOIN ReceiveSerial
					On ReceiveSerial.SerialID = Serial.SerialID
				LEFT JOIN Department
					ON Department.DepartmentID = ReceiveSerial.DepartmentID
				LEFT JOIN Course
					ON Course.DepartmentID = Department.DepartmentID
				LEFT JOIN "Type"
					ON "Type".TypeID = Serial.TypeID';
		$query=sqlsrv_query($conn,$sqltxt,array(),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$dept=$row['DepartmentName'];
				$course=$row['CourseName'];
				$type=$row['TypeName'];
				$title=$row['SerialName'];
				$orders=$row['Orders'];
				$distname=$row['DistributorName'];
				$cost=$row['Cost'];
				$itemreceived=$row['NumberOfItemReceived'];
				$status=$row['Status'];
				
		echo '
				<tr class="gradeU">
					<td class="radio-label-center">'.$dept.'</td>
					<td class="radio-label-center">'.$course.'</td>
					<td class="radio-label-center">'.$type.'</td>
					<td class="radio-label-center">'.$title.'</td>
					<td class="radio-label-center">'.$orders.'</td>
					<td class="radio-label-center">'.$distname.'</td>
					<td class="radio-label-center">'.$cost.'</td>
					<td class="radio-label-center">'.$itemreceived.'</td>
					<td class="radio-label-center">'.$status.'</td>
				</tr>

			';
			}
		}
echo '
</tbody>
</table>
</div>
</div>
<div>';
?>

<script type="text/javascript">
	if( ! $.fn.DataTable.isDataTable("#or")){
		$('#or').DataTable({
			"ordering":true,
			"searching":true,
			"columnDefs":
				[{
					"targets":[2,3,4],
					"searchable":false,
					"visible":true
				}]
		});
	}
</script>