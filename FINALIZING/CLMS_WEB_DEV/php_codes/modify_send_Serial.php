<?php 
require "db.php";

$input=filter_input_array(INPUT_POST);

if($input['action']=='delete')
{
	function getSubID($RSID)
	{
		require 'db.php';
		$sql="Select SubscriptionID from Subscription Inner Join ReceiveSerial ON Subscription.SerialID=ReceiveSerial.SerialID Where ReceivedSerialID=? AND Subscription.Status=? AND Subscription.Remove IS NULL";
		$query=sqlsrv_query($conn,$sql,array($RSID,'OnGoing'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$subID=$row['SubscriptionID'];
		return $subID;
	}

	function getNumOfSent($subID)
	{
		require 'db.php';
		$sql="Select Count(*) as Num_of_Sent  from
			(Select SubscriptionID,DepartmentID,ReceiveSerial.Status,DateReceiveNotif_Give,ReceiveSerial.Remove as remv_main from Subscription Inner Join ReceiveSerial on Subscription.SerialID=ReceiveSerial.SerialID) as asd
			Left Join
			(Select SubscriptionID,DepartmentID,ReceiveSerial_Program.ProgramID,ReceiveSerial_Program.Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove as remv_prog from Subscription Inner Join ReceiveSerial_Program on Subscription.SerialID=ReceiveSerial_Program.SerialID
				Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID inner join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID 
				Where ((asd.SubscriptionID=dsa.SubscriptionID) OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND asd.SubscriptionID=? And ((asd.Status=? AND dsa.Status_Prog IS NULL) OR (asd.Status=? AND dsa.Status_Prog=?)) AND (remv_main IS NULL AND remv_prog IS NULL)";
		$query=sqlsrv_query($conn,$sql,array($subID,'NotReceived','NotReceived','NotReceived'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['Num_of_Sent'];
		return $num;
	}
	function getDSID($subID)
	{
		require 'db.php';
		$sql="Select DS_ID from Delivery_Subs Where SubscriptionID=? AND Remove IS NULL";
		$query=sqlsrv_query($conn,$sql,array($subID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$DSID=$row['DS_ID'];
		return $DSID;
	}
	function getnumRS($rsID)
	{
		require 'db.php';
		$sql="Select Count(*) as num_rows from
		(Select ReceivedSerialID,SubscriptionID,DepartmentID,ReceiveSerial.Status,DateReceiveNotif_Give,ReceiveSerial.Remove as remv_main from Subscription Inner Join ReceiveSerial on Subscription.SerialID=ReceiveSerial.SerialID) as asd
		Left Join
		(Select ReceiveSerialID_Program,SubscriptionID,DepartmentID,ReceiveSerial_Program.ProgramID,ReceiveSerial_Program.Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove as remv_prog from Subscription Inner Join ReceiveSerial_Program on Subscription.SerialID=ReceiveSerial_Program.SerialID
			Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID inner join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID 
			Where ((asd.SubscriptionID=dsa.SubscriptionID) OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND asd.ReceivedSerialID=? And ((asd.Status=? AND dsa.Status_Prog IS NULL) OR (asd.Status=? AND dsa.Status_Prog=?)) AND (remv_main IS NULL AND remv_prog IS NULL)";
		$query=sqlsrv_query($conn,$sql,array($rsID,'NotReceived','NotReceived','NotReceived'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['num_rows'];
		return $num;
	}

	$reason=$input['reason'];
	$rsID=$input['rsID'];
	$rs_prog=$input['rs_prog'];
	// $reason='asdas';
	// $sID=34;
	$subID=getSubID($rsID);
	$num_sent=getNumOfSent($subID);
	if($num_sent==1)
	{
		$dsID=getDSID($subID);
		$sqltxtdelDSID="Update Delivery_Subs SET Remove=?,Remove_Remarks=? Where DS_ID=?";
		$querydelDSID=sqlsrv_query($conn,$sqltxtdelDSID,array('Removed','all delivered items were removed',$dsID));
	}

	if($rs_prog!="")
	{
		$rows=getnumRS($rsID);
		if($rows==1)
		{
			$sqltxtdel="Update ReceiveSerial SET Remove=?,Remove_Remarks=? Where ReceivedSerialID=?";
			$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed','All Pending Serials Removed',$rsID));

		}

		$sqltxtdel_prog="Update ReceiveSerial_Program SET Remove=?,Remove_Remarks=? Where ReceiveSerialID_Program=?";
		$querydel_prog=sqlsrv_query($conn,$sqltxtdel_prog,array('Removed',$reason,$rs_prog));	
	}
	else
	{
		$sqltxtdel="Update ReceiveSerial SET Remove=?,Remove_Remarks=? Where ReceivedSerialID=?";
		$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$rsID));
	}
	
	
	header('Content-type: application/json');
	echo json_encode($input);
}

 ?>