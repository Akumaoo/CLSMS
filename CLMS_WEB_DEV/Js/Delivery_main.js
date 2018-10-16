$(function(){

	if( !$.fn.DataTable.isDataTable("#table_deli")){
		$('#table_deli').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_deliveries.php"
		});
	}
	$('#table_deli').on('draw.dt', function() {
		$('#table_deli').Tabledit({
			url:"php_codes/modify_delivery_pack.php",
			columns:{
			identifier:[0,"DeliveryID"],
			editable:[]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.DeliveryID).remove();			
				}
			},onDraw: function() 
			{
				$('.tabledit-edit-button').remove();
	 		}
		
		});

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
	});

	$('#receive_del_form').on('submit',function(event){
		event.preventDefault();

 		$.ajax({
 			url:"php_codes/insert_serial_pack.php",
 			method:"POST",
 			data:$("#receive_del_form").serialize(),
 			success:function(data)
 			{
				$("#receive_del_form")[0].reset();
				if(data.status=='success')
				{
					if(!$("#msg_fail_rec").hasClass('collapse'))
					{
						$("#msg_fail_rec").addClass('collapse');
					}
					$('#retry').removeClass('collapse');
					$('#save_btn').addClass('collapse');

					$("#msg_scs_rec").removeClass('collapse');
				}
				else
				{
					$("#msg_fail_rec").removeClass('collapse');
				}
 			}
 		});
	 	
	});

	$('#btn_yes,#btn_no').click(function(){
		$('#msg_scs_rec').addClass('collapse');
		$('#retry').addClass('collapse');
		$('#save_btn').removeClass('collapse');
	});
	$('#btn_no').click(function(){
		$('#receive_deliv_modal').modal('hide');
	});
});