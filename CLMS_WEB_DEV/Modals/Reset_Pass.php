<div id="reset_pass_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Reset Password!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
							<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_rp">
							    <strong>Incorrect Password!</strong>
						  	</div>
						  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_confirm_rp">
							    <strong>Password Didn't Match!</strong>
						  	</div>	
						  	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_rp">
							    <strong>Successfully Updated Password!</strong>
						 	 </div>
						  	<input type="hidden" value="<?php echo $_SESSION['uID']?>" id='uID'>
							<div id="form-content">
					 			<form class="cmxform form-horizontal style-form" id="reset_pass_1step" method="post">
					 				<div class="form-group form-group-center">
					 					<label for="curr_pass" class="control-label col-lg-5">Current Password:</label>
					 					<div class="col-lg-5">
					 						<input type="password" class="form-control" name="curr_pass" id="curr_pass" required>
					 					</div>
					 				</div>
									

					 				<div class="form-group form-group-center">
					 					<div class="col-lg-offset-8">
					 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save">Next</button>
					 					</div>
					 				</div>
					 			</form>
				 			</div>



			 			</div>
			 		</div>
			 	</div><!--row-->
			 </div><!--container-->
			</div><!--modal-body-->
		</div>
	</div>
</div>

