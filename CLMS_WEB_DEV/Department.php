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
			
<div class="custom-panelbox">			
	<div class="">
		<div class="">
			<h5 class="fa fa-university tag_style"> Departments:</h5>
			<a href="javascript:void(0)" data-toggle="modal" data-target="#add_Department_data_Modal"  style="font-size: 13px;margin-left: 10px;">New Department</a>
			<h4 class="dividerr"></h4>
		</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
    	<strong>Successfully Updated Department!</strong>
 	</div>

 	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
    	<strong>Successfully Removed Department!</strong>
 	</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Added Department!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , <span class="failmsg">Please Check The Values You Entered And Try Again.</span>
  	</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_dept">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Department</th>
						<th class="radio-label-center">Organizations</th>
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
</div>
<?php 
include 'Modals/New_Department_modal.php';
include 'Modals/remove_modal.php';
include 'Includes/footer.php';

 ?>
</body>
</html>
<script type="text/javascript" src="Js/dept_main.js?v=2" ></script>