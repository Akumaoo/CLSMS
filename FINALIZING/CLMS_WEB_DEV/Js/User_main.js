$(function(){
	$table="";
	if( !$.fn.DataTable.isDataTable("#table_user")){
	$table=$('#table_user').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_users.php"
			});
	}

$uID="";
$('#table_user').on('draw.dt', function() {
	$('#table_user').Tabledit({
		url:"php_codes/modify_user.php",
		columns:{
		identifier:[0,"UserID"],
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
				else if(!$('#msg_fail').hasClass('collapse'))
				{
					$('#msg_fail').addClass('collapse');
				}

				$('#msg_scs_remove').removeClass('collapse');
				$("#"+data.UserID).remove();
				$table.ajax.reload(null,false);	
			}
		},
		onDraw:function(){
			$('button.tabledit-edit-button').remove();
		}
	
	});

	if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
	{
		$('.tabledit-toolbar-column').remove();
		$('tbody>tr>td:nth-child(2)').remove();
	}
		

	$('thead>tr>th:nth-child(8)').addClass('collapse');
	$('tbody>tr>td:nth-child(8)').addClass('collapse');

	$('.tabledit-confirm-button').remove();
	$('.tabledit-delete-button').click(function(){
		$('#Remove_Modal').modal('show');
		$uID=$(this).closest('tr').find('td.sorting_1>span').text();
	});


	});
	
	$('#Add_User').on('submit',function(event){
		event.preventDefault();

		var form = $('#Add_User')[0];
		var data = new FormData(form);

	 	if($('#pass1').val()!=$('#pass2').val())
	 	{
	 		alert('Confirm Password Did Not Match');
	 	}
	 	else if($("#role").val()=="stat")
	 	{
	 		alert('User Role Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_User.php",
	 			method:"POST",
	 			enctype: 'multipart/form-data',
	 			processData:false,
	 			contentType: false,
	 			data:data,
	 			success:function(data)
	 			{
 					$("#Add_User")[0].reset();
 					$("#add_user_modal").modal('hide');
 					if(data.status=='success')
 					{
 						if(!$('#msg_scs_remove').hasClass('collapse'))
						{
							$('#msg_scs_remove').addClass('collapse');
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
						else if(!$('#msg_scs').hasClass('collapse'))
						{
							$('#msg_scs').addClass('collapse');
						}

						$('#fail_msg').html(data.status);
 						$("#msg_fail").removeClass('collapse');
 					}
	 			}
	 		});
	 	}
	});

	
	$('#MU').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#MU').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#MU').addClass('active');


	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(8)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(8)').removeClass('collapse');
			$('tbody>tr>td:nth-child(8)').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child(8)').addClass('collapse');
			$('tbody>tr>td:nth-child(8)').addClass('collapse');
 		}

 	});


 	$('#role').on('change',function(){
 		if($(this).val()=='Admin')
 		{
 			$('#Dept_select').addClass('collapse');
 		}
 		else
 		{
 			if($('#Dept_select').hasClass('collapse'))
 			{
 				$('#Dept_select').removeClass('collapse');
 			}
 		}
 	});

 	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_user.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete',uID:$uID},
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