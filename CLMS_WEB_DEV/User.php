<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class="custom-panelbox">
	<div class="">
		<div class="">
			<h4 class="fa fa-user-plus tag_style">Manage Users:</h4>
			<h4 class="dividerr"></h4>
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

	<div class=" custom_table">

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

	<div class="">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_user_modal" class="custom-btn">Add User!</button>
		</div>
	</div>
</div>
</div>
<?php 
		include 'Modals/New_user_Modal.php';
?>
<script type="text/javascript" src="Js/User_main.js"></script>