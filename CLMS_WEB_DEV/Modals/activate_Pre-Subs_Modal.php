<div id="add_data_Modal_activate" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Activate Total Subscription: <strong id="tot"></strong></h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
						<form class="cmxform form-horizontal style-form" id="subscribe_new_form_Pre_activate" method="post">

						<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_Pre_activate">
						    <strong>Successfully Activated!</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_Pre_activate">
						    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
					  	</div>
						<div id="hide">
						<div class="form-group form-group-center">
							<h4>Serial Name: [<strong id="sub_ID"></strong>] <strong id="ser_name"></strong></h4>
						</div>

						<div class="form-group form-group-center">
							<label for="SED_Pre_activate" class="control-label col-lg-3">Subscription End Date</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="SED_Pre_activate" id="SED_Pre_activate" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="RT" class="control-label col-lg-3">Region Type</label>
							<div class="col-lg-6">
								<select name="RT" id="RT">
									<option value="stat" disabled selected>---Select---</option>
									<option value="Local">Local</option>
									<option value="International">International</option>
								</select>
							</div>
						</div>
						</div>	

						<div class="form-group form-group-center" id="save_btn_Pre_activate">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" value="save" name="save">Save</button>
							</div>
						</div>

						<div class="form-group form-group-center collapse" id="retry_Pre_activate">
							<div class="row">
								<div class="col-lg-12">
									<h4 style="margin-left:20px;">Continue?</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-lg-offset-3">
									<button class=" custom-btn" type="button" id="btn_yes_Pre_activate">Next</button>
								</div>
							</div>
						</div>

						<div class="form-group form-group-center collapse" id="retry_Pre_activate_finish">
							<div class="row">
								<div class="col-lg-12">
									<h4 style="margin-left:20px;">Continue?</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-lg-offset-3">
									<button class=" custom-btn" type="button" id="btn_yes_Pre_activate_finish_btn">Finish</button>
								</div>
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

