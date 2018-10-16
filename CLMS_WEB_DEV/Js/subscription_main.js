$(function(){

	if( !$.fn.DataTable.isDataTable("#table_subs")){
		$rID=$('span#rid').text();
		$dept=$('strong#disbn').text();
		$('#table_subs').DataTable({			
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
	$('#table_subs').on('draw.dt', function() {
		$('#table_subs').Tabledit({
		url:"php_codes/modify_subs.php",
		columns:{
			identifier:[0,"SubscriptionID"],
			editable:[[2,"Orders"],[3,"Cost"],[5,"Status"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.SubscriptionID).remove();			
				}
				if(data.status=='success')
				{
					$("#msg_scs_enter").removeClass('collapse');
				}
				else
				{
					$("#msg_fail_enter").removeClass('collapse');
				}

			},onDraw: function() {
				$('tbody tr td:nth-child(3)>input,tbody tr td:nth-child(4)>input,tbody tr td:nth-child(5)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
				$('tbody tr td:nth-child(6)>input').each(function(){
					$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option value="OnGoing">OnGoing</option><option value="Finished">Finished</option><option value="Cancelled">Cancelled</option><option value="Refunded">Refunded</option></select>').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
	 		 }		
		
		});

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
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
				if($('#RT option:selected').val()=='stat')
				{
					alert('Please Choose Region Type');
				}
				else
				{
					$RT=$('#RT option:selected').val();
					$SED=$('#SED_Pre_activate').val();
					$sub=$sub_list[$inc];

					$.ajax({
						url:'php_codes/activate_subs.php',
						method:'POST',
						data:{RT:$RT,SED:$SED,SUB:$sub},
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
				}
			});
			$('#btn_yes_Pre_activate').click(function(){
				$('#msg_scs_Pre_activate').addClass('collapse');
				$('#retry_Pre_activate').addClass('collapse');
				$('#add_data_Modal_activate').modal('hide');
			
				
			});

			$('#btn_yes_Pre_activate_finish_btn').click(function(){
				$('#add_data_Modal_activate').modal('hide');		
				$('#Activate_btn').addClass('collapse');
				
			});

			 $('#add_data_Modal_activate').on('hidden.bs.modal', function(){
			 	if($refresh)
			 	{
			 		 $('#save_btn_Pre_activate').removeClass('collapse');
			 		 $('#hide').removeClass('collapse');
			 		 $('#add_data_Modal_activate').modal('show');

			 		$refresh=false;
			 	}
			 });

 		
 		});
	


});