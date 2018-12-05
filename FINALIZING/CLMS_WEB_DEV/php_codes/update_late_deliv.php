<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$Sid=$input['SubscriptionID'];
$IDD=$input['InitialDeliveryDate'];
$stat=$input['Status'];
// $Sid=2244;
// $IDD='2017-1-1';
// $stat='OnGoing';
if(isset($IDD))
{
	$sql="Update Subscription Set InitialDeliveryDate=?,Status=? Where SubscriptionID=?";
	$query=sqlsrv_query($conn,$sql,array($IDD,$stat,$Sid));

	if($query)
	{
		echo json_encode($input);
	}
}



 ?>