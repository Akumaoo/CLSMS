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
				 			<form class="cmxform form-horizontal style-form" id="first_step" method="post">

							  	<div class="alert alert-danger alert-dismissible collapse center" id="error">
								    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
							  	</div>

				 				<div class="form-group form-group-center">
				 					<label for="DN" class="control-label col-lg-3">Distributor Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="DN" id="DN">
				 					</div>
				 				</div>
								<hr class="theme_hr">

				 				<div class="form-group form-group-center">
				 					<label for="PN" class="control-label col-lg-3">Package Name</label>
				 					<div class="col-lg-6">
				 						<input type="text" class="form-control" name="PN" id="PN">
				 					</div>
				 					<a href="javascript:void(0)" id="c_pack">Create New Package?</a>
				 				</div>				 				

				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-8">
				 						<button class="custom-btn" type="submit" id="btn_next" name="save">Next</button>
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

<script>
$(function(){
	$open_cpack=false;
	$("#c_pack").click(function(){
     $.ajax({
      url:'Delivery.php',
      success:function(data){
      	$open_cpack=true;
      	$("#subscribe_new_form")[0].reset();
 		$("#add_data_Modal").modal('hide');
 		$('#add_data_Modal').on('hidden.bs.modal', function () {
 			if($open_cpack)
 			{	
 				$('#CS').removeClass('active');
 				$('#Deli').addClass('active');
 				$('.main-chart').html(data)
 			}

		});
 		
      }
     });     
    });

});
</script>
