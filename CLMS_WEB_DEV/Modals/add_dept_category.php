<div id="add_dept_serial_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Department To Serial: <?php echo $_POST['S_ID']; ?>!</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="add_dept_serial" method="post">
				 				<div class="form-group form-group-center">
				 					<label for="DeptID" class="control-label col-lg-3">Department Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="DeptID" id="DeptID">
				 					</div>
				 					<input type="hidden" class="form-control" name="sID" <?php 
				 					echo 'value="'.getID($_POST['S_ID']).'"' ?> >
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

