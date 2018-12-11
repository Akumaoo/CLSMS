

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
			 			<div class="form form_custom ">
				 			<form class="cmxform form-horizontal style-form" id="Add_Serial" method="post">
				 				
				 				<div class="form-group">
				 					<label for="serialname" class="control-label col-lg-4">Serial Name</label>
				 					<div class="col-lg-8">
				 						<input type="text" class="form-control" name="serialname" id="serialname">
				 					</div>
				 				</div>

				 				<div class="form-group">
				 					<label for="type" class="control-label  col-lg-4">Type</label>
				 					<div class="col-lg-8">
				 						<select class="col-lg-10 newdropdown" name="type" id="type">
				 						<option value="Journal">Journal</option>
				 						<option value="Magazine">Magazine</option>
				 						</select>
				 					</div>
				 				</div>

				 				<div class="form-group">
				 					<label for="type" class="control-label col-lg-4">Origin</label>
				 					<div class="col-lg-8 ">
				 						<select class="col-lg-10 newdropdown name="orig" id="orig">
				 						<option value="Local">Local</option>
				 						<option value="International">International</option>
				 						</select>
				 					</div>
				 				</div>

				 				

				 				<div class="form-group">
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

