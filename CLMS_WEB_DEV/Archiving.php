<?php
require 'php_codes/db.php';
echo '
<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class=" custom-panelbox">
	<div class="">
		<div class="">
			<h4 class="fa fa-archive tag_style">Archiving:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_archive">
	    <strong>Successfully Archived Data</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_archive">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

  	<div class="alert alert-warning alert-dismissible collapse center" id="msg_warning_archive">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>	
  
	<div class=" custom_table">
		<div class="col-lg-10 col-lg-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">SubscriptionID</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">Received</th>
				<th class="radio-label-center">Subscription Date</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';
echo '
</tbody>
</table>
</div>
</div>
	<div class="">
		<div class="col-lg-offset-9">
			<button type="button" id="archive_btn" data-toggle="modal" class="custom-btn">Archive Now!</button>
		</div>
	</div>
</div>
</div>';
include 'Modals/Verify_Archiving_Modal.php';
?>
<script type="text/javascript" src="Js/Archive_main.js"></script>

