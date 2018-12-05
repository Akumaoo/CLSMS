$(function(){
	$('.org_cb').on('change',function(){
		$org=$(this).val();
		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts.php",
				method:"POST",
				data:{type:'check_org',org:$org},
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