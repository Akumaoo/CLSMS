<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Serials:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Subscribed!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="row custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Serial ID</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type</th>
					<th class="radio-label-center">Departments</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		
	</div>

	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_package_data_Modal" class="btn custom-btn">Create Package!</button>
		</div>
	</div>
</div>

<script>
	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_MS")){
			$('#table_MS').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true
		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

	$('#table_MS').Tabledit({
		url:"php_codes/modify_delivery.php",
		columns:{
		identifier:[0,"PackageID"],
		editable:[[3,"ReceiveDate"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.PackageID).remove();			
			}
		},onDraw: function() {
			$('tbody tr td:nth-child(4)>input').each(function(){
				$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
			}).remove()
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

});
</script>