	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_dept")){
			$('#table_dept').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,

		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

	$('#table_dept').Tabledit({
		url:"php_codes/modify_department.php",
		columns:{
		identifier:[0,"DepartmentID"],
		editable:[[1,"DepartmentName"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.DepartmentID).remove();			
			}
		}
	});

	$('#Add_Department').on('submit',function(event){
		event.preventDefault();

	 	
	 	if($("#id").val()=="")
	 	{
	 		alert("Department ID Is Required");
	 	}
	 	else if($("#Dname").val()=="")
	 	{
	 		alert("Department Name Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_Department.php",
	 			method:"POST",
	 			data:$("#Add_Department").serialize(),
	 			success:function(data)
	 			{
 					$("#Add_Department")[0].reset();
 					$("#add_Department_data_Modal").modal('hide');
 					if(data.status=='success')
 					{
 						$("#msg_scs").removeClass('collapse');
 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');

 					}
 					
	 			},
	 			error:function(){
	 				$("#Add_Department")[0].reset();
 					$("#add_Department_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	}
	});

});