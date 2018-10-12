$(function(){

	if( !$.fn.DataTable.isDataTable("#table_deli")){
		$('#table_deli').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_deliveries.php"
		});
	}
	$('#table_deli').on('draw.dt', function() {
		$('#table_deli').Tabledit({
			url:"php_codes/modify_delivery.php",
			columns:{
			identifier:[0,"PackageID"],
			editable:[[3,"ReceiveDate"],[4,"ExpectedReceiveDate"]]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.PackageID).remove();			
				}
			},onDraw: function() 
			{
				$('tbody tr td:nth-child(4)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove();
				$('tbody tr td:nth-child(5)>input').each(function(){
					$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
				}).remove();
				$('tbody tr td:nth-child(3)').addClass('PName_click');

				$(".PName_click").click(function(){
					var Package_Name=$(this).text();
					$.ajax({
					type:'POST',
					url:'php_codes/ViewPackage.php',
					data:{P_Name:Package_Name},
					success:function(data){
						$('.main-chart').html(data)
					}
					});
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

		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var output_date_today = d.getFullYear() + '/' +
		    (month<10 ? '0' : '') + month + '/' +
		    (day<10 ? '0' : '') + day;


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

	

});