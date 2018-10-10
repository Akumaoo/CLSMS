<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-plus-square tag_style"> Serials:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Serial!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="custom_table">
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
						<?php 
							require 'php_codes/db.php';
							$sql="SELECT DISTINCT CS2.SerialID,SerialName,TypeName, 
									SUBSTRING(
										(
											SELECT ', '+CS1.DepartmentID  AS [text()]
											FROM Categorize_Serials CS1
											WHERE CS1.SerialID=CS2.SerialID
											ORDER BY CS1.SerialID
											FOR XML PATH ('')
										), 2, 1000) [Departments]
								FROM Categorize_Serials CS2 Inner JOIN Serial ON CS2.SerialID=Serial.SerialID LEFT Join [Type] ON Serial.TypeID=[Type].TypeID";
								$query=sqlsrv_query($conn,$sql,array());
								if(sqlsrv_has_rows($query))
								{
									while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
									{
										$sID=$row['SerialID'];
										$sname=$row['SerialName'];
										$tn=$row['TypeName'];
										$dept=$row['Departments'];

										echo '
										<tr class="gradeU">
											<td class="radio-label-center">'.$sID.'</td>
											<td class="radio-label-center dept_click">'.$sname.'</td>
											<td class="radio-label-center">'.$tn.'</td>
											<td class="radio-label-center ">'.$dept.'</td>									
										</tr>
									';
									}
								}
						 ?>
					</tbody>
				</table>
			</div>
		
	</div>

		<div class="">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#Add_Serial_Modal" class="custom-btn">Add New Serial</button>
			</div>
		</div>
	</div>
</div>
<?php include "Modals/Add_Serial_Modal.php";
?>
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
</script>