<?php 

require 'db.php';


if(isset($_POST['S_ID']))
{
	function getID($name)
	{
		require 'db.php';
		$sql="Select SerialID from Serial Where SerialName=?";
		$query=sqlsrv_query($conn,$sql,array($name));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$id=$row['SerialID'];
			}
			return $id;
		}
		else
		{
			return 'NotValid';
		}
	}

	echo '
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h5 class="tag_style">Categorize Serial: '.$_POST['S_ID'].'</h5>
				<hr class="theme_hr">
			</div>
		</div>
		
		<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Successfully Added Department Into This Serial!</strong> , Please Reload The Page To Update The Table.
	 	 </div>

	  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
	  	</div>

		<div class="row custom_table">

			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_CS">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Category ID</th>
						<th class="radio-label-center">Department ID</th>
						<th class="radio-label-center">Department Name</th>
					</tr>
					</thead>
					<tbody>';
						$id=$_POST['S_ID'];
						$get_id=getID($id);
						$sql="Select CategoryID,Department.DepartmentID,DepartmentName From Department Inner Join Categorize_Serials ON Department.DepartmentID=Categorize_Serials.DepartmentID Where SerialID=?";
						$query=sqlsrv_query($conn,$sql,array($get_id));
						if(sqlsrv_has_rows($query))
						{
							while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
							{
								$dID=$row['DepartmentID'];
								$dn=$row['DepartmentName'];
								$cID=$row['CategoryID'];

								echo '
								<tr class="gradeU">
									<td class="radio-label-center">'.$cID.'</td>
									<td class="radio-label-center">'.$dID.'</td>
									<td class="radio-label-center">'.$dn.'</td>																
								</tr>
							';
							}
						}


		echo '
					</tbody>
				</table>
			</div>
			
		</div>

		<div class="row">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_dept_serial_Modal" class="custom-btn">Add Department!</button>
			</div>
		</div>
	</div>';
}

include '../Modals/add_dept_category.php';
?>
<script>
 	$(function(){
 		if( ! $.fn.DataTable.isDataTable("#table_CS")){
			$('#table_CS').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true
		// "ajax":"php_codes/serverside_currentSubs.php",
			});
		}

		$('#table_CS').Tabledit({
		url:"php_codes/modify_serial_category.php",
		columns:{
		identifier:[0,"CategoryID"],
		editable:[]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.CategoryID).remove();			
			}
		}
	
		});

		$('button.tabledit-edit-button').remove();

		$('#add_dept_serial').on('submit',function(event){
		event.preventDefault();

	 	if($("#DeptID").val()=="")
	 	{
	 		alert("DepartmentID Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/modify_serial_category.php",
	 			method:"POST",
	 			data:$("#add_dept_serial").serialize(),
	 			success:function(data)
	 			{
 					$("#add_dept_serial")[0].reset();
 					$("#add_dept_serial_Modal").modal('hide');
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