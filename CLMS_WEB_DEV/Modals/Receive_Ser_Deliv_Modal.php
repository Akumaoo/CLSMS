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
						    <strong>Successfully Added Receive Serial</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_rec">
						    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
					  	</div>

						<div class="form-group form-group-center">
							<label for="sn_rec" class="control-label col-lg-3">Serial Name:</label>
							<div class="col-lg-6">
								<input type="hidden" name="sn_rec" id="sn_rec">
								<h5 id='Serial_Name'>asd</h5>
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

						<!-- <div class="form-group form-group-center">
							<label for="DR_rec" class="control-label col-lg-3">Date Received</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="DR_rec" id="DR_rec" required>
							</div>
						</div> -->


						<div class="form-group form-group-center">
							<label for="copy_rec" class="control-label col-lg-3">Departments</label>

							<div class="col-lg-6" id="dept_list_categ">
							</div>
						</div>

						<div class="form-group form-group-center collapse select_org" id="">
		 					<label for="org" class="control-label col-lg-3">Organizations</label>
		 					<div class="col-lg-6">
		 						<ul class="org_list">
		 						</ul>
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center collapse select_prog" id="">
		 					<label for="prog" class="control-label col-lg-3">Programs</label>
		 					<div class="col-lg-6">
		 						<ul>
		 							<ul class="prog_list" style="padding: 0">
		 							</ul>
		 						</ul>
		 					</div>
		 				</div>


						<div class="form-group form-group-center" id="save_btn">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
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


