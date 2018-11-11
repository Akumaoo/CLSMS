<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';
if(isset($_POST['dept']))
{
	$dept=$_POST['dept'];
	$date=$_POST['date'];
}
else
{
	$dept="";
	$date="";
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
			<h5 class="fa fa-spinner tag_style"> Pending Serial: <span id="dept"><?php echo $dept; ?></span><span id="date" hidden><?php echo $date ?></span></h5>
			<h4 class="dividerr"></h4>
		</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_pending_ser">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">RS ID</th>
						<th class="radio-label-center">Department</th>
						<th class="radio-label-center">Serial Name</th>
						<th class="radio-label-center">Serial Type</th>
						<th class="radio-label-center">Date Sent</th>
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
<script type="text/javascript" src="Js/Pending_Serials.js?v=231" ></script>