<?php
require 'php_codes/db.php';
echo '

<div class="container custom_table">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">Received</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';

		$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID]";
		$query=sqlsrv_query($conn,$sqltxt,array(),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$distname=$row['DistributorName'];
				$serialname=$row['SerialName'];
				$orders=$row['Orders'];
				$cost=$row['Cost'];
				$NIR=$row['NumberOfItemReceived'];
				$stat=$row['Status'];
		echo '
				<tr class="gradeU">
					<td class="radio-label-center">'.$distname.'</td>
					<td class="radio-label-center">'.$serialname.'</td>
					<td class="radio-label-center">'.$orders.'</td>
					<td class="radio-label-center">'.$cost.'</td>
					<td class="radio-label-center">'.$NIR.'</td>
					<td class="radio-label-center">'.$stat.'</td>
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
	if( ! $.fn.DataTable.isDataTable("#table_subs")){
		$('#table_subs').DataTable({
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

