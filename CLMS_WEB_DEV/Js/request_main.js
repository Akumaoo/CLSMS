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
		$depts=[];
		
		$('input[type="checkbox"]:checked').each(function(){
			if($(this).val()!='SA')
			{
				$depts.push($(this).val());
			}
		});

		if($depts.length==0)
		{
			alert('Please Select Atleast One Department');
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
				data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost,depts:$depts},
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

						$("#msg_fail").removeClass('collapse');
						$('#add_data_Modal_next').scrollTop($('#msg_fail').offset().top);
					}

				}
			});
		}
	});

	 $('#subscribe_new_form_POST').on('submit',function(event){
		event.preventDefault();
		$depts=[];
		
		$('input[type="checkbox"]:checked').each(function(){
			if($(this).val()!='SA')
			{
				$depts.push($(this).val());
			}
		});

		if($depts.length==0)
		{
			alert('Please Select Atleast One Department');
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
				data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost,SED:$SED,depts:$depts,SSD:$SSD},
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

						$("#msg_fail_POST").removeClass('collapse');
						$('#add_data_Modal_next_POST').scrollTop($('#msg_fail_POST').offset().top);
					}

				}
			});
		}

	});

	$('#btn_yes').click(function(){
		$("#msg_scs").addClass('collapse');
		$("#subscribe_new_form_Pre")[0].reset();
		$('#save_btn').removeClass('collapse');
 		$('#retry').addClass('collapse');
	});
	$('#btn_no').click(function(){
		$("#subscribe_new_form_Pre")[0].reset();
		$("#first_step")[0].reset();
		$('#add_data_Modal_next').modal('hide');
		$('#prev-data').addClass('collapse');

		$total_insert_PRE=0;
		$prev_insert_PRE="";
		location.reload();
	});

	$('#btn_yes_POST').click(function(){
		$("#msg_scs_POST").addClass('collapse');
		$("#subscribe_new_form_POST")[0].reset();
		$('#save_btn_POST').removeClass('collapse');
 		$('#retry_POST').addClass('collapse');

 		
	});
	$('#btn_no_POST').click(function(){
		$("#subscribe_new_form_POST")[0].reset();
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
});