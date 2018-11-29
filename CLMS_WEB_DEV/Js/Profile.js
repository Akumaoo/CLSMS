$(function(){

	$('#Update_User').on('submit',function(event){
		event.preventDefault();

		var form = $('#Update_User')[0];
		var data = new FormData(form);
		data.append('action','update');

		$.ajax({
			url:"php_codes/update_settings.php",
			method:"POST",
	 			enctype: 'multipart/form-data',
	 			processData:false,
	 			contentType: false,
	 			data:data,
			success:function(data){

				if(data.status=='success')
				{
					if(!$('#msg_fail_enter').hasClass('collapse'))
					{
						$('#msg_fail_enter').addClass('collapse');
					}

					$('#msg_scs').removeClass('collapse');

					$('#FN').val(data.FN);
					$('#LN').val(data.LN);
					$('#mail').val(data.Email);
					$('#username').val(data.UserName);

				}
				else
				{
					if(!$('#msg_scs').hasClass('collapse'))
					{
						$('#msg_scs').addClass('collapse');
					}

					$('#msg_fail_enter').removeClass('collapse');
				}
			}
		});
		// $values="";
		// for(var value of data.values())
		// {
		// 	$values+=value;
		// }
		// alert($values);
	});

	$('#Reset_pass').click(function(){
			$('#reset_pass_modal').modal('show');
		});

	$('#reset_pass_1step').on('submit',function(event){
		event.preventDefault();

		$cp=$('#curr_pass').val();
		$uID=$('#uID').val();
		$.ajax({
			url:"php_codes/reset_pass.php",
			method:"POST",
			data:{cp:$cp,action:'confirm',uID:$uID},
			success:function(data){

				if(data.status=='success')
				{
					if(!$('#msg_fail_confirm_rp').hasClass('collapse'))
					{
						$('#msg_fail_confirm_rp').addClass('collapse');
					}
					else if(!$('#msg_fail_rp').hasClass('collapse'))
					{
						$('#msg_fail_rp').addClass('collapse');
					}

					$('#form-content').html(data.new_data);
				}
				else
				{
					if(!$('#msg_fail_confirm_rp').hasClass('collapse'))
					{
						$('#msg_fail_confirm_rp').addClass('collapse');
					}

					$('#curr_pass').val('');
					$('#msg_fail_rp').removeClass('collapse');
				}
			}

		});
	});

	$('#reset_pass_modal').on('hide.bs.modal',function(){
		if(!$('#msg_fail_rp').hasClass('collapse'))
		{
			$('#msg_fail_rp').addClass('collapse')
		}
		else if(!$('#msg_fail_confirm_rp').hasClass('collapse'))
		{
			$('#msg_fail_confirm_rp').addClass('collapse')
		}
		else if(!$('#msg_scs_rp').hasClass('collapse'))
		{
			$('#msg_scs_rp').addClass('collapse');
		}

		$('#curr_pass').val('');
		$('#New_pass').val('');
		$('#confirm_pass').val('');
	});

});