
<div id="Print_Modal" class="modal fade">
	<div class="modal-dialog" style="margin-top:160px;">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Generate Report</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel" style="padding: 20px">
				 			<form class="cmxform form-horizontal style-form" id="form_report" method="post" target="_blank">
				 				
				 				<?php
				 				$getype="Select Count(*) as nums from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Where  Department.DepartmentID=?";
				 				$typequery=sqlsrv_query($conn,$getype,array($_SESSION['Dept']));
				 				$row=sqlsrv_fetch_array($typequery,SQLSRV_FETCH_ASSOC);
				 				$rowdata=$row['nums'];

				 				if($rowdata>0)
				 				{
				 					$type='Multiple';
				 				}
				 				else
				 				{
				 					$type='Single';
				 				}

				 					if($type!='Single')
				 					{
				 						echo '
											<div class="form-group form-group-center select_org_post " id="">
		 										<label for="org" class="control-label col-lg-5">Organizations</label>
							 					<div class="col-lg-5">
							 						<ul class="org_list_post" style="padding:0">
							 						</ul>
							 					</div>
							 				</div>
				 						';
				 					}		

				 				  ?>

				 				<div class="form-group form-group-center">
				 					<label for="BP_size" class="control-label col-lg-5">BondPaper Size:</label>
				 					<div class="col-lg-5">
				 						<select name="BP_size" id="bps" style="width: 135px">
				 							<option value="Letter">Letter</option>
				 							<option value="Legal">Legal</option>
				 							<option value="A4">A4</option>
				 						</select>
				 						<input type="hidden" name="Dept" id="dept" value=<?php echo $dept; ?>>
				 					</div>
				 				</div>				 				
								
								<p style="text-align: left;color:#3C3838;margin-left:60px;">**NOTE**
								<?php
				 					if($type!='Single')
				 					{
				 						echo '
											<br><span style="margin-left: 20px">-Leave The Checkbox Unchecked If You Want To Select All Programs.</span>
				 						';
				 					}		

				 				 ?>
				 				<br><span style="margin-left: 20px">-Leave The Start/End Date Empty If You Don't Want A Date Range.</span>
				 				</p>
				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-7">
				 						<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Confirm</button>
				 					</div>
				 				</div>
				 			</form>
			 			</div>
			 		</div>
			 	</div><!--row-->
			 </div><!--container-->
			</div><!--modal-body-->
		</div>
	</div>
</div>

