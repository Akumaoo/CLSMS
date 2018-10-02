<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
$PID=$input['PackageID'];
$RD=$input['ReceiveDate'];


if($input['action']=='edit')
{
	if(isset($RD))
	{	
		$list_serials=getListSerials($PID);
		$list_copy=getListCopy($PID);
		for($x=0;$x<count($list_serials);$x++)
		{
			$serial=$list_serials[$x];
			$NIR=getNIR($serial);
			$copy=$list_copy[$x];
			$freq=getOrders($serial);

			$new_NIR=$NIR+$copy;
			if($new_NIR>=$freq)
			{
				$upsql="Update Subscription SET NumberOfItemReceived=?,Status=? WHERE SerialID=? AND Status=?";
				$upquery=sqlsrv_query($conn,$upsql,array($freq,'Finished',$serial,'OnGoing'));
				if($upquery)
				{
					$sql="Update Package_Delivery Set ReceiveDate=? Where PackageID=?";
					$query=sqlsrv_query($conn,$sql,array($RD,$PID),$opt);
				}
			}
			else
			{
				$upsql="Update Subscription SET NumberOfItemReceived=? WHERE SerialID=? AND Status=?";
				$upquery=sqlsrv_query($conn,$upsql,array($new_NIR,$serial,'OnGoing'));
				if($upquery)
				{
					$sql="Update Package_Delivery Set ReceiveDate=? Where PackageID=?";
					$query=sqlsrv_query($conn,$sql,array($RD,$PID),$opt);
				}
			}
		}

	}

}
else if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM Package_Delivery Where PackageID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($PID),$opt);
}

function getListSerials($pd)
{
	require 'db.php';
	$serial_list=[];
	$inc=0;
	$sql="Select SerialID from Delivery Where PackageID=?";
	$query=sqlsrv_query($conn,$sql,array($pd),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$serial_list[$inc]=$row['SerialID'];
			$inc++;
		}
		return $serial_list;
	}
	else
	{
		return 'NotValid';
	}

}

function getListCopy($pd)
{
	require 'db.php';
	$Copy_list=[];
	$inc=0;
	$sql="Select Copies from Delivery Where PackageID=?";
	$query=sqlsrv_query($conn,$sql,array($pd),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$Copy_list[$inc]=$row['Copies'];
			$inc++;
		}
		return $Copy_list;
	}
	else
	{
		return 'NotValid';
	}

}
function getNIR($ser)
{
	require 'db.php';
	$sql="Select NumberOfItemReceived from Subscription Where SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array($ser,'OnGoing'),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$NIR=$row['NumberOfItemReceived'];
		}
		return $NIR;
	}
	else
	{
		return 'NotValid';
	}
}
function getOrders($ser)
{
	require 'db.php';
	$sql="Select Orders from Subscription Where SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array($ser,'OnGoing'),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$ord=$row['Orders'];
		}
		return $ord;
	}
	else
	{
		return 'NotValid';
	}
}
echo json_encode($input);

 ?>
