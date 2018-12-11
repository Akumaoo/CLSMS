<?php
require 'php_codes/db.php';
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
		<h5 class="fa fa-archive tag_style" style="color: black;"> Archiving:</h5>
		<a href="javascript:void(0)" id="archive_btn"  style="font-size: 13px;margin-left: 10px;">Archive Now</a>
		<h4 class="dividerr"></h4>
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
		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
		<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">SubscriptionID</th>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">School Year</th>
				<th class="radio-label-center">Status</th>
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
include 'Modals/Verify_Archiving_Modal.php';
include 'Includes/footer.php';
?>
</body>
</html>
<script type="text/javascript" src="Js/Archive_main.js?v=2"></script>

