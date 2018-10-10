<div id="add_user_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Distributor!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="Add_User" method="post" enctype="multipart/form-data">

				 			<div class="form-group">
								<label for="FN" class="control-label col-lg-2">First Name</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name='FN' id="FN">
							</div>

							</div>	
							<div class="form-group">
								<label for="LN" class="control-label col-lg-2">Last Name</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name='LN' id="LN">
								</div>
							</div>	

							<div class="form-group">
								<label for="mail" class="control-label col-lg-2">Email</label>
								<div class="col-lg-10">
									<input type="email" class="form-control" name='mail' id="mail">
								</div>
							</div>

							<div class="form-group">
								<label for="username" class="control-label col-lg-2">Username</label>
								<div class="col-lg-10">
									<input type="text" class="form-control" name='username' id="username">
								</div>

							</div>	
							<div class="form-group">
								<label for="pass1" class="control-label col-lg-2">Password</label>
								<div class="col-lg-10">
									<input type="password" class="form-control" name='pass1' id="pass1">
								</div>

							</div>
							<div class="form-group">
								<label for="pass2" class="control-label col-lg-2">Confirm Password</label>
								<div class="col-lg-10">
									<input type="password" class="form-control " name='pass2' id="pass2">
								</div>
							</div>	
							<div class="form-group">
								<label for="role" class="control-label col-lg-2">User Role</label>
								<div class="col-lg-10">
									<select class="tabledit-input form-control input-sm" name="role" id="role">
										<option style="display: none" value="stat">--Status--</option>
										<option value="Admin">Admin</option>
										<option value="Staff">Staff</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="dept" class="control-label col-lg-2">Department</label>
								<div class="col-lg-10">
									<select class="tabledit-input form-control input-sm" name="dept" id="dept">
										<option style="display: none" value="stat">--Status--</option>
										<?php 
										require 'php_codes/db.php';
										$sql="Select * from Department";
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
								<label for="ava" class="control-label col-lg-2">Avatar</label>
								<div class="col-lg-10">
									<input type="file" class="form-control " name='ava' id="ava">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-offset-10">
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
