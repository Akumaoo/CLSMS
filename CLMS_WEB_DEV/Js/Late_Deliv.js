$(function(){
$table="";
$disb=$('span#disb').text();

$phase=$('span#phase').text();
	if( ! $.fn.DataTable.isDataTable("#table_late_deliv")){
	$table=$('#table_late_deliv').DataTable({			
	"processing":true,
	"serverSide":true,
	"order":[[0,"desc"]],
	"searching":true,
	"ajax":
		{"url":"SSP/serverside_Late_deliv.php",
		"method":"POST",
		"data":{disb:$disb,phase:$phase}
		}
		});
	}



	$('#table_late_deliv').on('draw.dt', function() {
	$('#table_late_deliv').Tabledit({
		url:"php_codes/update_late_deliv.php",
		columns:{
		identifier:[0,"SubscriptionID"],
		editable:[[3,'InitialDeliveryDate'],[4,'Status']]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='edit')
			{
				if(!$('#msg_fail_enter').hasClass('collapse'))
				{
					$('#msg_fail_enter').addClass('collapse');
				}

				$('#msg_scs_enter').removeClass('collapse');
				$table.ajax.reload(null,false);
			}
		},onDraw: function() {
				$('tbody tr td:nth-child(4)>input,tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
				$('tbody tr td:nth-child(5)>input').each(function(){
					$('<select class="tabledit-input form-control input-sm" style="display:none;width:90px" disabled=""><option value="OnGoing">OnGoing</option><option value="Finished">Finished</option><option value="Cancelled">Cancelled</option><option value="Refunded">Refunded</option></select>').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
	 		 }		
	});

	if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
	{
		$('.tabledit-toolbar-column').remove();
		$('tbody>tr>td:nth-child(2)').remove();
	}
		
	$('.tabledit-delete-button').remove();
	$('thead>tr>th:nth-child(6)').addClass('collapse');
	$('tbody>tr>td:nth-child(6)').addClass('collapse');

	});


	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(6)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(6)').removeClass('collapse');
			$('tbody>tr>td:nth-child(6)').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child(6)').addClass('collapse');
			$('tbody>tr>td:nth-child(6)').addClass('collapse');
 		}
 	});

});