<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>
			
<div class="customrow custom-panelbox">			
	<div class="">
		<div class="">
			<h5 class="fa fa-university tag_style"> Departments:</h5>
			<h4 class="dividerr"></h4>
		</div>
	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Successfully Added Department!</strong> , Please Reload The Page To Update The Table.
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	    <strong>Something Went Wrong!</strong> , <span class="failmsg">Please Check The Values You Entered And Try Again.</span>
  	</div>

		<div class="custom_table">
			<div class="col-lg-10 col-lg-offset-1">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_dept">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Department ID</th>
						<th class="radio-label-center">Department Name</th>
					</tr>
					</thead>
					<tbody>
						<?php 
							require 'php_codes/db.php';
							$sql="Select * from Department";
							$query=sqlsrv_query($conn,$sql,array());
							if(sqlsrv_has_rows($query))
							{
								while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
								{
									$id=$row['DepartmentID'];
									$name=$row['DepartmentName'];

									echo '
										<tr class="gradeU">
											<td class="radio-label-center">'.$id.'</td>
											<td class="radio-label-center">'.$name.'</td>																	
										</tr>
									';
								}
							}
						 ?>
					</tbody>
				</table>
			</div>
		</div>

			<div class="">
				<div class="col-lg-offset-9">
					<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_Department_data_Modal" class="custom-btn">New Department</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
include 'Modals/New_Department_modal.php'
 ?>

<script type="text/javascript" src="Js/dept_main.js?v=2" ></script>