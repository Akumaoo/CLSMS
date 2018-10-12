<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-paper-plane tag_style"> Send Serials:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Send Serial!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_SS">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">RS ID</th>
					<th class="radio-label-center">Department Name</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type</th>
					<th class="radio-label-center">Date Send</th>
					<th class="radio-label-center">Seen</th>
					<th class="radio-label-center">Status</th>
				</tr>
				</thead>
				<tbody>				
				</tbody>
			</table>
		</div>
		
	</div>

		<div class="">
			<div class="col-lg-offset-9">
				<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#Send_Serial_Modal" class="custom-btn">Send New Serial!</button>
			</div>
		</div>
	</div>
</div>

<?php 
	include 'Modals/Send_serial_modal.php';
?>
<script type="text/javascript" src="Js/Send_serial_main.js"></script>

