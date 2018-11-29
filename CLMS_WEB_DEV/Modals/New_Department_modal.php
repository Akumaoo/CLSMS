<div id="add_Department_data_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Department!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="Add_Department" method="post">
	
								<div class="form-group form-group-center">
				 					<label for="id" class="control-label col-lg-5">Department ID</label>
				 					<div class="col-lg-5">
				 						<input type="text" class="form-control" name="id" id="id" required>
				 					</div>
				 				</div>

			 					<input type="checkbox" id="cb_org" style="margin-left:230px;margin-right: 15px;margin-bottom: 30px"><span>With Organization?</span>
								
								<div id="org_cont" class="collapse">

					 				<div class="form-group form-group-center">
					 					<label for="org_id" class="control-label col-lg-5">Organization ID</label>
					 					<div class="col-lg-5">
					 						<input type="text" class="form-control" name="org_id" id="org_id">
					 					</div>
					 				</div>

					 				<div class="form-group form-group-center">
					 					<label for="prog_id" class="control-label col-lg-5">Program ID</label>
					 					<div class="col-lg-5">
					 						<input type="text" class="form-control" name="prog_id" id="prog_id">
					 					</div>
					 				</div>

					 				<p style="text-align: right;">*NOTE: You can enter multiple Programs with the same Department And Organization by seperating them with comma(",")</p>
					 				
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

