$(function(){
	$table="";
	if(!$.fn.DataTable.isDataTable("#table_MS")){
	$table=$('#table_MS').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":"SSP/serverside_manage_serials.php"
		});
	}

$sID="";
$('#table_MS').on('draw.dt', function() {
		$('#table_MS').Tabledit({
			url:"php_codes/modify_serials.php",
			columns:{
			identifier:[0,"SerialID"],
			editable:[[2,"TypeName"],[3,'Origin']]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.status=='success')
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

					$("#msg_scs_update").removeClass('collapse');
					$table.ajax.reload(null,false);
				
				}
			},onDraw: function() {
	
				$('tbody tr td:nth-child(3)>input').each(function(){
					$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option style="display: none" value="stat">--Type--</option><option value="Magazine">Magazine</option><option value="Journal">Journal</option>').attr({ name: this.name, value: this.value }).insertBefore(this)		
				}).remove();
				$('tbody tr td:nth-child(4)>input').each(function(){
					$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option style="display: none" value="stat">--Origin--</option><option value="Local">Local</option><option value="International">International</option>').attr({ name: this.name, value: this.value }).insertBefore(this)		
				}).remove();
	 		 }
		
		});

		

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}

		$('thead>tr>th:nth-child(5)').addClass('collapse');
		$('tbody>tr>td:nth-child(5)').addClass('collapse');
		
		// RECYCLE
		$('.tabledit-confirm-button').remove();

		$('.tabledit-delete-button').click(function(){
 			$('#Remove_Modal').modal('show');
 			$sID=$(this).closest('tr').find('td.sorting_1>span').text();
 		});


	});

	$('#Add_Serial').on('submit',function(event){
		event.preventDefault();

		 var sName=$('#serialname').val();
		 var type=$('#type option:selected').val();
		 var orig=$('#orig option:selected').val();

	 	if($("#serialname").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_serial.php",
	 			method:"POST",
	 			data:{sername:sName,origin:orig,stype:type},
	 			success:function(data)
	 			{
	 				$('#Add_Serial_Modal').modal('hide');
	 				
 					$("#Add_Serial")[0].reset();
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
	 			}
	 		});
	 	}
	});

	 $('#Add_Serial_Modal').on('hidden.bs.modal', function(){
		if(!$('#msg_fail').hasClass('collapse'))
		{
			$('#msg_fail').addClass('collapse');
		}
	 });

	
 	$('#MS').closest('li.sub-menu').find('a.dcjq-parent').addClass('active');
 	$('#MS').closest('li.sub-menu ul.sub').css('display', 'block');
 	$('#MS').addClass('active');

 	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(5)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(5)').removeClass('collapse');
			$('tbody>tr>td:nth-child(5)').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child(5)').addClass('collapse');
			$('tbody>tr>td:nth-child(5)').addClass('collapse');
 		}
 	});

 	$('#table_MS_wrapper').removeClass('form-inline');

 	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_serials.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete',sID:$sID},
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
