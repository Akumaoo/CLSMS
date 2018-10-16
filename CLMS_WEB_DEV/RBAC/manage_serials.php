<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
					<?php 
					session_start();
					$dept=$_SESSION['Dept'];
					echo '<strong id="dept" hidden>'.$dept.'</strong>';
					 ?>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-plus-square tag_style"> Serials:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Serial!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class=" custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Serial ID</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type</th>
				</tr>
				</thead>
				<tbody>
				
				</tbody>
			</table>
		</div>
		
	</div>
</div>
</div>
<script src="Js/manage_serials_RBAC_staff.js?v=2" type="text/javascript"></script>'