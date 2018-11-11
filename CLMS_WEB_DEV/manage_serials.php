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
			<h4 class="fa fa-plus-square tag_style"> Serials:</h4>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#Add_Serial_Modal"  style="font-size: 13px;margin-left: 10px;">Add New Serial</a>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Added New Serial!</strong>
 	 </div>

 	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
    	<strong>Successfully Removed Serial!</strong>
 	</div>

 	 <div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
	    <strong>Successfully Updated Serial!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class=" custom_table">
	
		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Serial ID</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type</th>
					<th class="radio-label-center">Origin</th>
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
<?php include 'Modals/Add_Serial_Modal.php';
	  include 'Includes/footer.php';
?>
</body>
</html>
<script src="Js/manage_serials_RBAC.js?v=233633333933" type="text/javascript"></script>';