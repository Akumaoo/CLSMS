<div id="add_data_Modal_next" class="modal fade">
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
						<form class="cmxform form-horizontal style-form" id="subscribe_new_form" method="post">

						<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
						    <strong>Successfully Subscribed!</strong>
					 	 </div>

					  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
						    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
					  	</div>

						<div class="form-group form-group-center">
							<label for="Serial" class="control-label col-lg-3">Serial Name</label>
							<div class="col-lg-6">
								<input type="text" class="form-control" name="Serial" id="SNf">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Freq" class="control-label col-lg-3">Frequency</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Freq" id="Freq">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Cost" class="control-label col-lg-3">Cost</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Cost" id="Cost">
								<input type="hidden" class="form-control" name="Disb" id="Disb_N">
								<input type="hidden" class="form-control" name="PN" id="Pack_N">
							</div>
						</div>

						<hr class="theme_hr">

						<div class="form-group form-group-center">
							<label for="DOI" class="control-label col-lg-3">Date Of Issue</label>
							<div class="col-lg-6">
								<input type="date" class="form-control" name="DOI" id="DOI">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="IN" class="control-label col-lg-3">Issue Number</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="IN" id="IN">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="VN" class="control-label col-lg-3">Vol. Number</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="VN" id="VN">
							</div>
						</div>

						<div class="form-group form-group-center">
							<label for="Copy" class="control-label col-lg-3">Serial Copies</label>
							<div class="col-lg-6">
								<input type="number" class="form-control" name="Copy" id="Copy">
							</div>
						</div>




						<div class="form-group form-group-center" id="save_btn">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
							</div>
						</div>

						<div class="form-group form-group-center collapse" id="retry">
							<div class="row">
								<div class="col-lg-12">
									<h4 style="margin-left:20px;">Continue?</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-lg-offset-3">
									<button class=" custom-btn" type="button" id="btn_yes">Yes</button>
								</div>
								<div class="col-lg-offset-5">
									<button class=" custom-btn" type="button" id="btn_no">No</button>
								</div>
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

		$('#subscribe_new_form').on('submit',function(event){
		event.preventDefault();

		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var output_date_today = d.getFullYear() + '/' +
		    (month<10 ? '0' : '') + month + '/' +
		    (day<10 ? '0' : '') + day;

	 	if($("#SNf").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if($("#Freq").val()=="")
	 	{
	 		alert("Frequency Is Required");
	 	}
	 	else if($("#Cost").val()=="")
	 	{
	 		alert("Cost Is Required");
	 	}
	 	else if(new Date($('#DOI').val())<=new Date(output_date_today))
	 	{
	 		alert("Date Of Issue Is Past The Date Today");
	 	}
	 	else if($("#PN").val()=="")
	 	{
	 		alert("Package Name Is Required");
	 	}
	 	else if($("#Copy").val()=="")
	 	{
	 		alert("Number Of Copies Is Required");
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/Insert_New_Subscription.php",
	 			method:"POST",
	 			data:$("#subscribe_new_form").serialize(),
	 			success:function(data)
	 			{
 					
 					if(data.status=='success')
 					{

 						$("#msg_scs").removeClass('collapse');
 						$('#save_btn').addClass('collapse');
 						$('#retry').removeClass('collapse');

 					}
 					else
 					{
 						$("#msg_fail").removeClass('collapse');
 					}

	 			}
	 		});
	 	}
	});

	$('#btn_yes').click(function(){
		$("#msg_scs").addClass('collapse');
		$("#subscribe_new_form")[0].reset();
		$('#save_btn').removeClass('collapse');
 		$('#retry').addClass('collapse');
	});
	$('#btn_no').click(function(){
		$("#subscribe_new_form")[0].reset();
		$("#first_step")[0].reset();
		$('#add_data_Modal_next').modal('hide');
	});

	});
</script>

