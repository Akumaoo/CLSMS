<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Serial Types:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	
 	 <div class="alert alert-success alert-dismissible collapse center" id="msg_scs_type">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Serial Type!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , <span class="failmsg">Please Check The Values You Entered And Try Again.</span>
  	</div>

	<div class="row custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MT">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Type ID</th>
					<th class="radio-label-center">Type Name</th>


				</tr>
				</thead>
				<tbody>
					<?php 
						require 'php_codes/db.php';
						$sql="Select * from [Type]";
						$query=sqlsrv_query($conn,$sql,array());
						if(sqlsrv_has_rows($query))
						{
							while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
							{
								$id=$row['TypeID'];
								$name=$row['TypeName'];

								echo '
									<tr class="gradeU">
										<td class="radio-label-center">'.$id.'</td>
										<td class="radio-label-center">'.$name.'</td>																	
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
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#Add_Type_Modal" class="custom-btn">New Type of Serial</button>
		</div>
	</div>
</div>
<?php 
   	  include "Modals/New_Type_Modal.php";
 ?>

<script>
	$(function(){

		if( ! $.fn.DataTable.isDataTable("#table_MT")){
			$('#table_MT').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,

		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

	$('#table_MT').Tabledit({
		url:"php_codes/modify_Type.php",
		columns:{
		identifier:[0,"TypeID"],
		editable:[[1,"TypeName"]]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.TypeID).remove();			
			}
		}
	});

	$('#Add_Type').on('submit',function(event){
	event.preventDefault();

 	if($("#tn").val()=="")
 	{
 		alert("Type Name Is Required");
 	}
 	else{
 		$.ajax({
 			url:"php_codes/Insert_new_Type.php",
 			method:"POST",
 			data:$("#Add_Type").serialize(),
 			success:function(data)
 			{
					$("#Add_Type")[0].reset();
					$("#Add_Type_Modal").modal('hide');
					if(data.status=='success')
					{
						$("#msg_scs_type").removeClass('collapse');
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