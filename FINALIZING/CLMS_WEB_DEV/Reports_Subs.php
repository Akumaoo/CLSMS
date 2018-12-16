<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';
 ?>
<div class="">
			<div class=" custom-upperbox">		
		         <div class="col-md-12 profile-text">      
          			<h2>College Library Serial Monitoring System</h2>
				</div>
			</div>

<div class=" custom-panelbox2">				
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
			<h4 class="fa fa-line-chart tag_style" style="color: black;"> Generate Reports: S.Y. [<?php echo $SY; ?>]:</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>
	
	<div class="">
	<div class=""  style="margin-top:70px;margin-left: 60px;">

			<div class="" >
				
				<div class="" style="padding:20px;">
		 			<form class=" form-horizontal style-form "  id="form_report" method="post" target="_blank">
		 				
		 				<div class="form-group form-group-center ">
		 					<label for="s_f" class="control-label col-lg-5">Sort/Filter: </label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="s_f" id="s_f" style="width: 135px" required>
		 							<option value=""></option>
		 							<option value="Sort">Sort</option>
		 							<option value="Filter">Filter</option>

		 						</select>
		 					</div>
		 				</div>

						<div id="sort_tab" class="collapse">
		 				<div class="form-group form-group-center">
		 					<label for="sort_by" class="control-label col-lg-5">Sort By: </label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="sort_by" id="sort_by" style="width: 135px">
		 							<option value=""></option>
		 							<option value="ASC">Ascending</option>
		 							<option value="DESC">Descending</option>

		 						</select>
		 					</div>
		 				</div>
		 				</div>

		 				<div class="form-group form-group-center">
		 					<label for="tb" class="control-label col-lg-5">Table:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown"  name="tb" id="dept_disb" style="width: 135px" required>
		 							<option value=""></option>
		 							<option value="Department">Department</option>
		 							<option value="Distributor">Distributor</option>
		 						</select>
		 					</div>
		 				</div>

						<div id="filter" class="collapse">
		 				<div class="form-group form-group-center">
		 					<label for="dt" class="control-label col-lg-5">Data:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="dt"  id="col_list" style="width: 135px">
		 						</select>
		 					</div>
		 				</div>
		 				</div>
						
						<div class="collapse" id="S_M">
		 				<div class="form-group form-group-center">
		 					<label for="org" class="control-label col-lg-5">Organization:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="org" id="org_list" multiple="multiple" style="width: 135px">
		 						</select>
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center">
		 					<label for="prog" class="control-label col-lg-5">Program:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="prog[]" id="prog_list" multiple="multiple" style="width: 135px;">
		 						</select>
		 					</div>
		 				</div>
		 				</div>	

		 				<div class="form-group form-group-center">
		 					<label for="t_r" class="control-label col-lg-5">Type Of Report:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" class="newdropdown" name="t_r" id="t_r" style="width: 135px" required>
		 							<option value=""></option>
		 							<option value="Subscriptions">S.Y. Subscriptions</option>
		 							<option value="OS">OnGoing Subscriptions</option>
		 							<option value="FS">Fulfilled Subscriptions</option>
		 							<option value="RT">Received Titles</option>
		 							<option value="DT">Delivered Titles</option>
		 						</select>
		 					</div>
		 				</div>
						
						<div id="hidden_date" class="collapse">
			 				<div class="form-group form-group-center">
			 					<label for="SD" class="control-label col-lg-5">Start Date:</label>
			 					<div class="col-lg-5">
			 						<input type="date" name="SD" id="SD" style="width: 135px;">
			 					</div>
			 				</div>

			 				<div class="form-group form-group-center">
			 					<label for="ED" class="control-label col-lg-5">End Date:</label>
			 					<div class="col-lg-5">
			 						<input type="date" name="ED" id="ED" style="width: 135px;">
			 					</div>
			 				</div>
		 				</div>

		 				<div class="form-group form-group-center">
		 					<label for="Reason" class="control-label col-lg-5">BondPaper Size:</label>
		 					<div class="col-lg-5">
		 						<select class="newdropdown" name="BP_size" id="bp" style="width: 135px" required>
		 							<option value=""></option>
		 							<option value="Letter">Letter</option>
		 							<option value="Legal">Legal</option>
		 							<option value="A4">A4</option>
		 						</select>
		 					</div>
		 				</div>					 				

		 				<div class="form-group form-group-center" style="margin-left:16px;">
		 					<div class="col-lg-offset-6">
		 						<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Confirm</button>
		 					</div>
		 				</div>
		 			</form>
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
<script src="Js/Reports_Sub.js?v=12" type="text/javascript"></script>';