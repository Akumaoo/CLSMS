<div id="add_package_data_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Create New Package!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="create_new_package" method="post">
				 				<div class="form-group form-group-center">
				 					<label for="Pname" class="control-label col-lg-3">Package Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="Pname" id="Pname">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="ERD" class="control-label col-lg-3">Expected Receive Date</label>
				 					<div class="col-lg-6">
				 						<input type="date" class="form-control" name="ERD" id="ERD">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="Dname" class="control-label col-lg-3">Distributor Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="Dname" id="Dname">
				 					</div>
				 				</div>


				 				

				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-8">
				 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
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

