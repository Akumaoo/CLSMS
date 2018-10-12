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

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
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