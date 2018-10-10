<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>
			
<div class=" custom-panelbox">			
	<div class="">
		<div class="">
			<h4 class="fa fa-truck tag_style "> Manage Deliveries:</h4>
			<h4 class="dividerr"></h4>
		</div>
		
		<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Delivery!</strong> , Please Reload The Page To Update The Table.
		</div>

		<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
		</div>

	<div class="custom_table" >
		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_deli">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Package ID</th>
					<th class="radio-label-center">Distributor Name</th>
					<th class="radio-label-center">Package Name</th>
					<th class="radio-label-center">Receive Date</th>
					<th class="radio-label-center">Expected Receive Date</th>
					<th class="radio-label-center">Package Phase</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>

		<div class="">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_package_data_Modal" class="custom-btn">Create Package!</button>
			</div>
		</div>
	</div>

</div>
</div>
	


<?php 
		include 'Modals/Create_Package_Modal.php';
?>
<script>
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
</script>