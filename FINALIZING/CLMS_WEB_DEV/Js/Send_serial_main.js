	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_SS")){
			$('#table_SS').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_Send_Serials.php"
			});
		}

	
	$('#table_SS').on('draw.dt', function() {
		
	$('tbody tr td:nth-child(3)').addClass('PName_click');
	$(".PName_click").click(function(){
		$SR_ID=$(this).closest('tr').attr('id');
		$Sname=$(this).text();
		$.ajax({
		type:'POST',
		url:'View_RS_Serial.php',
		data:{
			send_ID:$SR_ID,
			send_name:$Sname
		},
		success:function(data){
			$('.container-fluid').html(data)
		}
		});
	});

	if(!$('tbody>tr:nth-child(1)>td').hasClass('dataTables_empty'))
	{
		$('#table_SS').Tabledit({
		url:"php_codes/modify_send_Serial.php",
		columns:{
		identifier:[0,"ReceivedSerialID"],
		editable:[]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.ReceivedSerialID).remove();			
			}

		}
		});
		$('button.tabledit-edit-button').remove();

		
	}
	else
	{
		$('.tabledit-toolbar-column').remove()
	}
		
	});

	$('#Send_Serial').on('submit',function(event){
		event.preventDefault();
		 var deptlist=[];
		 $.each($('input[name="dept"]:checked'),function(){
		 	deptlist.push($(this).val());
		 });

		 var sName=$('#serialname').val();

	 	if($("#serialname").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if(deptlist.length==0)
	 	{
	 		alert("Please Choose Atleast One Department");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/insert_send_serial.php",
	 			method:"POST",
	 			data:{sername:sName,depts:deptlist},
	 			success:function(data)
	 			{
	 				if(!$('#msg_fail').hasClass('collapse'))
	 				{
	 					$('#msg_fail').addClass('collapse');
	 				}
	 				else if($('#msg_warn').hasClass('collapse'))
	 				{
	 					$('#msg_warn').addClass('collapse');
	 				}
 					$("#Send_Serial")[0].reset();
 					$("#Send_Serial_Modal").modal('hide');
 					if(data.fail_enter==0)
 					{
 						$("#msg_scs").removeClass('collapse');
 					}
 					else if(data.status>0 && data.fail_enter>0)
 					{
 						$("#msg_warn").removeClass('collapse');
 						$('.warn_val').text('Successfully Entered: '+data.status+' Data And Fail To Enter: '+data.fail_enter+' Data');
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