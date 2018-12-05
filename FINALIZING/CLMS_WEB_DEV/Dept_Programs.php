<?php
require 'php_codes/db.php';

if(isset($_POST['dept']))
{
	$dept=$_POST['dept'];	
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
			<h5 class="fa fa-university tag_style"> Organizations: [<span id="dept_n"><?php echo $dept; ?></span>]</h5>
			<h4 class="dividerr"></h4>
		</div>

		<div class="custom_table">

			<div class="container-fluid">
			<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_dept_program">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Organization</th>
						<th class="radio-label-center">Programs</th>
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
<script type="text/javascript" src="Js/dept_program.js?v=12" ></script>