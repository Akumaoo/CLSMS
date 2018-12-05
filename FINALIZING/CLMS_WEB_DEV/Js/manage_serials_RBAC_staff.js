$(function(){

	$dept=$('strong#dept').html();

	$iden=$('th:nth-child(2)').text();

	if($iden=="Program")
	{
		$type='Multiple';
		$col_colmn=8;
	}
	else
	{
		$col_colmn=7;
		$type='Single';
	}

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
		url:"",
		columns:{
		identifier:[0,"Category_ID"],
		editable:[]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{			
		}	
	});

 	$('thead>tr>th:nth-child(1)').addClass('collapse');
 	$('tbody>tr>td:nth-child(1)').addClass('Categ_ID collapse');

 	if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
	{
		$('.tabledit-toolbar-column').remove();
		$('tbody>tr>td:nth-child(2)').remove();
	}
		

	$('thead>tr>th:nth-child('+$col_colmn+')').addClass('collapse');
	$('tbody>tr>td:nth-child('+$col_colmn+')').addClass('collapse');

	$('.tabledit-delete-button').remove();
	$('.tabledit-edit-button').remove();
	if($('.Select_Usage').text()=="")
	{
		$('.tabledit-toolbar-column').append('<select name="type" Class="Select_Usage fill-tag"><option value="Add">Add</option><option value="Remove">Remove</option></select>');
		$('.tabledit-toolbar-column').append('<select name="p_type" Class="Select_P fill-tag"><option value="Student">Student</option><option value="Employee">Employee</option></select>');
	}
	$('.btn-group').append('<button type="button" class="tabledit-add-usage-emp btn btn-sm btn-default" style="float: none;"><span class="fa fa-plus-circle ico_plus"></span><span class="fa fa-minus-circle hidden ico_minus"></span> <span class="btn_text">Student</span></button>');
	
	$('.Select_Usage').change(function(){
		if($(this).val()=='Add')
		{
			$('.ico_minus').each(function(){
				$(this).addClass('hidden');
			})
			$('.ico_plus').each(function(){
				$(this).removeClass('hidden');
			})
		}
		else
		{
			$('.ico_plus').each(function(){
				$(this).addClass('hidden');
			})
			$('.ico_minus').each(function(){
				$(this).removeClass('hidden');
			})
		}
		// alert('asd');
	});

	$('.Select_P').change(function(){
		
		$('.btn_text').text($(this).val());
	});

	$('.tabledit-add-usage-emp').click(function(){
		
		$cID=$(this).closest('tr').find('td.Categ_ID').text();
		$plus_minus=$('.Select_Usage').val();
		$stud_emp=$('.Select_P').val();

		$.ajax({
			url:"php_codes/modify_serial_category.php",
			method:"POST",
			data:{type:$type,cID:$cID,plus_minus:$plus_minus,stud_emp:$stud_emp},
			success:function(data){

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
				$('.Select_Usage').prop('selectedIndex',0);
				$('.Select_P').prop('selectedIndex',0);
			}
		});
		// alert($cID+"||"+$type+"||"+$plus_minus+"||"+$stud_emp);
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

 		if($('thead>tr>th:nth-child('+$col_colmn+')').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child('+$col_colmn+')').removeClass('collapse');
			$('tbody>tr>td:nth-child('+$col_colmn+')').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child('+$col_colmn+')').addClass('collapse');
			$('tbody>tr>td:nth-child('+$col_colmn+')').addClass('collapse');
 		}
 	});

	$('#gen_rep').click(function(){
		$('#Print_Modal').modal('show');
	});

	$('#form_report').on('submit',function(event){
		$('#Print_Modal').modal('hide');
	});

	$('#form_report').attr({
		action: 'fpdf/Reports/Staff_List_Ser.php'
	});


});