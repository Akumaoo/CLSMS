<div id="Receive_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Receive Modal</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
				 			<form class="cmxform form-horizontal style-form" id="SEND_RECEIVE" method="post">

				 				<div class="form-group form-group-center">
				 					<label for="cn" class="control-label col-lg-3">Control Number</label>
				 					<div class="col-lg-6">
				 						<input type="Number" class="form-control" name="cn" id="cn">
				 						<input type="hidden" name="serialn" id="sn">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="comm" class="control-label col-lg-3">Comment</label>
				 					<div class="col-lg-6">
				 						<textarea  class="form-control" name="comm" id="comm" cols="69" rows="10"> </textarea>
				 					</div>
				 				</div>


				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-4">
				 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save" style="width: 180px;">Receive Serial!</button>
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

