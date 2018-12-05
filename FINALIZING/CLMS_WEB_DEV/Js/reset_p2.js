$(function(){

$('#reset_pass_2step').on('submit',function(event){
		event.preventDefault();

		$np=$('#New_pass').val();
		$confirm_np=$('#confirm_pass').val();
		$uID=$('#uID').val();

		if($np!=$confirm_np)
		{
			if(!$('#msg_fail_rp').hasClass('collapse'))
			{
				$('#msg_fail_rp').addClass('collapse');
			}
			else if(!$('#msg_scs_rp').hasClass('collapse'))
			{
				$('#msg_scs_rp').addClass('collapse');
			}
			

			$('#New_pass').val('');
			$('#confirm_pass').val('');
			$('#msg_fail_confirm_rp').removeClass('collapse');
		}
		else
		{
			$.ajax({
			url:"php_codes/reset_pass.php",
			method:"POST",
			data:{np:$np,action:'reset',uID:$uID},
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

					$('#New_pass').val('');
					$('#confirm_pass').val('');
					$('#msg_scs_rp').removeClass('collapse');


				}
			}

		});

		}

});

});