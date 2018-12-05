<?php 
require 'php_codes/staff_verify.php';
include 'Includes/header.php';

require 'php_codes/db.php';
$sqltype="Select Count(*) as nums from Department INNER Join Organization ON Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
$querytype=sqlsrv_query($conn,$sqltype,array($_SESSION['Dept']));
$row=sqlsrv_fetch_array($querytype,SQLSRV_FETCH_ASSOC);
$datatype=$row['nums'];

if($datatype==0)
{
  $type='Single';
}
else
{
  $type='Multiple';
}
 ?>
<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
					<?php 
					$dept=$_SESSION['Dept'];
					echo '<strong id="dept" hidden>'.$dept.'</strong>';
					 ?>
				</div>
			</div>

<div class=" custom-panelbox">				
	<div class="">
		<div class="">
			<h4 class="fa fa-book tag_style"> Subscribed Serials:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Updated Serial Usage!</strong> 
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong>, Please Check The Data You've Inputted
  	</div>

	<div class=" custom_table">

		<div class="container-fluid">
		<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
			<span class="fa fa-print fa-lg cog_action" id="gen_rep"></span>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
				<thead class="thead_theme">
					<?php 
					if($datatype=='Single')
					{
						echo '
							<tr>
								<th class="radio-label-center">Category ID</th>
								<th class="radio-label-center">Serial Name</th>
								<th class="radio-label-center">Serial Type</th>
								<th class="radio-label-center">Subscription Status</th>
								<th class="radio-label-center">Status Of Delivery</th>
								<th class="radio-label-center">Usage</th>
							</tr>
						';
					}
					else
					{
						echo '
							<tr>
								<th class="radio-label-center">Category ID</th>
								<th class="radio-label-center">Program</th>
								<th class="radio-label-center">Serial Name</th>
								<th class="radio-label-center">Serial Type</th>
								<th class="radio-label-center">Subscription Status</th>
								<th class="radio-label-center">Status Of Delivery</th>
								<th class="radio-label-center">Usage</th>
							</tr>
							';
					}
					 ?>
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
	  include 'Modals/Print_modal.php';
	  include 'Includes/footer.php';
?>
</body>
</html>
<script src="Js/manage_serials_RBAC_staff.js?v=3212" type="text/javascript"></script>'