<?php 
require 'db.php';
if($_POST['action']=='confirm')
{
	$cp=$_POST['cp'];
	$uID=$_POST['uID'];
	$sql="Select Password from [User] Where UserID=?";
	$query=sqlsrv_query($conn,$sql,array($uID));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$pass=$row['Password'];

	if(md5($cp)==$pass)
	{
		$scs['status']='success';
		$scs['new_data']='		<form class="cmxform form-horizontal style-form" id="reset_pass_2step" method="post">
				 				<div class="form-group form-group-center">
				 					<label for="New_pass" class="control-label col-lg-5">New Password</label>
				 					<div class="col-lg-5">
				 						<input type="password" class="form-control" name="New_pass" required id="New_pass">
				 					</div>
				 				</div>

				 				<div class="form-group form-group-center">
				 					<label for="confirm_pass" class="control-label col-lg-5">Confirm Password</label>
				 					<div class="col-lg-5">
				 						<input type="password" class="form-control" name="confirm_pass" required id="confirm_pass">
				 					</div>
				 				</div>
				 				

				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-8">
				 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save">Save</button>
				 					</div>
				 				</div>
				 			</form>
							<script src="Js/reset_p2.js?v=3" type="text/javascript"></script>
				 			';
	}
	else
	{
		$scs['status']='fail';
	}

}
else if($_POST['action']=='reset')
{
	$pass=$_POST['np'];
	$uID=$_POST['uID'];

	$newpass=md5($pass);
	$sql="Update [User] Set Password=? Where UserID=?";
	$query=sqlsrv_query($conn,$sql,array($newpass,$uID));
	if($query)
	{
		$scs['status']='success';
	}
	else
	{
		$scs['status']='fail';
	}
}

header('Content-type: application/json');
echo json_encode($scs);


 ?>