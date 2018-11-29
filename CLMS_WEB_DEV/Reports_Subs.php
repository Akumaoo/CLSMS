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

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<?php 
				$date_today=date('Y-m-d');
				$year_today=date('Y');
				$sub_year=$year_today.'-08-01';
				if($date_today<date('Y-m-d',strtotime($sub_year)))
				{
					$SY=date('Y',strtotime('-1 year',strtotime($year_today))).'-'.$year_today;
				}
				else
				{
					$SY=$year_today.'-'.date('Y',strtotime('+1 year',strtotime($year_today)));
				}
			 ?>
			<h4 class="fa fa-handshake-o tag_style"> Subscriptions: S.Y. [<?php echo $SY; ?>]:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Added New Serial!</strong>
 	 </div>

 	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
    	<strong>Successfully Removed Serial!</strong>
 	</div>

 	 <div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
	    <strong>Successfully Updated Serial!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class=" custom_table">
	
		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="Reports_Sub">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Distributor</th>
					<th class="radio-label-center">Title</th>
					<th class="radio-label-center">Vol #</th>
					<th class="radio-label-center">Issue #</th>
					<th class="radio-label-center">Date Of Issue</th>
					<th class="radio-label-center">Department</th>
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
<script src="Js/Reports_Sub.js?v=2" type="text/javascript"></script>';