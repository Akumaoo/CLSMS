$(function(){

	$dept=$('strong#dept').html();
	if(!$.fn.DataTable.isDataTable("#table_MS")){
	$table=$('#table_MS').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":{
		"url":"SSP/serverside_LOS_Staff.php",
		"method":'POST',
		"data":{dept:$dept}}
		});
	}

 	$('#MS_STAFF').addClass('active');
 	$('#DB').removeClass('active');

 	$('#table_MS').on('draw.dt',function(){

 	$('#table_MS').Tabledit({
		url:"php_codes/modify_serial_category.php",
		columns:{
		identifier:[0,"Category_ID"],
		editable:[[4,"Usage"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='edit')
			{
				if(data.scs='success')
				{
					if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}

					$('#msg_scs').removeClass('collapse');
					$table.ajax.reload(null,false);
				}
				else
				{
					if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}

					$('#msg_fail').removeClass('collapse');

				}
				
			}
		},onDraw: function() {
				$('tbody tr td:nth-child(5)>input,tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
	 	}	
	});


 	$('thead>tr>th:nth-child(1)').addClass('collapse');
 	$('tbody>tr>td:nth-child(1)').addClass('Categ_ID collapse');

 	if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
	{
		$('.tabledit-toolbar-column').remove();
		$('tbody>tr>td:nth-child(2)').remove();
	}
		

	$('thead>tr>th:nth-child(6)').addClass('collapse');
	$('tbody>tr>td:nth-child(6)').addClass('collapse');

	$('.tabledit-delete-button').remove();

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