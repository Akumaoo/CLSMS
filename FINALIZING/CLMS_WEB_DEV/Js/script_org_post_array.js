$(function(){
	$('.org_cb').on('change',function(){
		$org=$(this).val();
		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_dept_array.php",
				method:"POST",
				data:{type:'check_org',org:$org},
				success:function(data){
					if(data.progs!="")
					{
					
						$('.select_prog_post').removeClass('collapse');
						$('.prog_list_post').append(data.progs);
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
				$('.select_prog_post').addClass('collapse');
			}
		}
	});
});