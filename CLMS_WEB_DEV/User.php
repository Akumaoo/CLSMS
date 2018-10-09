<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Manage Users:</h5>
			<hr class="theme_hr">
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added User!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="row custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_user">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">UserID</th>
					<th class="radio-label-center">Username</th>
					<th class="radio-label-center">First Name</th>
					<th class="radio-label-center">Last Name</th>
					<th class="radio-label-center">Email</th>
					<th class="radio-label-center">Role</th>
					<th class="radio-label-center">Department</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						require 'php_codes/db.php';
						$sql="Select * from [User]";
						$query=sqlsrv_query($conn,$sql,array());
						if(sqlsrv_has_rows($query))
						{
							while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
							{
								$id=$row['UserID'];
								$username=$row['UserName'];
								$FN=$row['FirstName'];
								$LN=$row['LastName'];
								$Email=$row['Email'];
								$role=$row['Role'];
								$dept=$row['DepartmentID'];

								echo '
									<tr class="gradeU">
										<td class="radio-label-center">'.$id.'</td>
										<td class="radio-label-center">'.$username.'</td>
										<td class="radio-label-center">'.$FN.'</td>
										<td class="radio-label-center">'.$LN.'</td>
										<td class="radio-label-center">'.$Email.'</td>
										<td class="radio-label-center">'.$role.'</td>
										<td class="radio-label-center">'.$dept.'</td>																	
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
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_user_modal" class="custom-btn">Add User!</button>
		</div>
	</div>
</div>
<?php 
		include 'Modals/New_user_Modal.php';
?>
<script>
	$(function(){

	if( !$.fn.DataTable.isDataTable("#table_user")){
		$('#table_user').DataTable({			
		"ordering":true,
		"searching":true,
		"pageLength":100
		});
	}

	$('#table_user').Tabledit({
		url:"php_codes/modify_user.php",
		columns:{
		identifier:[0,"UserID"],
		editable:[]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.UserID).remove();			
			}
		},onDraw: function() 
		{		
			function getdepts(){
				$val=[];				
				$.ajax({
					url:'php_codes/get_depts.php',
					method:"POST",
					success:function(data){
						$val=data;
					},
					async:false
					});
				return $val;
			}
			$return_depts=getdepts();
			$option="";
			for($x=0;$x<$return_depts.length;$x++)
			{	
				$option+='<option value="'+$return_depts[$x]+'">'+$return_depts[$x]+'</option>';
			}

			$('tbody tr td:nth-child(7)>input').each(function(){		 					

			$('<select class="tabledit-input form-control input-sm" style="display: none;" disabled=""><option style="display: none" value="stat">--Status--</option>'+$option+'</select>').attr({ name: this.name, value: this.value }).insertBefore(this)				
			}).remove()

			$('button.tabledit-edit-button').remove();
 		}
	
	});
	
	$('#Add_User').on('submit',function(event){
		event.preventDefault();

		var form = $('#Add_User')[0];
		var data = new FormData(form);

	 	if($("#FN").val()=="")
	 	{
	 		alert("First Name Is Required");
	 	}
	 	else if($("#LN").val()=="")
	 	{
	 		alert("Last Name Is Required");
	 	}
	 	else if($('#mail').val()=="")
	 	{
	 		alert('Email Is Required');
	 	}
	 	else if($("#username").val()=="")
	 	{
	 		alert('Username Is Required');
	 	}
	 	else if($("#pass1").val()=="")
	 	{
	 		alert('Password Is Required');
	 	}
	 	else if($("#pass2").val()=="")
	 	{
	 		alert('Confirm Password Is Required');
	 	}
	 	else if($('#pass1').val()!=$('#pass2').val())
	 	{
	 		alert('Confirm Password Did Not Match');
	 	}
	 	else if($("#role").val()=="stat")
	 	{
	 		alert('User Role Is Required');
	 	}
	 	else if($("#dept").val()=="stat")
	 	{
	 		alert('Department Is Required');
	 	}
	 	else if($("#ava").val()=="")
	 	{
	 		alert('Avatar Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_new_User.php",
	 			method:"POST",
	 			enctype: 'multipart/form-data',
	 			processData:false,
	 			contentType: false,
	 			data:data,
	 			success:function(data)
	 			{
 					$("#Add_User")[0].reset();
 					$("#add_user_modal").modal('hide');
 					if(data.status=='success')
 					{
 						$("#msg_scs").removeClass('collapse');

 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');
 						alert(data.status);
 					}
	 			}
	 		});
	 	}
	});

	

});
</script>