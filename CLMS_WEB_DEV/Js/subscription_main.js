$(function(){
	$table="";
	if( !$.fn.DataTable.isDataTable("#table_subs")){
		$rID=$('span#rid').text();
		$dept=$('strong#disbn').text();
		$table=$('#table_subs').DataTable({			
			"processing":true,
			"serverSide":true,
			"ordering":true,
			"searching":true,
			"ajax":{
				"url":"SSP/serverside_currentSubs.php",
				"method":"POST",
				"data":{rid:$rID,depts:$dept}
			},
			"columnDefs":
				[{
					"targets":[0,2,3,4],
					"searchable":false
				}]
		});
	}
	$subID="";
	$('#table_subs').on('draw.dt', function() {
		$('#table_subs').Tabledit({
		url:"php_codes/modify_subs.php",
		columns:{
			identifier:[0,"SubscriptionID"],
			editable:[[2,"Orders"],[3,"Cost"],[4,"Status"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					
					$("#"+data.SubscriptionID).remove();			
				}
				else if(data.status=='success')
				{
					if(!$('#msg_fail_enter').hasClass('collapse'))
					{
						$('#msg_fail_enter').addClass('collapse');
					}
					else if(!$('#msg_deliv_enter').hasClass('collapse'))
					{
						$('#msg_deliv_enter').addClass('collapse');
					}
					else if(!$('#msg_remove').hasClass('collapse'))
					{
						$('#msg_remove').addClass('collapse');
					}

					$("#msg_scs_enter").removeClass('collapse');
					$table.ajax.reload(null,false);
				}
				else
				{
					if(!$('#msg_scs_enter').hasClass('collapse'))
					{
						$('#msg_scs_enter').addClass('collapse');
					}
					else if(!$('#msg_deliv_enter').hasClass('collapse'))
					{
						$('#msg_deliv_enter').addClass('collapse');
					}
					else if(!$('#msg_remove').hasClass('collapse'))
					{
						$('#msg_remove').addClass('collapse');
					}

					$("#msg_fail_enter").removeClass('collapse');
				}

			},onDraw: function() {
				$('tbody tr td:nth-child(3)>input,tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
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

		$('thead>tr>th:nth-child(9)').addClass('collapse');
		$('tbody>tr>td:nth-child(9)').addClass('collapse');

		// modify action buttons
		if($('span#rid').text()!="")
		{
			$('.btn-group').append('<button type="button" class="tabledit-deliv-button btn btn-sm btn-default" style="float: none;"><span class="fa fa-truck"></span></button>');
		}

		$('.tabledit-deliv-button').click(function(){

	   		$sname=$(this).closest('tr').find('td').eq(1).text();
	   		$('#Serial_Name').html($sname);
	   		$('#sn_rec').val($sname);

	   		$.ajax({
	   			url:'php_codes/get_categorized_depts.php',
	   			method:'POST',
	   			data:{sname:$sname},
	   			success:function(data){
	   				$('#dept_list_categ').html(data);
	   			}
	   		});
	   		$('#receive_deliv_modal').modal('show');

	  	 });

		$('tbody tr td:nth-child(2)').addClass('ser_click');

		$(".ser_click").click(function(){
			var serial_ID=$(this).text();
			$.ajax({
			type:'POST',
			url:'php_codes/View_dept_serial.php',
			data:{S_ID:serial_ID},
			success:function(data){
				$('.main-chart').html(data)
			}
			});

		});	
		
		$('.tabledit-confirm-button').remove();

		$('.tabledit-delete-button').click(function(){
				$('#Remove_Modal').modal('show');
				$subID=$(this).closest('tr').find('td.sorting_1>span').text();
		});

	});

		$inc=0;
		$sname_list=[];
		$sub_list=[];
		$refresh=false;
		$limit="";
	   $('#add_data_Modal_activate').on('shown.bs.modal', function(){
			
			if($inc==0)
			{
				$disb=$('strong#disbn').text();	
				$.ajax({
					url:'php_codes/activate_subs.php',
					method:'POST',
					data:{disb:$disb},
					success:function(data)
					{	
						$('strong#tot').html(data.numrows);
						$limit=data.numrows;
						$('strong#ser_name').html(data.snames[$inc]);
						$('strong#sub_ID').html(data.subsID_list[$inc]);
						$sname_list=data.snames;
						$sub_list=data.subsID_list;
					}
				});
			}
			else
			{
				$('strong#ser_name').html($sname_list[$inc]);
				$('strong#sub_ID').html(subsID_list[$inc]);
			}

			$('#subscribe_new_form_Pre_activate').on('submit',function(event){
				event.preventDefault();

					$SED=$('#SED_Pre_activate').val();
					$SSD=$('#SSD_Pre_activate').val();
					$sub=$sub_list[$inc];
					$sn=$('strong#ser_name').text();
					// alert($SED+$SSD+$sub+$sn);

					$.ajax({
						url:'php_codes/activate_subs.php',
						method:'POST',
						data:{SED:$SED,SSD:$SSD,SUB:$sub,sn:$sn},
						success:function(data){
							if(data.status='success')
							{
								$inc++;
								if($inc==$limit)
								{
									$('#hide').addClass('collapse');
									$('#retry_Pre_activate_finish').removeClass('collapse');
									$('#save_btn_Pre_activate').addClass('collapse');	
								}
								else
								{
									$refresh=true;
									$('#hide').addClass('collapse');
									$('#retry_Pre_activate').removeClass('collapse');
									$('#save_btn_Pre_activate').addClass('collapse');	
								}
								
								$('#msg_scs_Pre_activate').removeClass('collapse');
								$('#subscribe_new_form_Pre_activate')[0].reset();
							}
						}
					});		
			});
			$('#btn_yes_Pre_activate').click(function(){
				$('#msg_scs_Pre_activate').addClass('collapse');
				$('#retry_Pre_activate').addClass('collapse');
				$('#add_data_Modal_activate').modal('hide');
			
				
			});

			$('#btn_yes_Pre_activate_finish_btn').click(function(){
				$('#add_data_Modal_activate').modal('hide');		
				$('#Activate_btn').addClass('collapse');
				location.reload();
				
			});

			 $('#add_data_Modal_activate').on('hidden.bs.modal', function(){
			 	if($refresh && $('#retry_Pre_activate').hasClass('collapse'))
			 	{
			 		 $('#save_btn_Pre_activate').removeClass('collapse');
			 		 $('#hide').removeClass('collapse');
			 		 $('#add_data_Modal_activate').modal('show');

			 		$refresh=false;
			 	}
			 });

 		
 		});
	

	$('#receive_del_form').on('submit',function(event){
		event.preventDefault();

		$depts=[];
		$orgs=[];
		$progs=[];

		$('.dept_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$depts.push($(this).val());
				}
			}
		});
		$org_counter=0;
		$('.org_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$orgs.push($(this).val());
				}
			}
			$org_counter++;
		});

		$prog_counter=0;
		$('.prog_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$progs.push($(this).val());
				}
			}
			$prog_counter++;
		});


		$sn=$('#sn_rec').val();
		$DOI=$('#DOI_rec').val();
		$VN=$('#VN_rec').val();
		$IN=$('#IN_rec').val();
		// $DR=$('#DR_rec').val();

		if($DOI=="" && $VN==0 && $IN==0)
		{
			alert('Missing value on Date Of Issue/Volume Number/Issue Number');
		}
		else if($depts.length==0)
		{
			alert('Please Choose A Department');
		}
		else if($org_counter>1 && $orgs.length==0)
		{
			alert('Please Select Atleast One Organization');
		}
		else if($prog_counter>1 && $progs.length==0)
		{
			alert('Please Select Atleast One Program');
		}	
		else
		{

	 		$.ajax({
	 			url:"php_codes/insert_serial_pack.php",
	 			method:"POST",
	 			data:{sn:$sn,DOI:$DOI,VN:$VN,IN:$IN,depts:$depts,orgs:$orgs,progs:$progs},
	 			success:function(data)
	 			{
					$("#receive_del_form")[0].reset();
					if(data.status=='success')
					{
						if(!$('#msg_scs_enter').hasClass('collapse'))
						{
							$('#msg_scs_enter').addClass('collapse');
						}
						else if(!$('#msg_fail_enter').hasClass('collapse'))
						{
							$('#msg_fail_enter').addClass('collapse');
						}
						else if(!$('#msg_remove').hasClass('collapse'))
						{
							$('#msg_remove').addClass('collapse');
						}

						$('#msg_deliv_enter').removeClass('collapse');
						$('#receive_deliv_modal').modal('hide');
						
					}
					else
					{
						if(!$('#msg_scs_enter').hasClass('collapse'))
						{
							$('#msg_scs_enter').addClass('collapse');
						}
						else if(!$('#msg_deliv_enter').hasClass('collapse'))
						{
							$('#msg_deliv_enter').addClass('collapse');
						}
						else if(!$('#msg_remove').hasClass('collapse'))
						{
							$('#msg_remove').addClass('collapse');
						}

						$('#msg_fail_enter').removeClass('collapse');
						
					}
	 			}
	 		});
 		}
	 	
	});

	if($('span#rid').text()!="")
	{
		$('#Activate_btn').addClass('collapse');

	}


	$('#cog_action').click(function(){

 		$x=0;
 		$('button.tabledit-edit-button').each(function(){
 			
 			if($(this).hasClass('active'))
 			{
 				$x++;
 			}

 		}); 		

 		if($('thead>tr>th:nth-child(9)').hasClass('collapse'))
 		{
 			$('thead>tr>th:nth-child(9)').removeClass('collapse');
			$('tbody>tr>td:nth-child(9)').removeClass('collapse');
			
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
 			

 			$('thead>tr>th:nth-child(9)').addClass('collapse');
			$('tbody>tr>td:nth-child(9)').addClass('collapse');
 		}
 	});

 	$('#table_subs_wrapper').removeClass('form-inline');


 	$('#remove_data').on('submit',function(event){
 		event.preventDefault();

 		$reason=$('#reason_data').val();
 		
 		$.ajax({
 			url:'php_codes/modify_subs.php',
 			method:'POST',
 			data:{reason:$reason,action:'delete',subID:$subID},
 			success:function(data)
 			{
 				if(data.action=='delete')
				{
					$('#Remove_Modal').modal('hide');
					$('#reason_data').val('');

					if(!$('#msg_scs_enter').hasClass('collapse'))
					{
						$('#msg_scs_enter').addClass('collapse');
					}
					else if(!$('#msg_deliv_enter').hasClass('collapse'))
					{
						$('#msg_deliv_enter').addClass('collapse');
					}
					else if(!$('#msg_fail_enter').hasClass('collapse'))
					{
						$('#msg_fail_enter').addClass('collapse');
					}
					$('#msg_remove').removeClass('collapse');	
					$table.ajax.reload(null,false);		

				}

 			}
 		});

 	});


});