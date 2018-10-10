<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-paper-plane tag_style"> Send Serials:</h4>
			<h4 class="dividerr"></h4>
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

	<div class="custom_table">

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

		<div class="">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#Send_Serial_Modal" class="custom-btn">Send New Serial!</button>
			</div>
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
		
	$('tbody tr td:nth-child(3)').addClass('PName_click');
	$(".PName_click").click(function(){
		$SR_ID=$(this).closest('tr').attr('id');
		$Sname=$(this).text();
		$.ajax({
		type:'POST',
		url:'View_RS_Serial.php',
		data:{
			send_ID:$SR_ID,
			send_name:$Sname
		},
		success:function(data){
			$('.container-fluid').html(data)
		}
		});
	});

	if(!$('tbody>tr:nth-child(1)>td').hasClass('dataTables_empty'))
	{
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
		$('button.tabledit-edit-button').remove();

		
	}
	else
	{
		$('.tabledit-toolbar-column').remove()
	}
		
	});

	$('#Send_Serial').on('submit',function(event){
		event.preventDefault();
		 var deptlist=[];
		 $.each($('input[name="dept"]:checked'),function(){
		 	deptlist.push($(this).val());
		 });

		 var sName=$('#serialname').val();

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
	 			url:"php_codes/insert_send_serial.php",
	 			method:"POST",
	 			data:{sername:sName,depts:deptlist},
	 			success:function(data)
	 			{
 					$("#Send_Serial")[0].reset();
 					$("#Send_Serial_Modal").modal('hide');
 					if(data.fail_enter==0)
 					{
 						$("#msg_scs").removeClass('collapse');
 					}
 					else if(data.status>0 && data.fail_enter>0)
 					{
 						$("#msg_warn").removeClass('collapse');
 						$('.warn_val').text('Successfully Entered: '+data.status+' Data And Fail To Enter: '+data.fail_enter+' Data');
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