	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_MT")){
			$('#table_MT').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,

		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

	$('#table_MT').Tabledit({
		url:"php_codes/modify_Type.php",
		columns:{
		identifier:[0,"TypeID"],
		editable:[[1,"TypeName"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.TypeID).remove();			
			}
		}
	});

	$('#Add_Type').on('submit',function(event){
	event.preventDefault();

 	if($("#tn").val()=="")
 	{
 		alert("Type Name Is Required");
 	}
 	else{
 		$.ajax({
 			url:"php_codes/Insert_new_Type.php",
 			method:"POST",
 			data:$("#Add_Type").serialize(),
 			success:function(data)
 			{
					$("#Add_Type")[0].reset();
					$("#Add_Type_Modal").modal('hide');
					if(data.status=='success')
					{
						$("#msg_scs_type").removeClass('collapse');
					}
					else
					{
						$("#msg_fail").removeClass('collapse');
					}
 			}
 		});
 		}
	});

});