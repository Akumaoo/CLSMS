<div id="add_data_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Subscribe Now!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form action="Subscribe_New.php" class="cmxform form-horizontal style-form" id="subscribe_new_form" method="post">
				 				<div class="form-group form-group-center">
				 					<label for="Disb" class="control-label col-lg-3">Distributor Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="Disb" id="DN">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Serial" class="control-label col-lg-3">Serial Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="Serial" id="SNf">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Freq" class="control-label col-lg-3">Frequency</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control form_remove_up_down" name="Freq" id="Freq">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Cost" class="control-label col-lg-3">Cost</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control form_remove_up_down" name="Cost" id="Cost">
				 					</div>
				 				</div>

				 				<hr class="theme_hr">

				 				<div class="form-group form-group-center">
				 					<label for="Cost" class="control-label col-lg-3">Date Of Issue</label>
				 					<div class="col-lg-6">
				 						<input type="date" class="form-control" name="DOI" id="DOI">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Cost" class="control-label col-lg-3">Issue Number</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control form_remove_up_down" name="IN" id="IN">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Cost" class="control-label col-lg-3">Vol. Number</label>
				 					<div class="col-lg-6">
				 						<input type="number" class="form-control form_remove_up_down" name="VN" id="VN">
				 					</div>
				 				</div>
									
								<hr class="theme_hr">

				 				<div class="form-group form-group-center">
				 					<label for="Cost" class="control-label col-lg-3">Package Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="PN" id="PN">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-8">
				 						<button class="btn custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
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

