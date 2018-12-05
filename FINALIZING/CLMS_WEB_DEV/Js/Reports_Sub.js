$(function(){

 	$('#overallreport').addClass('active');
 	$table="";
 	$sort_filter="";

 	$('#s_f').change(function(){
 		if($(this).val()=='Sort')
 		{
 			clearList();
 			hideSM();

 			$('#filter').addClass('collapse');
 			$('#col_list').attr("required",false);
 			$('#col_list').prop('selectedIndex',0);

 			$('#sort_tab').removeClass('collapse');
 			$('#sort_by').attr('required',true);
 		}
 		else if($(this).val()=='Filter')
 		{

 			$('#sort_tab').addClass('collapse');
 			$('#sort_by').attr("required",false);
 			$('#sort_by').prop('selectedIndex',0);


 			$('#filter').removeClass('collapse')
 			$('#col_list').attr('required',true);
 		}
 		else
 		{
 			clearList();
 			hideSM();
 			$('#sort_tab').addClass('collapse');
 			$('#sort_by').attr("required",false);
 			$('#sort_by').prop('selectedIndex',0);

 			$('#filter').addClass('collapse');
 			$('#col_list').attr("required",false);
 			$('#col_list').prop('selectedIndex',0);
 		}

 		$sort_filter=$(this).val();
 		$('#dept_disb').prop('selectedIndex',0);
 		$('#t_r').prop('selectedIndex',0);
 		$('#bp').prop('selectedIndex',0);

 	});

 	function clearList()
 	{
 		$('#col_list').html('');
 		$('#org_list').html('');
 		$('#prog_list').html('');

 		$('#col_list').attr("required",false);
 		$('#org_list').attr("required",false);
 		$('#prog_list').attr("required",false);
 	}

 	 $('#dept_disb').change(function(){
 	 	if($sort_filter=="Filter")
 	 	{
	 		if($(this).val()=='Department')
	 		{
	 			// FILL COLLEGE SELECT
			 	$.ajax({
			 		url:"php_codes/get_depts.php",
			 		method:"POST",
			 		success:function(data){

			 			$list='<option value=""></option>';
			 			if(data.length>0)
			 			{
				 			for($x=0;$x<data.length;$x++)
				 			{
				 				$list+='<option value="'+data[$x]+'">'+data[$x]+'</option>';
				 			}

				 			$('#col_list').html($list);
			 			}
			 		}
			 	});

	 		}
	 		else
	 		{
	 			// FILL COLLEGE SELECT
			 	$.ajax({
			 		url:"php_codes/get_disb.php",
			 		method:"POST",
			 		success:function(data){

			 			$list='<option value=""></option>';
			 			if(data.length>0)
			 			{
				 			for($x=0;$x<data.length;$x++)
				 			{
				 				$list+='<option value="'+data[$x]+'">'+data[$x]+'</option>';
				 			}

				 			$('#col_list').html($list);
			 			}
			 		}
			 	});

		 		if(!$('#S_M').hasClass('collapse'))
		 		{
		 			hideSM();
		 		}
	 		}
 		}

 		$table=$(this).val();
 	
 	});

 	function hideSM()
 	{
 		$('#S_M').addClass('collapse');
 		$('#org_list').html('');
 		$('#org_list').attr("required",false);

 		$('#prog_list').html('');
 		$('#prog_list').attr("required",false);

 	}

 	$('#col_list').change(function(){

 		if($table=="Department" && $sort_filter=="Filter")
 		{
	 		$dept=$(this).val();

	 		$.ajax({
	 			url:"php_codes/select_prog.php",
	 			method:"POST",
	 			data:{dept:$dept,type:"check_dept"},
	 			success:function(data){

	 				if(data.data_type=='Multiple')
	 				{
	 					$('#S_M').removeClass('collapse');

	 					$('#org_list').attr("required",true);
	 					$('#prog_list').attr("required",true);

	 					$('#org_list').html(data.orgs);
	 				}
	 				else
	 				{

	 					hideSM();
	 				}

	 			}
	 		});
 		}
 		else
 		{
 			hideSM();
 		}

 	});

 	$('#org_list').change(function(){
 		$org=$(this).val();

 		if($org!="")
 		{
	 		$.ajax({
	 			url:"php_codes/select_prog.php",
	 			method:"POST",
	 			data:{org:$org,type:"check_org"},
	 			success:function(data){

	 				
	 					$('#prog_list').html(data.progs);
	 				

	 			}
	 		});
 		}
		else
		{

			$('#prog_list').html('');
		}
 	});

 	$('#form_report').attr({
		action: 'fpdf/Reports/Admin_reports_gen.php'
	});
});
