<?php 
require "../db.php";

$input=filter_input_array(INPUT_POST);
// $input["action"]='retrieve';
// $input['ret_list']=array(2269);
	function getSubID($RSID)
	{
		require '../db.php';
		$sql="Select SubscriptionID from Subscription Inner Join ReceiveSerial ON Subscription.SerialID=ReceiveSerial.SerialID Where ReceivedSerialID=? AND Subscription.Remove IS NULL";
		$query=sqlsrv_query($conn,$sql,array($RSID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$subID=$row['SubscriptionID'];
		return $subID;
	}
	function getNumOfSent($subID)
	{
		require '../db.php';
		$sql="Select Count(*) as Num_of_Sent from Subscription Inner Join ReceiveSerial on Subscription.SerialID=ReceiveSerial.SerialID Where SubscriptionID=? And ReceiveSerial.Status=? And ReceiveSerial.Remove IS NULL";
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

	function getProgramDeptName($rsID)
	{
		require '../db.php';
			$sql="Select DepartmentID from ReceiveSerial Where ReceivedSerialID=?";
			$query=sqlsrv_query($conn,$sql,array($rsID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['DepartmentID'];
		

		return $data;
	}

	function getstat($categID)
	{
		require '../db.php';

		$sql="Select Subscription.Status as stat from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Where CategoryID=?";
		$query=sqlsrv_query($conn,$sql,array($categID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$data=$row['stat'];
	

		return $data;
	}


	function GetCategID($dept,$subID)
	{
		require '../db.php';
			$sql="Select CategoryID from Categorize_Serials Where DepartmentID=? AND SubscriptionID=?";
			$query=sqlsrv_query($conn,$sql,array($dept,$subID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['CategoryID'];

		return $data;
	}

	function getCurrentNIR($categ)
	{

		require '../db.php';
			$sql="Select NumberOfItemReceived from Categorize_Serials Where CategoryID=? ";
			$query=sqlsrv_query($conn,$sql,array($categ));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$NIR=$row['NumberOfItemReceived'];
		

		return $NIR;
	}

	if($input["action"]==='retrieve')
	{
		$ret_list=$input['ret_list'];
		
		for($x=0;$x<count($ret_list);$x++)
		{
			$subID=getSubID($ret_list[$x]);
			$num_sent=getNumOfSent($subID);

			if($num_sent==0)
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

			if($num_sent==0)
			{
				$dsID=getDSID($subID);
				$sqltxtdelDSID="Delete from Delivery_Subs Where DS_ID=?";
				$querydelDSID=sqlsrv_query($conn,$sqltxtdelDSID,array($dsID));
			}

			$dname=getProgramDeptName($ret_list[$x]);
			$categID=GetCategID($dname,$subID);

			$cNIR=getCurrentNIR($categID);
			$newNIR=$cNIR-1;
			$sqlupdateNIR="Update Categorize_Serials SET NumberOfItemReceived=? Where CategoryID=?";
			$sqlupdateNIRquery=sqlsrv_query($conn,$sqlupdateNIR,array($newNIR,$categID));

			$stat=getstat($categID);
			if($stat=='Finished')
			{
				$sqlupdatestat="Update Subscription Set Status=? Where SubscriptionID=?";
				$sqlupdatestatquery=sqlsrv_query($conn,$sqlupdatestat,array('OnGoing',$subID));
			}

			$sqltxtdel="Delete from ReceiveSerial Where ReceivedSerialID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));
			

		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>