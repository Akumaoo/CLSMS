<?php 
require 'php_codes/admin_verify.php';
include 'Includes/header.php';

if(isset($_POST['pass']))
{	
	require 'php_codes/db.php';
	$pass=md5($_POST['pass']);
	$usern=$_SESSION['current_user'];

	$sql="Select Password from [User] Where UserName=?";
	$query=sqlsrv_query($conn,$sql,array($usern));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$ret_pass=$row['Password'];


	if($pass===$ret_pass)
	{
		$_SESSION['verif_rb']='Verified';
	}
	else
	{
		$_SESSION['notverif']='NotVerified';
	}
}

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
			<h4 class="fa fa-recycle tag_style"> Recycle Bin:</h4>
			<?php 
				if(isset($_SESSION['verif_rb']))
				{
					echo '
						<button class="custom-btn btn-active" type="button" id="rb_ser" style="height: 30px;width: 69px;padding:0">Serials</button>
					 	<button class="custom-btn" type="button" id="rb_disb" style="height: 30px;width: 99px;padding:0;margin-left: 2px">Distributors</button>
					 	<button class="custom-btn" type="button" id="rb_dept" style="height: 32px;width: 102px;padding:0;margin-left: 2px">Departments</button>
					 	<button class="custom-btn" type="button" id="rb_user" style="height: 32px;width: 66px;padding:0;margin-left: 2px">Users</button>
					 	<button class="custom-btn" type="button" id="rb_ps" style="height: 32px;width: 118px;padding:0;margin-left: 2px">Pending Serials</button>
					 	<button class="custom-btn" type="button" id="rb_subs" style="height: 32px;width: 118px;padding:0;margin-left: 2px">Subscriptions</button>
					';
				}
			 ?>
			<h4 class="dividerr"></h4>
		</div>
	</div>


 	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs_remove">
    	<strong>Successfully Removed Data's!</strong>
 	</div>

 	 <div class="alert alert-success alert-dismissible collapse center" id="msg_scs_update">
	    <strong>Successfully Retrieved Data's!</strong>
 	 </div>
	
	<?php 
	if(isset($_SESSION['notverif']))
	{
		echo '

		<div class="alert alert-danger alert-dismissible center">
	   		 <strong>Incorrect Password!</strong>
  		</div>
		';

		unset($_SESSION['notverif']);
	}

	if(!isset($_SESSION['verif_rb']))
	{
		echo '
		<div id="verif_rb" class="form form_custom" style="margin-top: 8%;">
			<form method="POST" class="cmxform form-horizontal style-form">

				<div class=" form-group-center">
					<label for="password" class="control-label" style="float:left;margin-left: 25%;font-size: 16px">Enter Password:</label>
					<div style="float: left;margin-left:13px;">
						<input class="form-control" type="password" style="width: 190px;height: 32px;" placeholder="Password" name="pass">
					</div>
					<button class="custom-btn" type="submit" value="save" name="save" style="height: 32px; width: 69px;padding:0;float:left;margin-left: 10px;font-size: 12px">Submit</button>
				</div>
			</form>
		</div>
		';
	}
	else
	{
		unset($_SESSION['verif_rb']);
	echo '
 	<div class=" custom_table">
	
		<div class="container-fluid">

		<div class="row" id="col_serials">
			<div class="col-lg-10 col-lg-offset-1">
				<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>
				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_MS">
					<thead class="thead_theme">
					<tr>
						<th class="radio-label-center">Serial ID</th>
						<th class="radio-label-center">Serial Name</th>
						<th class="radio-label-center">Type</th>
						<th class="radio-label-center">Origin</th>
						<th class="radio-label-center">Remarks</th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
				<button class="custom-btn collapse" id="PRS" style="float: left;height: 43px;margin-left: 0">Permanently Remove Selected</button>
				<button class="custom-btn collapse" id="RS" style="float: right;height: 43px;">Retrieve Selected</button>
			</div>
		</div>


		</div>
		
	</div> ';

	}
 	?> 


 	
		
</div>
</div>
<?php
  include 'Includes/footer.php';
	   
?>
</body>
</html>
<script src="Js/recycle_bin.js?v=1" type="text/javascript"></script>';