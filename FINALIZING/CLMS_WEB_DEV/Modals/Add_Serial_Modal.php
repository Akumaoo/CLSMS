

<div id="Add_Serial_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Serial</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="Add_Serial" method="post">
				 				
				 				<div class="form-group form-group-center">
				 					<label for="serialname" class="control-label col-lg-3">Serial Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="serialname" id="serialname" required>
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="type" class="control-label col-lg-3">Type</label>
				 					<div class="col-lg-6">
				 						<select name="type" id="type">
				 						<option value="Journal">Journal</option>
				 						<option value="Magazine">Magazine</option>
				 						</select>
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="type" class="control-label col-lg-3">Origin</label>
				 					<div class="col-lg-6">
				 						<select name="orig" id="orig">
				 						<option value="Local">Local</option>
				 						<option value="International">International</option>
				 						</select>
				 					</div>
				 				</div>

				 				

				 				<div class="form-group form-group-center">
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

