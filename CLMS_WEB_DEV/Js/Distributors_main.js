$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_disb")){
			$('#table_disb').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_distrib.php"
			});
		}

	$('#table_disb').on('draw.dt', function() {
		$('#table_disb').Tabledit({
			url:"php_codes/modify_distributors.php",
			columns:{
			identifier:[0,"DistributorID"],
			editable:[[1,"DistributorName"],[2,"NameOfIncharge"],[3,"ContactNumber"],[4,"Email"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.DistributorID).remove();			
				}
			},onDraw: function() {
				$('tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="number" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove()
	 		 }
		
		});

		if($('tbody>tr>td:nth-child(1)').hasClass('dataTables_empty'))
		{
			$('.tabledit-toolbar-column').remove();
			$('tbody>tr>td:nth-child(2)').remove();
		}
	});

	$('#Add_Distributor').on('submit',function(event){
		event.preventDefault();


	 	if($("#Dname").val()=="")
	 	{
	 		alert("Distributor Name Is Required");
	 	}
	 	else if($("#NOI").val()=="")
	 	{
	 		alert("Name Of Incharge Is Required");
	 	}
	 	else if($("#CN").val()=="")
	 	{
	 		alert('Contact Number Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_Distributor.php",
	 			method:"POST",
	 			data:$("#Add_Distributor").serialize(),
	 			success:function(data)
	 			{
 					$("#Add_Distributor")[0].reset();
 					$("#add_Distributor_data_Modal").modal('hide');
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
	 				$("#Add_Distributor")[0].reset();
 					$("#add_Distributor_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	}
	});

});