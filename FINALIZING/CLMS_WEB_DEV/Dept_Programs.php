<?php
require 'php_codes/db.php';

if(isset($_POST['dept']))
{
	$dept=$_POST['dept'];	
}
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
			<h5 class="fa fa-university tag_style"> Organizations: [<span id="dept_n"><?php echo $dept; ?></span>]</h5>
			<h4 class="dividerr"></h4>
		</div>

		<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
    		<strong>Successfully Updated Organization!</strong>
	 	</div>

	 	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
	    	<strong>Successfully Removed Organization!</strong>
	 	</div>

	  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
		    <strong>Something Went Wrong!</strong> , <span id="fail_msg">Please Check The Values You Entered And Try Again.</span>
	  	</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_dept_program">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Organization</th>
						<th class="radio-label-center">Programs</th>
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
include 'Modals/remove_modal.php';
include 'Modals/Re_categ_Org.php';
 ?>
<script type="text/javascript" src="Js/dept_program.js?v=132" ></script>