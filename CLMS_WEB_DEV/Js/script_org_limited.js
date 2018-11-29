$(function(){
	$('.org_cb').on('change',function(){
		$org=$(this).val();
		$sn=$('#Serial_Name').html();
		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts_limited.php",
				method:"POST",
				data:{type:'check_org',org:$org,sn:$sn},
				success:function(data){
					if(data.progs!="")
					{
						$('.select_prog').removeClass('collapse');
						$('.prog_list').append(data.progs);
					}
				}
			});
		}
		else
		{
			$('.tag_'+$org).remove();
				
			$inc=0;
			$('.prog_cb').each(function(){				
					$inc++;	
			});

			if( $inc==0)
			{
				$('.select_prog').addClass('collapse');
			}
			
		}
	});
});