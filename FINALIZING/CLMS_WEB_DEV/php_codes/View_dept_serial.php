<?php 

require 'db.php';


if(isset($_POST['S_ID']))
{
	function getID($name)
	{
		require 'db.php';
		$sql="Select SerialID from Serial Where SerialName=?";
		$query=sqlsrv_query($conn,$sql,array($name));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$id=$row['SerialID'];
			}
			return $id;
		}
		else
		{
			return 'NotValid';
		}
	}

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
				<h4 class="fa fa-book tag_style"> Categorize Serial: <strong id="sname">'.$_POST['S_ID'].'</strong></h4>
				<a href="javascript:void(0)" id="RCS"  style="font-size: 13px;margin-left: 10px;">Re-Categorize Serial!</a>
				<h4 class="dividerr"></h4>
			</div>
		</div>


		<div class="custom_table">

			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_CS">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Department</th>
						<th class="radio-label-center">Programs</th>
						<th class="radio-label-center">Total Delivered</th>
					</tr>
					</thead>
					<tbody>';

		echo '
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
	</div>';
}
?>
<div id="RCS_Modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Re-Categorize Serial: <strong id="sname"><?php echo $_POST['S_ID']; ?></strong></h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel">
						<form class="cmxform form-horizontal style-form" id="Re_Categorize_form" method="post">

						<div class="form-group ">
		 					<label class="control-label col-lg-12">*Note: Removing a serial on the current list will reset the Number Of Items Received of that specific Department</label>
		 				</div>

						<div class="form-group form-group-center">
		 					<label for="dept" class="control-label col-lg-3">Departments</label>
		 					<div class="col-lg-6">
		 						<?php
		 						$sql="SELECT * FROM Department WHERE Remove IS NULL";
		 						$query = sqlsrv_query($conn, $sql, array());
		 						if (sqlsrv_has_rows($query))
		 							{	
		 								echo "<ul>";
		 								$depts="";
		 								while ($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
		 										$depts.="<li><input type='checkbox' class='dept_list_post' name='dept' value='".$row['DepartmentID']."'>".$row['DepartmentID']."</li>";
		 								}
		 								echo $depts."</ul>";
		 							}
		 						?>			
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center collapse select_org_post" id="">
		 					<label for="org" class="control-label col-lg-3">Organizations</label>
		 					<div class="col-lg-6">
		 						<ul class="org_list_post">
		 						</ul>
		 					</div>
		 				</div>

		 				<div class="form-group form-group-center collapse select_prog_post" id="">
		 					<label for="prog" class="control-label col-lg-3">Programs</label>
		 					<div class="col-lg-6">
		 						<ul>
		 							<ul class="prog_list_post" style="padding: 0">
		 							</ul>
		 						</ul>
		 					</div>
		 				</div>


						<div class="form-group form-group-center" id="save_btn">
							<div class="col-lg-offset-8">
								<button class=" custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
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

<script type="text/javascript" src="Js/View_dept_ser.js?v=13"></script>