<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$PID=$input['PackageID'];
$Pname=$input['PackageName'];
$RD=$input['ReceiveDate'];
$ERD=$input['ExpectedReceiveDate'];

if($input['action']=='edit')
{
	$sql="Update Package_Delivery Set PackageName=?,ReceiveDate=?,ExpectedReceiveDate=? Where PackageID=?";
	$query=sqlsrv_query($conn,$sql,array($Pname,$RD,$ERD,$PID),$opt);

}
else if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM Package_Delivery Where PackageID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($PID),$opt);
}

echo json_encode($input);

 ?>
