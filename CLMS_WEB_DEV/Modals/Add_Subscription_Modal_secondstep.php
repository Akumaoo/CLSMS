<div id="add_data_Modal_next" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subscribe On Distributor: <strong id="disb_tag"></strong>[<strong id="disb_type"></strong>]</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
						<form class="cmxform form-horizontal style-form" id="subscribe_new_form_Pre" method="post">

						<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
						    <strong>Successfully Subscribed!</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
						    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
					  	</div>

						<div class="form-group form-group-center">
							<label for="SNf" class="control-label col-lg-3">Serial Name</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="Serial" id="SNf" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Freq" class="control-label col-lg-3">Frequency</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Freq" id="Freq" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Cost" class="control-label col-lg-3">Cost</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Cost" id="Cost" required>
							</div>
						</div>



						<div class="form-group form-group-center" id="save_btn">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
							</div>
						</div>

						<div class="form-group form-group-center collapse" id="retry">
							<div class="row">
								<div class="col-lg-12">
									<h4 style="margin-left:20px;">Continue?</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-lg-offset-3">
									<button class=" custom-btn" type="button" id="btn_yes">Yes</button>
								</div>
								<div class="col-lg-offset-5">
									<button class=" custom-btn" type="button" id="btn_no">No</button>
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

