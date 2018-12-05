<div id="add_data_Modal_next_POST" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subscribe On Distributor: <strong id="disb_tag_POST"></strong>[<strong id="disb_type_POST"></strong>]</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
						<form class="cmxform form-horizontal style-form" id="subscribe_new_form_POST" method="post">

						<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_POST">
						    <strong>Successfully Subscribed!</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_POST">
						    <strong>Invalid Serial Name!</strong> , <span id="fail_msg_post">Please Check The Values You Entered And Try Again.</span>
					  	</div>
					  	
						<div class="form-group form-group-center collapse" id="retry_POST">
							<div class="row">
								<div class="col-lg-12">
									<h4 style="margin-left:20px;">Continue?</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-lg-offset-3">
									<button class=" custom-btn" type="button" id="btn_yes_POST">Yes</button>
								</div>
								<div class="col-lg-offset-5">
									<button class=" custom-btn" type="button" id="btn_no_POST">No</button>
								</div>
							</div>
						</div>

					  	<div class="collapse" id="prev-data-POST">

					  	<div class="form-group form-group-center">
							<label for="SNf" class="control-label col-lg-6">Total Subscribed: <strong id="total_insert">0</strong></label>	
						</div>

						<div class="form-group form-group-center">
							<label for="SNf" class="control-label col-lg-6">Previous Serial: <strong id="prev_insert"></strong></label>
						</div>

						</div>
						

						<div class="form-group form-group-center">
							<label for="SNf" class="control-label col-lg-3">Serial Name</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="Serial_POST" id="SNf_POST" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Freq" class="control-label col-lg-3">Frequency</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Freq_POST" id="Freq_POST" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Cost" class="control-label col-lg-3">Cost</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Cost_POST" id="Cost_POST" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="SSD_POST" class="control-label col-lg-3">Subscription Start Date</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="SSD_POST" id="SSD_POST" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="SED_POST" class="control-label col-lg-3">Subscription End Date</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="SED_POST" id="SED_POST" required>
							</div>
						</div>		

						<div class="form-group form-group-center">
		 					<label for="dept" class="control-label col-lg-3">Departments</label>
		 					<div class="col-lg-6">
		 						<?php require "php_codes/db.php";
		 						$sql="SELECT * FROM Department WHERE Remove IS NULL";
		 						$query = sqlsrv_query($conn, $sql, array());
		 						if (sqlsrv_has_rows($query))
		 							{	
		 								echo "<ul>";
		 								$depts="";
		 								while ($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
		 										$depts.="<li><input type='checkbox' class='dept_list_post' name='dept' value='".$row['DepartmentID']."'>".$row['DepartmentID']."</li>";
		 								}
		 								echo $depts."</ul>";
		 							}
		 						?>			
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center collapse select_org_post" id="">
		 					<label for="org" class="control-label col-lg-3">Organizations</label>
		 					<div class="col-lg-6">
		 						<ul class="org_list_post">
		 						</ul>
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center collapse select_prog_post" id="">
		 					<label for="prog" class="control-label col-lg-3">Programs</label>
		 					<div class="col-lg-6">
		 						<ul>
		 							<ul class="prog_list_post" style="padding: 0">
		 							</ul>
		 						</ul>
		 					</div>
		 				</div>

						<div class="form-group form-group-center" id="save_btn_POST">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" value="save" name="save">Save</button>
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

