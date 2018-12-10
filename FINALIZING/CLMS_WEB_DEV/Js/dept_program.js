$(function(){
		$table="";
		var dept=$('span#dept_n').html();
		if( ! $.fn.DataTable.isDataTable("#table_dept_program")){
		$table=$('#table_dept_program').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":{
			"url":"SSP/serverside_programs.php",
			"method":"POST",
			"data":{dept:dept}
			}
			});
		}


	$orgID="";
	$('#table_dept_program').on('draw.dt', function() {
	$('#table_dept_program').Tabledit({
		url:"",
		columns:{
		identifier:[0,"OrganizationID"],
		editable:[]
			}
	});

	if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
	{
		$('.tabledit-toolbar-column').remove();
		$('tbody>tr>td:nth-child(2)').remove();
	}
		

	$('thead>tr>th:nth-child(3)').addClass('collapse');
	$('tbody>tr>td:nth-child(3)').addClass('collapse');

	$('.tabledit-confirm-button').remove();
	$('.tabledit-delete-button').click(function(){
		$('#Remove_Modal').modal('show');
		$orgID=$(this).closest('tr').find('td.sorting_1>span').text();

	});

	$('.tabledit-edit-button').click(function(){
		$orgID=$(this).closest('tr').find('td.sorting_1>span').text();
		$('span#orgID').text($orgID);
		$('#edit_orgs_modal').modal('show');

	});

	});

	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_department.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete_org',orgID:$orgID},
 			success:function(data)
 			{
 				if(data.action=='delete_org')
				{
					$('#Remove_Modal').modal('hide');
					$('#reason_data').val('');
					if(!$('#msg_scs_update').hasClass('collapse'))
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



	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(3)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(3)').removeClass('collapse');
			$('tbody>tr>td:nth-child(3)').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child(3)').addClass('collapse');
			$('tbody>tr>td:nth-child(3)').addClass('collapse');
 		}
 	});

	$('#modify_orgs').on('submit',function(event){
		event.preventDefault();
		
		$list_string=$('#prog_id').val();
		$orgID=$('span#orgID').text();
		$.ajax({
			url:"php_codes/re_categorize_org.php",
			method:"POST",
			data:{list:$list_string,orgID:$orgID},
			success:function(data){

				if(data.status=='success')
				{
					$('#edit_orgs_modal').modal('hide');
					$('#prog_id').val('');
					if(!$('#msg_scs_remove').hasClass('collapse'))
					{
						$('#msg_scs_remove').addClass('collapse');
					}
					if(!$('#msg_fail').hasClass('collapse'))
					{
						$('#msg_fail').addClass('collapse');
					}
					$('#msg_scs_update').removeClass('collapse');	
					$table.ajax.reload(null,false);		
				}
				else
				{
					$('#edit_orgs_modal').modal('hide');
					$('#prog_id').val('');
					if(!$('#msg_scs_remove').hasClass('collapse'))
					{
						$('#msg_scs_remove').addClass('collapse');
					}
					else if(!$('#msg_scs_update').hasClass('collapse'))
					{
						$('#msg_scs_update').addClass('collapse');
					}

					$('#fail_msg').html(data.status);
					$('#msg_fail').removeClass('collapse');	
					$table.ajax.reload(null,false);		

				}
			}
		});
	});


});