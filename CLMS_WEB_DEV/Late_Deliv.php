<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';
if(isset($_POST['disb']))
{
	$disb=$_POST['disb'];
	$phase=$_POST['phase'];
}
else
{
	$disb="";
	$phase="";
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
			<h5 class="fa fa-exclamation-triangle tag_style"> Late Delivery: <span id="disb"><?php echo $disb; ?></span><span id="phase" hidden><?php echo $phase ?></span></h5>
			<h4 class="dividerr"></h4>
		</div>

		<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_enter">
	    <strong>Successfully Update Subscriptions!</strong>
 	 	</div>

 	 	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_enter">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  		</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_late_deliv">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Subscription ID</th>
						<th class="radio-label-center">Distributor Name</th>
						<th class="radio-label-center">Serial Name</th>
						<th class="radio-label-center">Initial Delivery Date</th>
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
</div>
<?php 
include 'Includes/footer.php';
 ?>
</body>
</html>
<script type="text/javascript" src="Js/Late_Deliv.js?v=21" ></script>