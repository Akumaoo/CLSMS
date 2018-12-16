<div id="edit_orgs_modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Modify Organization!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="modify_orgs" method="post">

				 				<div class="form-group form-group-center">
				 					<label class="control-label col-lg-10">Organization ID:<span style="margin-left: 80px" id="orgID"></span></label>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="prog_id" class="control-label col-lg-5">Program ID</label>
				 					<div class="col-lg-5">
				 						<input type="text" class="form-control" name="prog_id" id="prog_id" required>
				 					</div>
				 				</div>

				 				<p style="text-align: left;color:#3C3838">**NOTE**: 
				 					<br><span style="margin-left: 30px">-You can enter multiple Programs with the same Department And Organization by seperating them with comma(",")</span>
				 					<br><span style="margin-left: 30px">-You Can Only Re-Categorize Recently Added Programs.</span>
				 				</p>



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

