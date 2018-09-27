<?php
require 'php_codes/db.php';
echo '
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Subscription:</h5>
			<hr class="theme_hr">
		</div>
	</div>	

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Subscribed!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>
  
	<div class="row custom_table">
		<div class="col-lg-10 col-lg-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">SubscriptionID</th>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">Received</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';

		$sqltxt="Select [Subscription].[SubscriptionID],[Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID]";
		$query=sqlsrv_query($conn,$sqltxt,array(),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$subsID=$row['SubscriptionID'];
				$distname=$row['DistributorName'];
				$serialname=$row['SerialName'];
				$orders=$row['Orders'];
				$cost=$row['Cost'];
				$NIR=$row['NumberOfItemReceived'];
				$stat=$row['Status'];
		echo '
				<tr class="gradeU">
					<td class="radio-label-center">'.$subsID.'</td>
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
	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="SN" id="SN" data-toggle="modal" data-target="#add_data_Modal" class="btn custom-btn">Subscribe Now!</button>
		</div>
	</div>
<div>';
include 'php_codes/Add_Subscription_Modal.php';
?>

<script type="text/javascript">

$(function(){

	$('#table_subs').Tabledit({
	url:"php_codes/modify_subs.php",
	columns:{
		identifier:[0,"SubscriptionID"],
		editable:[[1,"DistributorName"],[2,"SerialName"],[3,"Orders"],[4,"Cost"],[5,"NumberOfItemReceived"],[6,"Status"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.SubscriptionID).remove();			
			}

		}
	
	});

	$('#subscribe_new_form').on('submit',function(event){
		event.preventDefault();

	 	if($("#DN").val()=="")
	 	{
	 		alert("Disbtributor Name Is Required");
	 	}
	 	else if($("#SNf").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if($("#Freq").val()=="")
	 	{
	 		alert("Frequency Is Required");
	 	}
	 	else if($("#Cost").val()=="")
	 	{
	 		alert("Cost Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_New_Subscription.php",
	 			method:"POST",
	 			data:$("#subscribe_new_form").serialize(),
	 			success:function(data)
	 			{
 					$("#subscribe_new_form")[0].reset();
 					$("#add_data_Modal").modal('hide');
 					if(data.status=='success')
 					{
 						$("#msg_scs").removeClass('collapse');
 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');
 					}

	 			}
	 		});
	 	}
	});

});



if( ! $.fn.DataTable.isDataTable("#table_subs")){
	$('#table_subs').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,
		// "ajax":"php_codes/serverside_currentSubs.php",
		"columnDefs":
			[{
				"targets":[0,3,4,5],
				"searchable":false,
				"visible":true
			}]
	});
}

</script>

