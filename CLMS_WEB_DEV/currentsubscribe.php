<?php
require 'php_codes/db.php';

if(isset($_POST['dname']))
{
	$dn=$_POST['dname'];
	$req=$_POST['req'];
	
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
			<h4 class="fa fa-handshake-o tag_style"> Manage Subscription: <strong id="disbn"><?php echo $dn;?></strong> Subscription Date:(<span id="rid"><?php echo $req; ?></span>)</h4>
			<h4 class="dividerr"></h4>
		</div>
	
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_enter">
	    <strong>Successfully Update Subscriptions!</strong>
 	 </div>

 	 <div class="alert alert-success alert-dismissible collapse center" id="msg_deliv_enter">
	    <strong>Successfully Received Delivery And Send Titles To Departments!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_enter">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>	
  
	<div class=" custom_table">

		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
			<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">SubscriptionID</th>
					<th class="radio-label-center">Serial</th>
					<th class="radio-label-center">Frequency</th>
					<th class="radio-label-center">Cost</th>
					<th class="radio-label-center">Status</th>
					<th class="radio-label-center">Phase</th>
					<th class="radio-label-center">Initial Delivery Date</th>
					<th class="radio-label-center">Subscription End Date</th>
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
	<div id="Activate_btn">
		<div class="col-lg-offset-9">
			<button type="button" id="SN" data-toggle="modal" data-target="#add_data_Modal_activate" class="custom-btn">Activate Subscription!</button>
		</div>
	</div>
</div>
</div>
<?php
include 'Modals/activate_Pre-Subs_Modal.php';
include 'Modals/Receive_Ser_Deliv_Modal.php';
?>
<script type="text/javascript" src="Js/Subscription_main.js?v=.23334332"></script>

