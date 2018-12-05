<div id="add_user_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add User!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="Add_User" method="post" enctype="multipart/form-data">

				 			<div class="form-group">
								<label for="FN" class="control-label col-lg-4">First Name</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name='FN' id="FN" required>
							</div>

							</div>	
							<div class="form-group">
								<label for="LN" class="control-label col-lg-4">Last Name</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name='LN' id="LN" required>
								</div>
							</div>	

							<div class="form-group">
								<label for="mail" class="control-label col-lg-4">Email</label>
								<div class="col-lg-8">
									<input type="email" class="form-control" name='mail' id="mail" required>
								</div>
							</div>

							<div class="form-group">
								<label for="username" class="control-label col-lg-4">Username</label>
								<div class="col-lg-8">
									<input type="text" class="form-control" name='username' id="username" required>
								</div>

							</div>	
							<div class="form-group">
								<label for="pass1" class="control-label col-lg-4">Password</label>
								<div class="col-lg-8">
									<input type="password" class="form-control" name='pass1' id="pass1" required>
								</div>

							</div>
							<div class="form-group">
								<label for="pass2" class="control-label col-lg-4">Confirm Password</label>
								<div class="col-lg-8">
									<input type="password" class="form-control " name='pass2' id="pass2" required>
								</div>
							</div>	
							<div class="form-group">
								<label for="role" class="control-label col-lg-4">User Role</label>
								<div class="col-lg-8">
									<select class="tabledit-input form-control input-sm" name="role" id="role">
										<option style="display: none" value="stat">--Role--</option>
										<option value="Admin">Admin</option>
										<option value="Staff">Staff</option>
									</select>
								</div>
							</div>

							<div class="form-group collapse" id='Dept_select'>
								<label for="dept" class="control-label col-lg-4">Department</label>
								<div class="col-lg-8">
									<select class="tabledit-input form-control input-sm" name="dept" id="dept">
										<option style="display: none" value="stat">--Dept--</option>
										<?php 
										require 'php_codes/db.php';
										$sql="Select * from Department WHERE Remove IS NULL";
										$query=sqlsrv_query($conn,$sql,array());
										if(sqlsrv_has_rows($query))
										{
											while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
											{
												echo '
													<option value="'.$row['DepartmentID'].'">'.$row['DepartmentID'].'</option>
												';
											}
										}
										 ?>
										
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="ava" class="control-label col-lg-4">Avatar</label>
								<div class="col-lg-8">
									<input type="file" class="form-control " name='ava' id="ava" required>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-8">
									<button class="custom-btn" type="submit" name="save">Save</button>
								</div>
							</div>

							
				 			</form>
			 			</div>
			 		</div>
			 	</div><!--row-->
			 </div><!--container-->
			</div><!--modal-body-->
		</div>
	</div>
</div>

