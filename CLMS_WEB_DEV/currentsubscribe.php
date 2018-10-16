<?php
require 'php_codes/db.php';

if(isset($_POST['dname']))
{
	function getDType($namae)
	{
		require 'php_codes/db.php';
		$sql="Select Distributor_Type from Distributor Where DistributorName=?";
		$query=sqlsrv_query($conn,$sql,array($namae));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$type=$row['Distributor_Type'];
		return $type;
	}
	$dn=$_POST['dname'];
	$req=$_POST['req'];
	$dtype=getDType($dn);
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
				<h4 class="fa fa-handshake-o tag_style"> Manage Subscription: <strong id="disbn">'.$dn.'</strong> Subscription Date:(<span id="rid">'.$req.'</span>)</h4>
				<h4 class="dividerr"></h4>
			</div>
		</div>
		
		<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_enter">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Successfully Update Subscriptions!</strong>
	 	 </div>

	  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_enter">
		    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
	  	</div>	
	  
		<div class=" custom_table">
			<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_subs" ">
			<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">SubscriptionID</th>
					<th class="radio-label-center">Serial</th>
					<th class="radio-label-center">Frequency</th>
					<th class="radio-label-center">Cost</th>
					<th class="radio-label-center">Received</th>
					<th class="radio-label-center">Status</th>
					<th class="radio-label-center">Phase</th>
					<th class="radio-label-center">Initial Delivery Date</th>
					<th class="radio-label-center">Subscription End Date</th>
				</tr>
			</thead>
			<tbody>';
	echo '
	</tbody>
	</table>
	</div>
	</div>';

	if($dtype=="PRE-PAID")
	{
		echo '			
		<div id="Activate_btn" class="">
			<div class="col-lg-offset-9">
				<button type="button" id="SN" data-toggle="modal" data-target="#add_data_Modal_activate" class="custom-btn">Activate Subscription!</button>
			</div>
		</div>
		';
	}

	echo '
	</div>
	</div>';
}
include 'Modals/activate_Pre-Subs_Modal.php';
?>
<script type="text/javascript" src="Js/Subscription_main.js?v=.666"></script>

