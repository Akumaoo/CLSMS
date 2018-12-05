$(function(){
		$table=""
		if( ! $.fn.DataTable.isDataTable("#table_disb")){
		$table=$('#table_disb').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_distrib.php"
			});
		}

	$disbID="";
	$('#table_disb').on('draw.dt', function() {
		$('#table_disb').Tabledit({
			url:"php_codes/modify_distributors.php",
			columns:{
			identifier:[0,"DistributorID"],
			editable:[[1,"DistributorName"],[2,"NameOfIncharge"],[3,"ContactNumber"],[4,"Email"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}
					else if(!$('#msg_scs_update').hasClass('collapse'))
					{
						$('#msg_scs_update').addClass('collapse');
					}
					else if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}

					$('#msg_scs_remove').removeClass('collapse');
					$("#"+data.DistributorID).remove();
					$table.ajax.reload(null,false);				
				}
				else if(data.action=='edit')
				{
					if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}
					else if(!$('#msg_scs_remove').hasClass('collapse'))
					{
						$('#msg_scs_remove').addClass('collapse');
					}
					else if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}

					$('#msg_scs_update').removeClass('collapse');
					$table.ajax.reload(null,false);
				}
			},onDraw: function() {
				$('tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove();
	 		 }
		
		});

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}

		$('thead>tr>th:nth-child(6)').addClass('collapse');
		$('tbody>tr>td:nth-child(6)').addClass('collapse');

		$('.tabledit-confirm-button').remove();

		$('.tabledit-delete-button').click(function(){
 			$('#Remove_Modal').modal('show');
 			$disbID=$(this).closest('tr').find('td.sorting_1>span').text();
 		});
	});

	$('#Add_Distributor').on('submit',function(event){
		event.preventDefault();


 		$.ajax({
 			url:"php_codes/Insert_new_Distributor.php",
 			method:"POST",
 			data:$("#Add_Distributor").serialize(),
 			success:function(data)
 			{
				$("#Add_Distributor")[0].reset();
				$("#add_Distributor_data_Modal").modal('hide');
				if(data.status=='success')
				{
					if(!$('#msg_scs_remove').hasClass('collapse'))
					{
						$('#msg_scs_remove').addClass('collapse');
					}
					else if(!$('#msg_scs_update').hasClass('collapse'))
					{
						$('#msg_scs_update').addClass('collapse');
					}
					else if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}

					$("#msg_scs").removeClass('collapse');
					$table.ajax.reload(null,false);

				}
				else
				{
					if(!$('#msg_scs_remove').hasClass('collapse'))
					{
						$('#msg_scs_remove').addClass('collapse');
					}
					else if(!$('#msg_scs_update').hasClass('collapse'))
					{
						$('#msg_scs_update').addClass('collapse');
					}
					else if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}
				
					$('#fail_msg').html(data.status);
					$("#msg_fail").removeClass('collapse');
				}
				
 			}
 		});
	 	
	});

	$('#Disb').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#Disb').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#Disb').addClass('active');


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

 	$('#table_disb_wrapper').removeClass('form-inline');

 	 	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_distributors.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete',disbID:$disbID},
 			success:function(data)
 			{
 				if(data.action=='delete')
				{
					$('#Remove_Modal').modal('hide');
					$('#reason_data').val('');
					if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}
					else if(!$('#msg_scs_update').hasClass('collapse'))
					{
						$('#msg_scs_update').addClass('collapse');
					}
					else if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}
					$('#msg_scs_remove').removeClass('collapse');	
					$table.ajax.reload(null,false);		

				}

 			}
 		});

 	});

});