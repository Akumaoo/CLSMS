<?php 
$serialname=$_POST['sername'];
	$dept=$_POST['depts'];
	$type=$_POST['stype'];

	header('Content-type: application/json');
	echo json_encode($type);

 ?>