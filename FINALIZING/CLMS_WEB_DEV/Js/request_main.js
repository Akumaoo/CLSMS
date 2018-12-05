	$(function(){

	if( !$.fn.DataTable.isDataTable("#table_req")){
		$('#table_req').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_request.php"
		});
	}
	$('#table_req').on('draw.dt', function() {
		
		$('tbody tr td:nth-child(2)').addClass('srd');
		$('tbody tr td:nth-child(1)').addClass('disb_click');

		$(".disb_click").click(function(){
			var disbn=$(this).text();
			var RID=$(this).closest('tr').find('.srd').text();
			$.ajax({
			type:'POST',
			url:'currentsubscribe.php',
			data:{dname:disbn,req:RID},
			success:function(data){
				$('.main-chart').html(data)
			}
			});
		});
	});



	$show_SS=false;
	$show_2S=false;
	$type_POST="";
	$total_insert_POST=0;
	$prev_insert_POST="";
	$total_insert_PRE=0;
	$prev_insert_PRE="";

	$('#first_step').on('submit',function(event){
		event.preventDefault();
 		$.ajax({
 			url:"Modals/validate_add_subs.php",
 			method:"POST",
 			data:$("#first_step").serialize(),
 			success:function(data)
 			{	
 				if(data.status!='fail')
 				{	$show_SS=true;
 					$type_POST=$('#type_act').val();
 					if($type_POST=="Manual-Activate")
 					{
	 					$('strong#disb_tag').html(data.disbname);
	 					$('strong#disb_type').html($type_POST);
	 				}
	 				else
	 				{
	 					$('strong#disb_tag_POST').html(data.disbname);
	 					$('strong#disb_type_POST').html($type_POST);	
	 				}
					$('#add_data_Modal').modal('hide');		
				}
				else
				{
					$("#error").removeClass('collapse');
					$("#first_step")[0].reset();
				}

 			}
	 	});
	});

	  $('#add_data_Modal').on('hidden.bs.modal', function(){
		 if($show_SS && $type_POST=='Manual-Activate')
			{
				
				$('#add_data_Modal_next').modal('show');
				$type_POST="";
 				$show_SS=false;
 			}
 			else if($show_SS && $type_POST=='Auto-Activate')
 			{
 				$('#add_data_Modal_next_POST').modal('show');				
				$type_POST="";
 				$show_SS=false;
 			}
 			
 			if(!$('#error').hasClass('collapse'))
 			{
 				$('#error').addClass('collapse');
 			}
 			$('#DN').val('');
 		});

	   $('#subs').click(function(){
	   	if($total_insert_POST!=0)
	   	{
	   		$('#add_data_Modal_next_POST').modal('show');
	   	}
	   	else if($total_insert_PRE!=0)
	   	{
	   		$('#add_data_Modal_next').modal('show');
	   	}
	   	else
	   	{
	   		// $('#add_data_Modal').modal('show');
	   		$('#add_data_Modal_FS').modal('show');
	   	}

	   	$('#btn_auto_act').click(function(){
	   		$('#type_act').val('Auto-Activate');
	   		$('#add_data_Modal_FS').modal('hide');
	   		$show_2S=true;

	   	});
   		$('#btn_manual_act').click(function(){
   			$('#type_act').val('Manual-Activate');
   			$('#add_data_Modal_FS').modal('hide');
   			$show_2S=true;
	   	});

   		$('#add_data_Modal_FS').on('hidden.bs.modal',function(){
   			if($show_2S)
   			{
   				$('#add_data_Modal').modal('show');
   				$show_2S=false;
   			}
   		});

	   });

	   $('.close').click(function(){
	   	$total_insert_POST=0;
	   	$prev_insert_POST="";
	   	$total_insert_PRE=0;
		$prev_insert_PRE="";
	   	location.reload();
	   	$('#prev-data-POST').addClass('collapse');
	   	$('#prev-data').addClass('collapse');
	   });
                          
	   $('#subscribe_new_form_Pre').on('submit',function(event){
		event.preventDefault();
		$progs=[];
		$dept=[];
		$org=[];
		
		$('.dept_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$dept.push($(this).val());
				}
			}
		});
		$org_counter=0;
		$('.org_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$org.push($(this).val());
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

		if($dept.length==0)
		{
			alert('Please Choose A Department');
		}
		else if($org_counter>1 && $org.length==0)
		{
			alert('Please Select Atleast One Organization');
		}
		else if($prog_counter>1 && $progs.length==0)
		{
			alert('Please Select Atleast One Program');
		}	
		else
		{	

			$named=$('strong#disb_tag').text();
			$dtype=$('strong#disb_type').text();
			$sname=$('#SNf').val();
			$freq=$('#Freq').val();
			$cost=$('#Cost').val();

			$.ajax({
				url:"php_codes/Insert_New_Subscription.php",
				method:"POST",
				data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost,dept:$dept,org:$org,progs:$progs},
				success:function(data)
				{
					
					if(data.status=='success')
					{
						if(!$('#msg_fail').hasClass('collapse'))
						{
							$('#msg_fail').addClass('collapse');
						}

						$total_insert_PRE++;
						$prev_insert_PRE=$sname;
						$('#prev-data').removeClass('collapse');
						$('strong#total_insert_PRE').html($total_insert_PRE);
						$('strong#prev_insert_PRE').html($prev_insert_PRE);


						$("#msg_scs").removeClass('collapse');
						$('#add_data_Modal_next').scrollTop($('#msg_scs').offset().top);
						$('#save_btn').addClass('collapse');
						$('#retry').removeClass('collapse');


					}
					else
					{
						if(!$('#msg_scs').hasClass('collapse'))
						{
							$('#msg_scs').addClass('collapse');
						}

						$('#fail_msg').html(data.status);
						$("#msg_fail").removeClass('collapse');
						$('#add_data_Modal_next').scrollTop($('#msg_fail').offset().top);
					}

				}
			});
		}
			
	});

	 $('#subscribe_new_form_POST').on('submit',function(event){
		event.preventDefault();
		$progs=[];
		$dept=[];
		$org=[];

		$('.dept_list_post').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$dept.push($(this).val());
				}
			}
		});
		$org_counter=0;
		$('.org_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$org.push($(this).val());
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

		
		if($dept.length==0)
		{
			alert('Please Choose A Department');
		}
		else if($org_counter>1 && $org.length==0)
		{
			alert('Please Select Atleast One Organization');
		}
		else if($prog_counter>1 && $progs.length==0)
		{
			alert('Please Select Atleast One Program');
		}	
		else
		{	

			$named=$('strong#disb_tag_POST').text();
			$dtype=$('strong#disb_type_POST').text();
			$sname=$('#SNf_POST').val();
			$freq=$('#Freq_POST').val();
			$cost=$('#Cost_POST').val();
			$SED=$('#SED_POST').val();
			$SSD=$('#SSD_POST').val();


			$.ajax({
				url:"php_codes/Insert_New_Subscription.php",
				method:"POST",
				data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost,SED:$SED,dept:$dept,org:$org,progs:$progs,SSD:$SSD},
				success:function(data)
				{
					
					if(data.status=='success')
					{
						if(!$('#msg_fail_POST').hasClass('collapse'))
						{
							$('#msg_fail_POST').addClass('collapse');
						}

			
						$total_insert_POST++;
						$prev_insert_POST=$sname;
						$('#prev-data-POST').removeClass('collapse');
 						$('strong#total_insert').html($total_insert_POST);
 						$('strong#prev_insert').html($prev_insert_POST);


						$("#msg_scs_POST").removeClass('collapse');
						$('#add_data_Modal_next_POST').scrollTop($('#msg_scs_POST').offset().top);
						$('#save_btn_POST').addClass('collapse');
						$('#retry_POST').removeClass('collapse');


					}
					else
					{	
						if(!$('#msg_scs_POST').hasClass('collapse'))
						{
							$('#msg_scs_POST').addClass('collapse');
						}

						$('#fail_msg_post').html(data.status);
						$("#msg_fail_POST").removeClass('collapse');
						$('#add_data_Modal_next_POST').scrollTop($('#msg_fail_POST').offset().top);
					}

				}
			});
		}
	});
	 function resetPreform(){
	 	$('#SNf').val('');
	 	$('#Freq').val('');
	 	$('#Cost').val('');
	 	$('input[type="checkbox"]').each(function(){
	 		$(this).prop('checked',false);
	 	});

	 	$('.org_list').html('');
	 	$('.prog_list').html('');
	 	$('#script_org').remove();
	 	$script_org_inc=false;

	 	$('.select_org').addClass('collapse');
	 	$('.select_prog').addClass('collapse');
	 }
	  function resetPOSTform(){
	 	$('#SNf_POST').val('');
	 	$('#Freq_POST').val('');
	 	$('#Cost_POST').val('');
	 	$('#SSD_POST').val('');
	 	$('#SED_POST').val('');
	 	$('input[type="checkbox"]').each(function(){
	 		$(this).prop('checked',false);
	 	});

	 	$('.org_list_post').html('');
	 	$('.prog_list_post').html('');
	 	$('#script_org_post').remove();
	 	$script_org_inc_post=false;

	 	$('.select_org_post').addClass('collapse');
	 	$('.select_prog_post').addClass('collapse');
	 }

	$('#btn_yes').click(function(){
		$("#msg_scs").addClass('collapse');
		resetPreform();
		$('#save_btn').removeClass('collapse');
 		$('#retry').addClass('collapse');
	});
	$('#btn_no').click(function(){
		$("#subscribe_new_form_Pre")[0].reset();
		resetPreform();
		$('#add_data_Modal_next').modal('hide');
		$('#prev-data').addClass('collapse');

		$total_insert_PRE=0;
		$prev_insert_PRE="";
		location.reload();
	});

	$('#btn_yes_POST').click(function(){
		$("#msg_scs_POST").addClass('collapse');
		resetPOSTform();
		$('#save_btn_POST').removeClass('collapse');
 		$('#retry_POST').addClass('collapse');

 		
	});
	$('#btn_no_POST').click(function(){
		resetPOSTform();
		$("#first_step")[0].reset();
		$('#add_data_Modal_next_POST').modal('hide');
		$('#prev-data-POST').addClass('collapse');
	
		$total_insert_POST=0;
		$prev_insert_POST="";
		location.reload();
	});

	$('#CS').addClass('active');

	$('.SA').change(function() {
		if($(this).is(':checked'))
		{
			$('input[type="checkbox"]').each(function(){
				$(this).prop('checked',true);
			});

		}
	});

	$script_org_inc=false;
	$('.dept_cb').on('change',function(){

		$dept=$(this).val();

		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts.php",
				method:"POST",
				data:{type:'check_dept',dept:$dept},
				success:function(data){
					if(data.orgs!='')
					{
						$('.select_org').removeClass('collapse');
						$('.org_list').append(data.orgs);

						if(!$script_org_inc)
						{
							$('.org_list').append('<div id="script_org"></div>');

							var s=document.createElement("script");
							s.type='text/javascript';
							s.src='Js/script_org.js?v=1';
							$('#script_org').append(s);
							$script_org_inc=true;
						}
						
					}
				}
			});
		
		}
		else
		{
			$('.tag_'+$dept).remove();
			//
				
			$inc=0;
			$('.org_cb').each(function(){				
					$inc++;	
			});

			if( $inc==0)
			{
				$('.select_org').addClass('collapse');
				$('.select_prog').addClass('collapse');
				
				$('.prog_list').html('');
				$('.org_list').html('');

				$('#script_org').remove();
				$script_org_inc=false;
			}
			
		}
	});

	$script_org_inc_post=false;
	$('.dept_list_post').on('change',function(){

		$dept=$(this).val();

		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts.php",
				method:"POST",
				data:{type:'check_dept',dept:$dept},
				success:function(data){
					if(data.orgs!='')
					{
						$('.select_org_post').removeClass('collapse');
						$('.org_list_post').append(data.orgs);

						if(!$script_org_inc_post)
						{
							$('.org_list_post').append('<div id="script_org_post"></div>');

							var s=document.createElement("script");
							s.type='text/javascript';
							s.src='Js/script_org_post.js';
							$('#script_org_post').append(s);
							$script_org_inc_post=true;
						}
						
					}
				}
			});
		
		}
		else
		{
			$('.tag_'+$dept).remove();
			
				
			$inc=0;
			$('.org_cb').each(function(){				
					$inc++;	
			});

			if( $inc==0)
			{
				$('.select_org_post').addClass('collapse');
				$('.select_prog_post').addClass('collapse');

				$('.prog_list_post').html('');
				$('.org_list_post').html('');

				$('#script_org_post').remove();
				$script_org_inc_post=false;
			}
			
		}
	});
	

	
	

});