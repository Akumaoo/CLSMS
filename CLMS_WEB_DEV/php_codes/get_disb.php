<?php 
	require 'db.php';
	$id=[];
	$inc=0;
	$sql="Select DistributorName from Distributor";
	$query=sqlsrv_query($conn,$sql,array());
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$id[$inc]=$row['DistributorName'];
			$inc++;
		}
	}
	header('Content-type: application/json');
	echo json_encode($id);
 ?>