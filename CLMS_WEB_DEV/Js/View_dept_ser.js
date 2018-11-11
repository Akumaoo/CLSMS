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
		$sname=$('#sname').html();

		$('input[type="checkbox"]:checked').each(function(){
			if($(this).val()!='SA')
			{
				$depts.push($(this).val());
			}
		});

		if($depts.length==0)
		{
			alert('Please Select Atleast One Department');
		}
		else
		{

	 		$.ajax({
	 			url:"php_codes/re_categorize_serial.php",
	 			method:"POST",
	 			data:{sname:$sname,depts:$depts},
	 			success:function(data)
	 			{
					$("#Re_Categorize_form")[0].reset();
					if(data.status=='success')
					{
						$('#RCS_Modal').modal('hide');
						$table.ajax.reload(null,false);	
						
					}
	 			}
	 		});
 		}
	 	
	});

});