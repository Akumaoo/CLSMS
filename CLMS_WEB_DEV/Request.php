<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';

 ?>
<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>
			
<div class="row custom-panelbox">			
	<div class="">
		<div class="">
			<h4 class="fa fa-truck tag_style "> Manage Subscription:</h4>
			<a href="javascript:void(0)" id="subs"  style="font-size: 13px;margin-left: 10px;">Subscribe Now!</a>
			<h4 class="dividerr"></h4>
		</div>

	<div class="custom_table" >
		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_req">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Distributor</th>
					<th class="radio-label-center">Subscription Date</th>
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
<?php 
	include 'Modals/Add_Subscription_Modal.php';
	include 'Modals/Add_Subscription_Modal_Firststep.php';
	include 'Modals/Add_Subscription_Modal_secondstep.php';
	include 'Modals/Add_Subscription_Modal_secondstep_POST.php';
	include 'Includes/footer.php';
 ?>
</body>
</html>
<script type="text/javascript" src="Js/request_main.js?v=0.166"></script>