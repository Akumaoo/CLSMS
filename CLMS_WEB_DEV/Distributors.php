<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-building tag_style"> Manage Distributors:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Distributor!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , <span class="failmsg">Please Check The Values You Entered And Try Again.</span>
  	</div>

	<div class="custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_disb">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Distributor ID</th>
					<th class="radio-label-center">Distributor Name</th>
					<th class="radio-label-center">Name Of Incharge</th>
					<th class="radio-label-center">Contact Number</th>
					<th class="radio-label-center">Email</th>


				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		
	</div>

		<div class="">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_Distributor_data_Modal" class="custom-btn">New Distributor</button>
			</div>
		</div>
	</div>
</div>
<?php 
include 'Modals/New_Distributor_Modal.php'
 ?>

<script type="text/javascript" src="Js/Distributors_main.js"></script>