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

				$('.tabledit-edit-button').remove();
	 		 }
		
		});

		$('tbody tr td:nth-child(2)').addClass('ser_click');

		$(".ser_click").click(function(){
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

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
	});

	$('#Add_Serial').on('submit',function(event){
		event.preventDefault();
		 var deptlist=[];
		 $.each($('input[name="dept"]:checked'),function(){
		 	deptlist.push($(this).val());
		 });

		 var sName=$('#serialname').val();
		 var type=$('#type option:selected').val();

	 	if($("#serialname").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if(deptlist.length==0)
	 	{
	 		alert("Please Choose Atleast One Department");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_serial.php",
	 			method:"POST",
	 			data:{sername:sName,depts:deptlist,stype:type},
	 			success:function(data)
	 			{
	 				$('#Add_Serial_Modal').modal('hide');
	 				
 					$("#Add_Serial")[0].reset();
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

	 $('#Add_Serial_Modal').on('hidden.bs.modal', function(){
		if(!$('#msg_fail').hasClass('collapse'))
		{
			$('#msg_fail').addClass('collapse');
		}
	 });

});