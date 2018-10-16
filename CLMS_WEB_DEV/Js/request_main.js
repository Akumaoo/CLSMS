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
	$type_POST="";

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
 					$type_POST=data.disbtype;
 					if($type_POST=="PRE-PAID")
 					{
	 					$('strong#disb_tag').html(data.disbname);
	 					$('strong#disb_type').html(data.disbtype);
	 				}
	 				else
	 				{
	 					$('strong#disb_tag_POST').html(data.disbname);
	 					$('strong#disb_type_POST').html(data.disbtype);	
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
		 if($show_SS && $type_POST=='PRE-PAID')
			{
				
				$('#add_data_Modal_next').modal('show');
				$type_POST="";
 				$show_SS=false;
 			}
 			else if($show_SS && $type_POST=='POST-PAID')
 			{
 				$('#add_data_Modal_next_POST').modal('show');				
				$type_POST="";
 				$show_SS=false;
 			}
 		
 		});

	   $('#subscribe_new_form_Pre').on('submit',function(event){
		event.preventDefault();

		$named=$('strong#disb_tag').text();
		$dtype=$('strong#disb_type').text();
		$sname=$('#SNf').val();
		$freq=$('#Freq').val();
		$cost=$('#Cost').val();

		$.ajax({
			url:"php_codes/Insert_New_Subscription.php",
			method:"POST",
			data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost},
			success:function(data)
			{
				
				if(data.status=='success')
				{

					$("#msg_scs").removeClass('collapse');
					$('#save_btn').addClass('collapse');
					$('#retry').removeClass('collapse');

				}
				else
				{
					$("#msg_fail").removeClass('collapse');
				}

			}
		});

	});

	 $('#add_data_Modal_next_POST').on('submit',function(event){
		event.preventDefault();

		if($('#RT option:selected').val()=='stat')
		{
			alert('Please Select Region Type');
		}
		else
		{
			$named=$('strong#disb_tag_POST').text();
			$dtype=$('strong#disb_type_POST').text();
			$sname=$('#SNf_POST').val();
			$freq=$('#Freq_POST').val();
			$cost=$('#Cost_POST').val();
			$SED=$('#SED_POST').val();
			$RT=$('#RT option:selected').val();

			$.ajax({
				url:"php_codes/Insert_New_Subscription.php",
				method:"POST",
				data:{dname:$named,type:$dtype,sname:$sname,freq:$freq,cost:$cost,SED:$SED,RT:$RT},
				success:function(data)
				{
					
					if(data.status=='success')
					{

						$("#msg_scs_POST").removeClass('collapse');
						$('#save_btn_POST').addClass('collapse');
						$('#retry_POST').removeClass('collapse');

					}
					else
					{
						$("#msg_fail_POST").removeClass('collapse');
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
	});


});