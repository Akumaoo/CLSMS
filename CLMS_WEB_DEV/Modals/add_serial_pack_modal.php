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

