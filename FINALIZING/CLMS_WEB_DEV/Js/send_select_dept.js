$(function(){

	$script_org_inc_categ=false;
	$('.dept_cb').on('change',function(){

		$dept=$(this).val();
		$sn=$('#Serial_Name').html();
		// alert($dept);

		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts_limited.php",
				method:"POST",
				data:{type:'check_dept',dept:$dept,sn:$sn},
				success:function(data){
					if(data.orgs!='')
					{
						$('.select_org').removeClass('collapse');
						$('.org_list').append(data.orgs);

						if(!$script_org_inc_categ)
						{
							$('.org_list').append('<div id="script_org_limited"></div>');

							var s=document.createElement("script");
							s.type='text/javascript';
							s.src='Js/script_org_limited.js';
							$('#script_org_limited').append(s);
							$script_org_inc_categ=true;
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
				$('.select_org').addClass('collapse');
				$('.select_prog').addClass('collapse');

				$('.prog_list').html('');
				$('.org_list').html('');

				$('#script_org_limited').remove();
				$script_org_inc_categ=false;
			}
			
		}
	});
});