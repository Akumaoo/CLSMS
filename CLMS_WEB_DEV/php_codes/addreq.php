<?php 
require 'db.php';
if(!empty($_POST['dtype']))
{
	$sql="Insert Into Request_Sub(Subscription_Date,Subscription_End_Date) VALUES(?,?)";
	$query=sqlsrv_query($conn,$sql,array(NULL,NULL,NULL));
	if($query)
	{
		$scs['status']='success';
	}
	$getmax="Select Max(RequestID) as RequestID From Request_Sub";
	$maxquery=sqlsrv_query($conn,$getmax,array());
	$row=sqlsrv_fetch_array($maxquery,SQLSRV_FETCH_ASSOC);
	$num=$row['RequestID'];
	$scs['upid']=$num;
}
else
{
	$date_now=date('Y/m/d');
	$SED=$_POST['SED'];
	$sql="Insert Into Request_Sub(Subscription_Date,Subscription_End_Date) VALUES(?,?)";
	$query=sqlsrv_query($conn,$sql,array($date_now,$SED));
	if($query)
	{
		$scs['status']='success';
	}
	$getmax="Select Max(RequestID) as RequestID From Request_Sub";
	$maxquery=sqlsrv_query($conn,$getmax,array());
	$row=sqlsrv_fetch_array($maxquery,SQLSRV_FETCH_ASSOC);
	$num=$row['RequestID'];
	$scs['upid']=$num;

}
 header('Content-type: application/json');
 echo json_encode($scs);

 ?>