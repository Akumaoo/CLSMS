<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';
 ?>
<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-building tag_style" style="color: black;"> Manage Distributors:</h4>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#add_Distributor_data_Modal" style="font-size: 13px;margin-left: 10px;">Add New Distributor</a>

			<h4 class="dividerr"></h4>
		</div>
	</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
	    <strong>Successfully Updated Distributor!</strong>
 	 </div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
		<strong>Successfully Removed Distributor!</strong>
 	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Added Distributor!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , <span id="fail_msg">Please Check The Values You Entered And Try Again.</span>
  	</div>

	<div class="custom_table">
	
		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">	
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>								
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_disb">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Distributor ID</th>
					<th class="radio-label-center">Distributor Name</th>
					<th class="radio-label-center">Name of Incharge</th>
					<th class="radio-label-center">Contact Number</th>
					<th class="radio-label-center">Email</th>


				</tr>
				</thead>
				<tbody>
				</tbody>

			</table>


		</div>
		</div>
		</div>
		
	</div>
	</div>
</div>
<?php 
include 'Modals/New_Distributor_Modal.php';
include 'Modals/remove_modal.php';
include 'Includes/footer.php';
 ?>
</body>
</html>
<script type="text/javascript" src="Js/Distributors_main.js?v=1"></script>