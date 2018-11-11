<?php 

require 'db.php';

$dID=$_POST['id'];
$type_array=array('Finished','OnGoing','Cancelled','Refunded');
$val=array();

for($x=0;$x<count($type_array);$x++)
{
	$sql="Select Count(*) as total_ref From Subscription Where DistributorID=? AND Status=? AND Archive IS NULL";
	$query=sqlsrv_query($conn,$sql,array($dID,$type_array[$x]));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$val[$x]=$row['total_ref'];
}

header('Content-type: application/json');
echo json_encode($val);
 ?>