<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Send Serials:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Send Serial!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="row custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_SS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">RS ID</th>
					<th class="radio-label-center">Department Name</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type</th>
					<th class="radio-label-center">Date Send</th>
					<th class="radio-label-center">Seen</th>
					<th class="radio-label-center">Status</th>
				</tr>
				</thead>
				<tbody>				
				</tbody>
			</table>
		</div>
		
	</div>

	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#Send_Serial_Modal" class="custom-btn">Send New Serial!</button>
		</div>
	</div>
</div>
<?php 
		include 'Modals/Send_serial_modal.php';
?>
<script>
	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_SS")){
			$('#table_SS').DataTable({			
		"processing":true,
		"serverSide":true,
		"ordering":true,
		"searching":true,
		"ajax":"SSP/serverside_Send_Serials.php"
			});
		}

	
	$('#table_SS').on('draw.dt', function() {
		$('#table_SS').Tabledit({
			url:"php_codes/modify_send_Serial.php",
			columns:{
			identifier:[0,"ReceivedSerialID"],
			editable:[]
				},
			onSuccess:function(data,textStatus,jqXHR)
			{
				if(data.action=='delete')
				{
					$("#"+data.ReceivedSerialID).remove();			
				}
			}
		});
	});

	$('#Send_Serial').on('submit',function(event){
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
	 			data:$("#Send_Serial").serialize(),
	 			success:function(data)
	 			{
 					$("#Send_Serial")[0].reset();
 					$("#Send_Serial_Modal").modal('hide');
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
	$('button.tabledit-edit-button').remove();
});
</script>