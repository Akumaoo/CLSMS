

<div id="Print_Modal" class="modal fade">
	<div class="modal-dialog" style="margin-top:160px;">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Generate Report</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel" style="padding: 20px">
				 			<form class="cmxform form-horizontal style-form" id="form_report" method="post" target="_blank">
				 				
				 				<div class="form-group form-group-center">
				 					<label for="Reason" class="control-label col-lg-5">BondPaper Size:</label>
				 					<div class="col-lg-5">
				 						<select name="BP_size" style="width: 135px">
				 							<option value="Letter">Letter</option>
				 							<option value="Legal">Legal</option>
				 							<option value="A4">A4</option>
				 						</select>
				 						<input type="hidden" name="Dept" value=<?php echo $dept; ?>>
				 					</div>
				 				</div>				 				

				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-7">
				 						<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Confirm</button>
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

