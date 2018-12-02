<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';
if(isset($_POST['dept']))
{
	$dept=$_POST['dept'];
}
else
{
	$dept="";
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
			<h5 class="fa fa-paper-plane tag_style"> Received Serial: <span id="dept"><?php echo $dept; ?></span></h5>
			<h4 class="dividerr"></h4>
		</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_RS_notif">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">RS ID</th>
						<th class="radio-label-center">Department</th>
						<th class="radio-label-center">Program</th>
						<th class="radio-label-center">Serial Name</th>
						<th class="radio-label-center">Serial Type</th>
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
<script type="text/javascript" src="Js/RS_NOTIF.js?v=2311" ></script>