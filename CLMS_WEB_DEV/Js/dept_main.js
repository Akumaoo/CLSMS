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

$('#table_dept').on('draw.dt', function() {
	$('#table_dept').Tabledit({
		url:"php_codes/modify_department.php",
		columns:{
		identifier:[0,"DepartmentID"],
		editable:[[1,"DepartmentName"]]
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

	});
	
		





	$('#Add_Department').on('submit',function(event){
		event.preventDefault();

	 	
	 	if($("#id").val()=="")
	 	{
	 		alert("Department ID Is Required");
	 	}
	 	else if($("#Dname").val()=="")
	 	{
	 		alert("Department Name Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_Department.php",
	 			method:"POST",
	 			data:$("#Add_Department").serialize(),
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

 						$("#msg_fail").removeClass('collapse');

 					}
 					
	 			},
	 			error:function(){
	 				$("#Add_Department")[0].reset();
 					$("#add_Department_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	}
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


});