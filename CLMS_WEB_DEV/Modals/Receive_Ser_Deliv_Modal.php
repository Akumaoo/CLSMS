<div id="receive_deliv_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Receive Delivery</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
						<form class="cmxform form-horizontal style-form" id="receive_del_form" method="post">

						<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_rec">
						    <strong>Successfully added Receive Serial</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_rec">
						    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
					  	</div>

						<div class="form-group form-group-center">
							<label for="sn_rec" class="control-label col-lg-3">Serial Name</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="sn_rec" id="sn_rec" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="DOI_rec" class="control-label col-lg-3">Date Of Issue</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="DOI_rec" id="DOI_rec">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="VN_rec" class="control-label col-lg-3">Volume Number</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="VN_rec" id="VN_rec">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="IN_rec" class="control-label col-lg-3">Issue Number</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="IN_rec" id="IN_rec">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="copy_rec" class="control-label col-lg-3">Copies</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="copy_rec" id="copy_rec" required>
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="DR_rec" class="control-label col-lg-3">Date Received</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="DR_rec" id="DR_rec" required>
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

