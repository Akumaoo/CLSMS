$(function(){
 		if( ! $.fn.DataTable.isDataTable("#table_pack")){
		$('#table_pack').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,
		"pageLength":100
		// "ajax":"php_codes/serverside_currentSubs.php",
			});


		}

		$('#table_pack').Tabledit({
		url:"php_codes/modify_delivery_pack.php",
		columns:{
		identifier:[0,"DeliveryID"],
		editable:[[3,"DateofIssue"],[4,"IssueNumber"],[5,"VolumeNumber"],[6,'Copies']]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.DeliveryID).remove();			
			}
			else if(data.status=='success')
			{
				$('#msg_scs').removeClass('collapse');
			}
		},onDraw: function() {
			$('tbody tr td:nth-child(4)>input').each(function(){
				$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
			}).remove()
 		 }
	
		});

	
		$('#create_new_delivery').on('submit',function(event){
		event.preventDefault();

		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var output_date_today = d.getFullYear() + '/' +
		    (month<10 ? '0' : '') + month + '/' +
		    (day<10 ? '0' : '') + day;


	 	if($("#SN").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if(new Date($('#DOI').val())<=new Date(output_date_today))
	 	{
	 		alert("Date of Issue Is Past The Date Today");
	 	}
	 	else if($("#Copy").val()=="")
	 	{
	 		alert('Number of Copies Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/insert_serial_pack.php",
	 			method:"POST",
	 			data:$("#create_new_delivery").serialize(),
	 			success:function(data)
	 			{
 					$("#create_new_delivery")[0].reset();
 					if(data.status=='success')
 					{
 						$("#msg_scs_modal").removeClass('collapse');
 						$('#save_btn').addClass('collapse');
 						$('#retry').removeClass('collapse');

 					}
 					else
 					{
 						$('#add_delivery_data_Modal').modal('hide');
 						$("#msg_fail").removeClass('collapse');
 					}
	 			},
	 			error:function(){
	 				$("#create_new_delivery")[0].reset();
 					$("#add_delivery_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	}
	});

	$('#btn_yes').click(function(){
		$("#msg_scs_modal").addClass('collapse');
		$("#create_new_delivery")[0].reset();
		$('#save_btn').removeClass('collapse');
 		$('#retry').addClass('collapse');
	});

	$('#btn_no').click(function(){
		$("#create_new_delivery")[0].reset();
		$('#add_delivery_data_Modal').modal('hide');
	});

	$('#add_delivery_data_Modal').on('hidden.bs.modal', function(){
 			if(!$('#msg_fail_modal').hasClass('collapse'))
 			{
 				$('#msg_fail_modal').addClass('collapse');
 			}
 	});

 	});