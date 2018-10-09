<div id="add_delivery_data_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Serial On Package!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="create_new_delivery" method="post">

				 				<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_modal">
								    <strong>Successfully Added Serial Into This Package!</strong>
							 	 </div>

							  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_modal">
								    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
							  	</div>

				 				<div class="form-group form-group-center">
				 					<label for="SN" class="control-label col-lg-3">Serial Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="SN" id="SN">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="DOI" class="control-label col-lg-3">Date Of Issue</label>
				 					<div class="col-lg-6">
				 						<input type="date" class="form-control" name="DOI" id="DOI">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="IN" class="control-label col-lg-3">Issue Number</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control " name="IN" id="IN">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="VN" class="control-label col-lg-3">Vol. Number</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control " name="VN" id="VN">
				 					</div>
				 				</div>
									
								<div class="form-group form-group-center">
				 					<label for="Copy" class="control-label col-lg-3">Serial Copies</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control " name="Copy" id="Copy">
				 					</div>
				 				</div>		

				 				<input type="hidden" name="Pack_name" <?php echo 'value="'.$name.'"'?>>

				 				<div class="form-group form-group-center" id="save_btn">
				 					<div class="col-lg-offset-8">
				 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
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

