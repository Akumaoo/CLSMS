<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Distributors:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Subscribed!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , <span class="failmsg">Please Check The Values You Entered And Try Again.</span>
  	</div>

	<div class="row custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_disb">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Distributor ID</th>
					<th class="radio-label-center">Distributor Name</th>
					<th class="radio-label-center">Name Of Incharge</th>
					<th class="radio-label-center">Contact Number</th>
					<th class="radio-label-center">Email</th>


				</tr>
				</thead>
				<tbody>
					<?php 
						require 'php_codes/db.php';
						$sql="Select * from Distributor";
						$query=sqlsrv_query($conn,$sql,array(),$opt);
						if(sqlsrv_has_rows($query))
						{
							while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
							{
								$id=$row['DistributorID'];
								$name=$row['DistributorName'];
								$NOI=$row['NameOfIncharge'];
								$contact=$row['ContactNumber'];
								$mail=$row['Email'];

								echo '
									<tr class="gradeU">
										<td class="radio-label-center">'.$id.'</td>
										<td class="radio-label-center">'.$name.'</td>
										<td class="radio-label-center">'.$NOI.'</td>
										<td class="radio-label-center">'.$contact.'</td>
										<td class="radio-label-center">'.$mail.'</td>
																	
									</tr>
								';
							}
						}

					 ?>
				</tbody>
			</table>
		</div>
		
	</div>

	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_Distributor_data_Modal" class="btn custom-btn">New Distributor</button>
		</div>
	</div>
</div>
<?php 
include 'Modals/New_Distributor_Modal.php'
 ?>

<script>
	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_disb")){
			$('#table_disb').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true
		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

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
 					
	 			}
	 		});
	 	}
	});

});
</script>