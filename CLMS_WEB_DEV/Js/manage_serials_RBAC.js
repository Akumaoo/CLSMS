$(function(){

	if(!$.fn.DataTable.isDataTable("#table_MS")){
	$('#table_MS').DataTable({			
	"processing":true,
	"serverSide":true,
	"ordering":true,
	"searching":true,
	"ajax":"SSP/serverside_manage_serials.php"
		});
	}


$('#table_MS').on('draw.dt', function() {
		$('#table_MS').Tabledit({
			url:"php_codes/modify_serials.php",
			columns:{
			identifier:[0,"SerialID"],
			editable:[[1,"SerialName"],[2,"TypeName"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.SerialID).remove();		

				}
				if(data.status=='success')
				{
					$("#msg_scs").removeClass('collapse');
				}
				else
				{
					$("#msg_fail").removeClass('collapse');
				}
			},onDraw: function() {
						$.ajax({
						url:'php_codes/get_types.php',
						success:function(data){
						$('tbody tr td:nth-child(3)>input').each(function(){
							$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option style="display: none" value="stat">--Status--</option>'+data).attr({ name: this.name, value: this.value }).insertBefore(this)		
						}).remove()
						}
						});
	 		 }
		
		});
		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
	});

	$('#create_new_package').on('submit',function(event){
		event.preventDefault();

	 	if($("#Pname").val()=="")
	 	{
	 		alert("Package Name Is Required");
	 	}
	 	else if($("#ERD").val()=="")
	 	{
	 		alert("Expected Receive Date Is Required");
	 	}
	 	else if(new Date($('#ERD').val())<=new Date(output_date_today))
	 	{
	 		alert("Expected Receive Date Is Past The Date Today");
	 	}
	 	else if($("#Dname").val()=="")
	 	{
	 		alert('Distributor Name Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_Package.php",
	 			method:"POST",
	 			data:$("#create_new_package").serialize(),
	 			success:function(data)
	 			{
 					$("#create_new_package")[0].reset();
 					$("#add_package_data_Modal").modal('hide');
 					if(data.status=='success')
 					{
 						$("#msg_scs").removeClass('collapse');
 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');
 					}
	 			}
	 		});
	 	}
	});

	$(".dept_click").click(function(){
		var serial_ID=$(this).text();
		$.ajax({
		type:'POST',
		url:'php_codes/View_dept_serial.php',
		data:{S_ID:serial_ID},
		success:function(data){
			$('.main-chart').html(data)
		}
		});
	});


});