	$(function(){
		$table="";
		if( ! $.fn.DataTable.isDataTable("#table_dept")){
		$table=$('#table_dept').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_dept.php"
			});
		}

$deptID="";
$('#table_dept').on('draw.dt', function() {
	$('#table_dept').Tabledit({
		url:"php_codes/modify_department.php",
		columns:{
		identifier:[0,"DepartmentID"],
		editable:[]
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
				$("#"+data.DepartmentID).remove();
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
		$deptID=$(this).closest('tr').find('td.sorting_1>span').text();
	});

	$('.tabledit-edit-button').remove();

	$('tbody tr td:nth-child(1)').addClass('dept_ID');
	$('tbody tr td:nth-child(2)').addClass('org_click');

	$(".org_click").click(function(){
			var dept=$(this).closest('tr').find('.dept_ID').text();
			$.ajax({
			type:'POST',
			url:'Dept_Programs.php',
			data:{dept:dept},
			success:function(data){
				$('.main-chart').html(data)
			}
			});
		});

	});
	
		





	$('#Add_Department').on('submit',function(event){
		event.preventDefault();

			$deptID=$('#id').val();
			$org_id=$('#org_id').val();
			$prog_id_list=$('#prog_id').val();

	 		$.ajax({
	 			url:"php_codes/Insert_new_Department.php",
	 			method:"POST",
	 			data:{deptID:$deptID,orgID:$org_id,progID:$prog_id_list},
	 			success:function(data)
	 			{
 					$("#Add_Department")[0].reset();
 					$("#add_Department_data_Modal").modal('hide');
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

						$('#org_cont').addClass('collapse');
			 			$('#org_id').prop('required',false);
			 			$('#prog_id').prop('required',false);
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

						$('#org_cont').addClass('collapse');
			 			$('#org_id').prop('required',false);
			 			$('#prog_id').prop('required',false);
 						$("#msg_fail").removeClass('collapse');

 					}
 					
	 			},
	 			error:function(){
	 				$("#Add_Department")[0].reset();
 					$("#add_Department_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	
	});


	$('#Dept').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#Dept').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#Dept').addClass('active');

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

 	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_department.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete',deptID:$deptID},
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

 	$('#cb_org').change(function(){
 		if($(this).is(':checked'))
 		{	
 			$('#org_cont').removeClass('collapse');
 			$('#org_id').prop('required',true);
 			$('#prog_id').prop('required',true);
 		}
 		else
 		{
 			$('#org_cont').addClass('collapse');
 			$('#org_id').prop('required',false);
 			$('#prog_id').prop('required',false);
 		}
 	});

});