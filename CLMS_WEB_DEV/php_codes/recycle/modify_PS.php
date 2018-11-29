<?php 
require "../db.php";

$input=filter_input_array(INPUT_POST);

	function getSubID($RSID)
	{
		require '../db.php';
		$sql="Select SubscriptionID from Subscription Inner Join ReceiveSerial ON Subscription.SerialID=ReceiveSerial.SerialID Where ReceivedSerialID=? AND Subscription.Status=? AND Subscription.Remove IS NULL";
		$query=sqlsrv_query($conn,$sql,array($RSID,'OnGoing'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$subID=$row['SubscriptionID'];
		return $subID;
	}

	function getNumOfSent($subID)
	{
		require '../db.php';
		$sql="Select Count(*) as Num_of_Sent From Subscription Inner Join ReceiveSerial ON Subscription.SerialID=ReceiveSerial.SerialID Where SubscriptionID=? And ReceiveSerial.Status=? AND ReceiveSerial.Remove IS NOT NULL";
		$query=sqlsrv_query($conn,$sql,array($subID,'NotReceived'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['Num_of_Sent'];
		return $num;
	}
	function getDSID($subID)
	{
		require '../db.php';
		$sql="Select DS_ID from Delivery_Subs Where SubscriptionID=? AND Remove IS NOT NULL";
		$query=sqlsrv_query($conn,$sql,array($subID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$DSID=$row['DS_ID'];
		return $DSID;
	}

	if($input["action"]==='retrieve')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$subID=getSubID($ret_list[$x]);
			$num_sent=getNumOfSent($subID);

			if($num_sent==1)
			{
				$dsID=getDSID($subID);
				$sqltxtdelDSID="Update Delivery_Subs SET Remove=?,Remove_Remarks=? Where DS_ID=?";
				$querydelDSID=sqlsrv_query($conn,$sqltxtdelDSID,array(NULL,NULL,$dsID));
			}

			$sqltxtdel="Update ReceiveSerial SET Remove=?,Remove_Remarks=? Where ReceivedSerialID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array(NULL,NULL,$ret_list[$x]));
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
	else if($input["action"]==='PRS')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$subID=getSubID($ret_list[$x]);
			$num_sent=getNumOfSent($subID);

			if($num_sent==1)
			{
				$dsID=getDSID($subID);
				$sqltxtdelDSID="Delete from Delivery_Subs Where DS_ID=?";
				$querydelDSID=sqlsrv_query($conn,$sqltxtdelDSID,array($dsID));
			}

			$sqltxtdel="Delete from ReceiveSerial Where ReceivedSerialID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>