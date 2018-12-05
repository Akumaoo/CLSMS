$(function(){
	$table="";
 		if( ! $.fn.DataTable.isDataTable("#table_CS")){
 		$sname=$('#sname').html();
		$table=$('#table_CS').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":
			{
			"url":"SSP/serverside_categorize_serial.php",
			"method":"POST",
			"data":{sname:$sname}
			}
			});
		}


	$('#table_CS').on('draw.dt', function(){
		
		$('tbody tr td:nth-child(3)').attr({
			'data-toggle': 'tooltip',
			'title': 'asdasd'
		});
		
	});

 	$('#RCS').click(function(){
 		$('#RCS_Modal').modal('show');
 	});

 	$('.SA').change(function() {
	if($(this).is(':checked'))
	{
		$('input[type="checkbox"]').each(function(){
			$(this).prop('checked',true);
		});

	}
	});

	
	$('#Re_Categorize_form').on('submit',function(event){
		event.preventDefault();

		$depts=[];
		$orgs=[];
		$progs=[];
		$sname=$('#sname').html();

		$('.dept_list_post').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$depts.push($(this).val());
				}
			}
		});
		$org_counter=0;
		$('.org_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$orgs.push($(this).val());
				}
			}
			$org_counter++;
		});

		$prog_counter=0;
		$('.prog_cb').each(function(){
			if($(this).is(':checked'))
			{
				if($(this).val()!='SA')
				{
					$progs.push($(this).val());
				}
			}
			$prog_counter++;
		});

		if($depts.length==0)
		{
			alert('Please Choose A Department');
		}
		else if($org_counter>1 && $orgs.length==0)
		{
			alert('Please Select Atleast One Organization');
		}
		else if($prog_counter>1 && $progs.length==0)
		{
			alert('Please Select Atleast One Program');
		}	
		else
		{

	 		$.ajax({
	 			url:"php_codes/re_categorize_serial.php",
	 			method:"POST",
	 			data:{sname:$sname,depts:$depts,orgs:$orgs,progs:$progs},
	 			success:function(data)
	 			{
					if(data.status=='success')
					{
						resetform();

						$('#RCS_Modal').modal('hide');
						$table.ajax.reload(null,false);	
						
					}
	 			}
	 		});
 		}
	 	
	});
	function resetform(){
	 	$('input[type="checkbox"]').each(function(){
	 		$(this).prop('checked',false);
	 	});

	 	$('.org_list_post').html('');
	 	$('.prog_list_post').html('');
	 	$('#script_org_post').remove();
	 	$script_org_inc_post=false;
	 	
	 	$('.select_org_post').addClass('collapse');
	 	$('.select_prog_post').addClass('collapse');
	 }

	$script_org_inc_post=false;
	$('.dept_list_post').on('change',function(){

		$dept=$(this).val();

		if($(this).is(':checked'))
		{
			$.ajax({
				url:"php_codes/select_depts.php",
				method:"POST",
				data:{type:'check_dept',dept:$dept},
				success:function(data){
					if(data.orgs!='')
					{
						$('.select_org_post').removeClass('collapse');
						$('.org_list_post').append(data.orgs);

						if(!$script_org_inc_post)
						{
							$('.org_list_post').append('<div id="script_org_post"></div>');

							var s=document.createElement("script");
							s.type='text/javascript';
							s.src='Js/script_org_post.js';
							$('#script_org_post').append(s);
							$script_org_inc_post=true;
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
				$('.select_org_post').addClass('collapse');
				$('.select_prog_post').addClass('collapse');

				$('.prog_list_post').html('');
				$('.org_list_post').html('');

				$('#script_org_post').remove();
				$script_org_inc_post=false;
			}
			
		}
	});

	

});