$(function(){
	$dept=$('#dept_branch').text();

	if( ! $.fn.DataTable.isDataTable("#table_RS_STAFF")){
	$('#table_RS_STAFF').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":
		{
		"url":"SSP/serverside_list_received_ser.php",
		"method":"POST",
		"data":{dept:$dept}
		}
		});
	}

	$('.rs_content').click(function(){
		$.ajax({
			url:'php_codes/Receive_Seen.php',
			method:'POST',
			data:{dept:$dept,type:'seen'},
			success:function(data)
			{
				if(data=='success')
				{
					$('#Receive_Modal').modal('show');
				}

			}
		})
	});
	$('#SA').change(function() {
		if($(this).is(':checked'))
		{
			$('input[name="rs_id"]').each(function(){
				$(this).prop('checked',true);
			});

			$('textarea').each(function(){
				$(this).val('Received');
				$(this).prop('disabled',true);
			});

			$('.cn').each(function(){
				$(this).prop('required',true);
			});
			

		}
	});

	$('#SA_progs').change(function() {
		if($(this).is(':checked'))
		{
			$('input[name="progs"]').each(function(){
				$(this).prop('checked',true);
			});
		}
	});

	$('input[type="checkbox"]').on("change",function(){
		if($(this).is(':checked'))
		{
			$(this).closest('tr').find('.text_area').val('Received');
			$(this).closest('tr').find('.text_area').prop("disabled",true);
			$(this).closest('tr').find('.cn').prop('required',true);
		}
		else
		{
			$(this).closest('tr').find('.text_area').val('');
			$(this).closest('tr').find('.text_area').prop("disabled",false);
			$(this).closest('tr').find('.cn').prop('required',false);
		}
	});

	$reload=false;
	$('#Receive_Modal').on('hidden.bs.modal', function(){
		if($reload)
		{
			location.reload(true);
			$('input[name="cont_no"]').each(function(){
				$(this).val('');
			});
			$reload=false;
		}
	});

	$('#SEND_RECEIVE').on('submit',function(event){
		event.preventDefault();
		$rs_list=[];
		$cn_list=[];
		$rem_list=[];

		$('input[name="rs_id"]').each(function(){
			$rs_list.push($(this).val());
		});
		$('input[name="cont_no"]').each(function(){
			$cn_list.push($(this).val());
		});
		$('textarea[name="sc"]').each(function(){
			$rem_list.push($(this).val());
		});
		
		// alert($rs_prog_list);
		
 		$.ajax({
 			url:'php_codes/Receive_Seen.php',
 			method:"POST",
 			data:{type:'receive',rs_list:$rs_list,cn_list:$cn_list,rem_list:$rem_list},
 			success:function(data)
 			{	
 				if(data=='success')
 				{
						$('#Receive_Modal').modal('hide');
						$reload=true;

					}

 			}
 		});
	 	
	});

	$('#form_report').attr({
		action: 'fpdf/Reports/Staff_RT.php'
	});

	$date_view=false;
	$('#gen_rep_rt').click(function(){
		if(!$date_view)
		{
			$('#form_report').prepend('<div class="form-group form-group-center"><label for="SD" class="control-label col-lg-5">Start Date:</label><div class="col-lg-5"><input type="date" name="SD" id="SD" style="width: 135px;"></div></div><div class="form-group form-group-center"><label for="ED" class="control-label col-lg-5">End Date:</label><div class="col-lg-5"><input type="date" name="ED" id="ED" style="width: 135px;"></div></div>');
		}
		$('#Print_Modal').modal('show');
		$date_view=true;
	});

	$.ajax({
		url:"php_codes/select_dept_array.php",
		method:"POST",
		data:{type:'check_dept',dept:$dept},
		success:function(data){
			if(data.orgs!='')
			{
				$('.select_org_post').removeClass('collapse');
				$('.org_list_post').append(data.orgs);

				$('.org_list_post').append('<div id="script_org_post"></div>');

				var s=document.createElement("script");
				s.type='text/javascript';
				s.src='Js/script_org_post_array.js';
				$('#script_org_post').append(s);
			}
		}
	});



});