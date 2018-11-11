<?php
require 'php_codes/db.php';
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
			<h5 class="fa fa-area-chart tag_style">Generate Report:</h5>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="progress">
				  <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Step 1</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-offset-3 col-lg-6">
				<div class="content-text">
					<h5>Choose The Tables You Want To Include Into The Report.</h5>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-offset-3 col-lg-5">
				<div class="Selection">
					<div class="container-fluid">
						
						<div class="select_panel">

						<div class="row">
							<div class="col-lg-5 col-lg-offset-2 input_select" id="deliv">
								<input  type="checkbox" >
								<label>Delivery</label>
							</div>
							<div class="col-lg-5 input_select" id="Dept">
								<input  type="checkbox" >
								<label>Department</label>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-5 col-lg-offset-2 input_select" id="Dist">
								<input  type="checkbox" >
								<label>Distributor</label>
							</div>
							<div class="col-lg-5 input_select" id="RS">
								<input  type="checkbox" >
								<label>Receive Serial</label>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-5 col-lg-offset-2 input_select" id="Ser">
								<input  type="checkbox" >
								<label>Serial</label>
							</div>
							<div class="col-lg-5 input_select" id="Subs">
								<input  type="checkbox" >
								<label>Subscription</label>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-5 col-lg-offset-2 input_select" id="CS">
								<input  type="checkbox">
								<label>Categorize Serial</label>
							</div>
						</div>

						</div>

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
<script type="text/javascript" src="Js/Flex_Report_S1.js"></script>

