<?php 
require 'php_codes/staff_verify.php';
include 'Includes/header.php';
 ?>
<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
					<?php 
					$dept=$_SESSION['Dept'];
					echo '<strong id="dept" hidden>'.$dept.'</strong>';
					 ?>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-book tag_style"> Subscribed Serials:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Updated Serial Usage!</strong> 
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong>, Please Check The Data You've Inputted
  	</div>

	<div class=" custom_table">

		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Category ID</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Serial Type</th>
					<th class="radio-label-center">Status Of Delivery</th>
					<th class="radio-label-center">Usage</th>
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
	  include 'Includes/footer.php';
?>
</body>
</html>
<script src="Js/manage_serials_RBAC_staff.js?v=32" type="text/javascript"></script>'