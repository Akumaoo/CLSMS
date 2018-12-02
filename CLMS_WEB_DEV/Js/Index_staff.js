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
			$('input[type="checkbox"]').each(function(){
				$(this).prop('checked',true);
			});

			$('textarea').each(function(){
				$(this).val('Received');
				$(this).prop('disabled',true);
			});

		}

	});

	$('input[type="checkbox"]').on("change",function(){
		if($(this).is(':checked'))
		{
			$(this).closest('tr').find('.text_area').val('Received');
			$(this).closest('tr').find('.text_area').prop("disabled",true);
		}
		else
		{
			$(this).closest('tr').find('.text_area').val('');
			$(this).closest('tr').find('.text_area').prop("disabled",false);
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
		$rs_prog_list=[];
		$cn_list=[];
		$rem_list=[];

		$iden=$('#iden').text();
		if($iden!="")
		{
			$('input[name="rsprog_id"]').each(function(){
				$rs_prog_list.push($(this).val());
			});
		}

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
 			data:{type:'receive',rs_list:$rs_list,cn_list:$cn_list,rem_list:$rem_list,rs_prog_list:$rs_prog_list},
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
});