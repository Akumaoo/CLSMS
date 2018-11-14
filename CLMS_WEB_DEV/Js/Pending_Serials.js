$(function(){
$table="";
$data=$('span#dept').text();
$date=$('span#date').text();
	if( ! $.fn.DataTable.isDataTable("#table_pending_ser")){
	$table=$('#table_pending_ser').DataTable({			
	"processing":true,
	"serverSide":true,
	"order":[[0,"desc"]],
	"searching":true,
	"ajax":
		{"url":"SSP/serverside_Pending_Serials.php",
		"method":"POST",
		"data":{data:$data,date:$date}
		}
		});
	}


	$('#table_pending_ser').on('draw.dt', function() {
		
		$('tbody tr td:nth-child(1)').addClass('rsID');
		$('tbody tr td:nth-child(3)').addClass('ser_click');

		$(".ser_click").click(function(){
			var sername=$(this).text();
			var RSID=$(this).closest('tr').find('.rsID').text();
			$.ajax({
			type:'POST',
			url:'View_RS_Serial.php',
			data:{sername:sername,RSID:RSID},
			success:function(data){
				$('.view_ser').html(data)
			}
			});


		});

		$('#table_pending_ser').Tabledit({
		url:"php_codes/modify_send_Serial.php",
		columns:{
			identifier:[0,"ReceivedSerialID"],
			editable:[]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					
					$('#msg_scs_enter').removeClass('collapse');
					$table.ajax.reload(null,false);
								
				}
	 		}		
		
		});

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}

		$('thead>tr>th:nth-child(7)').addClass('collapse');
		$('tbody>tr>td:nth-child(7)').addClass('collapse');
		$('.tabledit-edit-button').remove();
		$('.tabledit-restore-button').remove();


	});

	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(7)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(7)').removeClass('collapse');
			$('tbody>tr>td:nth-child(7)').removeClass('collapse');
			
 		}
 		else
 		{
 			// DELETE BTN
		$('button.tabledit-delete-button').each(function(){
				if($(this).hasClass('active'))
				{
					$(this).removeClass('active');
				}
		});
		$('button.tabledit-confirm-button').each(function(){
 					if($(this).css('display')!='none')
 					{
 						$(this).css('display','none');
 					}
 		});

 			if($x!=0)
 			{
 				$('input.tabledit-input').each(function(){
 					$(this).css('display','none');
 					$(this).closest('td.tabledit-edit-mode').find('span.tabledit-span').css('display', 'inline');
 				});
 				$('select.tabledit-input').each(function(){
 					$(this).css('display','none');
 					$(this).closest('td.tabledit-edit-mode').find('span.tabledit-span').css('display', 'inline');
 				});

 				$('button.tabledit-edit-button').each(function(){
 					if($(this).hasClass('active'))
 					{
 						$(this).removeClass('active');
 					}
 				});
 			

 				$('button.tabledit-save-button').each(function(){
 					if($(this).css('display')!='none')
 					{
 						$(this).css('display','none');
 					}
 				});
 				
 				$('button.tabledit-restore-button').each(function(){
 					if($(this).css('display')!='none')
 					{
 						$(this).css('display','none');
 					}
 				});

 				$x=0;
 			}
 			

 			$('thead>tr>th:nth-child(7)').addClass('collapse');
			$('tbody>tr>td:nth-child(7)').addClass('collapse');
 		}
 	});


	
});