<?php
require 'php_codes/db.php';
echo '
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Subscriptions:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_enter">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Update Subscriptions!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_enter">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>	
  
	<div class="row custom_table">
		<div class="col-lg-10 col-lg-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">SubscriptionID</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">Received</th>
				<th class="radio-label-center">Subscription Date</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';
echo '
</tbody>
</table>
</div>
</div>
	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="SN" id="SN" data-toggle="modal" data-target="#add_data_Modal" class="custom-btn">Subscribe Now!</button>
		</div>
	</div>
<div>';
include 'Modals/Add_Subscription_Modal.php';
include 'Modals/Add_Subscription_Modal_secondstep.php';
?>

<script type="text/javascript">

$(function(){

	if( !$.fn.DataTable.isDataTable("#table_subs")){
		$('#table_subs').DataTable({			
			"processing":true,
			"serverSide":true,
			"ordering":true,
			"searching":true,
			"ajax":"SSP/serverside_currentSubs.php",
			"columnDefs":
				[{
					"targets":[0,3,4,5],
					"searchable":false,
				}]
		});
	}
	$('#table_subs').on('draw.dt', function() {
		$('#table_subs').Tabledit({
		url:"php_codes/modify_subs.php",
		columns:{
			identifier:[0,"SubscriptionID"],
			editable:[[1,"SerialName"],[3,"Orders"],[4,"Cost"],[7,"Status"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.SubscriptionID).remove();			
				}
				if(data.status=='success')
				{
					$("#msg_scs_enter").removeClass('collapse');
				}
				else
				{
					$("#msg_fail_enter").removeClass('collapse');
				}

			},onDraw: function() {
				$('tbody tr td:nth-child(4)>input,tbody tr td:nth-child(5)>input,tbody tr td:nth-child(6)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
				$('tbody tr td:nth-child(8)>input').each(function(){
					$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option value="OnGoing">OnGoing</option><option value="Finished">Finished</option><option value="Cancelled">Cancelled</option><option value="Refunded">Refunded</option></select>').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
	 		 }		
		
		});
	});

	$show_SS=false;

	$('#first_step').on('submit',function(event){
		event.preventDefault();
	 	if($("#DN").val()=="")
	 	{
	 		alert("Disbtributor Name Is Required");
	 	}
	 	else if($("#PN").val()=="")
	 	{
	 		alert("Package Name Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"Modals/validate_add_subs.php",
	 			method:"POST",
	 			data:$("#first_step").serialize(),
	 			success:function(data)
	 			{	
	 				if(data.status!='fail')
	 				{	$show_SS=true;

	 					$('#Disb_N').val($('#DN').val())
	 					$('#Pack_N').val($('#PN').val())
 						$('#add_data_Modal').modal('hide');
 						
 					}
 					else
 					{
 						$("#error").removeClass('collapse');
 						$("#first_step")[0].reset();
 					}

	 			}
	 		});
	 	}
	});

	  $('#add_data_Modal').on('hidden.bs.modal', function(){
		 if($show_SS)
			{
 				$('#add_data_Modal_next').modal('show');
 				$show_SS=false;
 			}else if(!$('#error').hasClass('collapse'))
			{
 				$('#error').addClass('collapse');
 			}
 		
 		});
	  $('#add_data_Modal_next').on('hidden.bs.modal', function(){
			$("#subscribe_new_form")[0].reset();
 			if(!$('#msg_fail').hasClass('collapse'))
 			{
 				$('#msg_fail').addClass('collapse');
 			}
 		});

	 
	


});
</script>

