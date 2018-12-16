<?php 
require "../db.php";

$input=filter_input_array(INPUT_POST);

// $input['ret_list']=array(2253);
// $input['ret_list_prog']=array();
// $input['action']='PRS';
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
		require '../db.php';
		$sql="Select DS_ID from Delivery_Subs Where SubscriptionID=? AND Remove IS NOT NULL";
		$query=sqlsrv_query($conn,$sql,array($subID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$DSID=$row['DS_ID'];
		return $DSID;
	}
	function getnumRS_Removed($rsID)
	{
		require '../db.php';
		$sql="Select Count(*) as num_rows from
		(Select ReceivedSerialID,SubscriptionID,DepartmentID,ReceiveSerial.Status,DateReceiveNotif_Give,ReceiveSerial.Remove as remv_main from Subscription Inner Join ReceiveSerial on Subscription.SerialID=ReceiveSerial.SerialID) as asd
		Left Join
		(Select ReceiveSerialID_Program,SubscriptionID,DepartmentID,ReceiveSerial_Program.ProgramID,ReceiveSerial_Program.Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove as remv_prog from Subscription Inner Join ReceiveSerial_Program on Subscription.SerialID=ReceiveSerial_Program.SerialID
			Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID inner join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID 
			Where ((asd.SubscriptionID=dsa.SubscriptionID) OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND asd.ReceivedSerialID=? And ((asd.Status=? AND dsa.Status_Prog IS NULL) OR (asd.Status=? AND dsa.Status_Prog=?)) AND  (remv_main IS NOT NULL OR remv_prog IS NOT NULL)";
		$query=sqlsrv_query($conn,$sql,array($rsID,'NotReceived','NotReceived','NotReceived'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['num_rows'];
		return $num;
	}
	function getnumRS($rsID)
	{
		require '../db.php';
		$sql="Select Count(*) as num_rows from
		(Select ReceivedSerialID,SubscriptionID,DepartmentID,ReceiveSerial.Status,DateReceiveNotif_Give,ReceiveSerial.Remove as remv_main from Subscription Inner Join ReceiveSerial on Subscription.SerialID=ReceiveSerial.SerialID) as asd
		Left Join
		(Select ReceiveSerialID_Program,SubscriptionID,DepartmentID,ReceiveSerial_Program.ProgramID,ReceiveSerial_Program.Status_Prog,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove as remv_prog from Subscription Inner Join ReceiveSerial_Program on Subscription.SerialID=ReceiveSerial_Program.SerialID
			Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID inner join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID 
			Where ((asd.SubscriptionID=dsa.SubscriptionID) OR (asd.SubscriptionID IS NOT NULL AND dsa.SubscriptionID IS NULL)) AND asd.ReceivedSerialID=? And ((asd.Status=? AND dsa.Status_Prog IS NULL) OR (asd.Status=? AND dsa.Status_Prog=?)) AND ((remv_main IS NOT NULL AND remv_prog IS NULL) OR (remv_main IS NULL AND remv_prog IS NOT NULL))";
		$query=sqlsrv_query($conn,$sql,array($rsID,'NotReceived','NotReceived','NotReceived'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['num_rows'];
		return $num;
	}

	function getProgramDeptName($rsID,$type)
	{
		require '../db.php';

		if($type=='Multiple')
		{
			$sql="Select ProgramID from ReceiveSerial_Program Where ReceiveSerialID_Program=?";
			$query=sqlsrv_query($conn,$sql,array($rsID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['ProgramID'];
		}
		else
		{
			$sql="Select DepartmentID from ReceiveSerial Where ReceivedSerialID=?";
			$query=sqlsrv_query($conn,$sql,array($rsID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['DepartmentID'];
		}
		

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


	function GetCategID($dept,$subID,$type)
	{
		require '../db.php';

		if($type=='Multiple')
		{
			$sql="Select CategoryID_Program from Category_Serials_Program Where ProgramID=? AND SubscriptionID=?";
			$query=sqlsrv_query($conn,$sql,array($dept,$subID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['CategoryID_Program'];
		}
		else
		{
			$sql="Select CategoryID from Categorize_Serials Where DepartmentID=? AND SubscriptionID=?";
			$query=sqlsrv_query($conn,$sql,array($dept,$subID));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$data=$row['CategoryID'];
		}

		return $data;
	}

	function getCurrentNIR($categ,$type)
	{

		require '../db.php';

		if($type=='Multiple')
		{
			$sql="Select NumberofItemsReceived_Prog from Category_Serials_Program Where CategoryID_Program=? ";
			$query=sqlsrv_query($conn,$sql,array($categ));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$NIR=$row['NumberofItemsReceived_Prog'];
		}
		else
		{
			$sql="Select NumberOfItemReceived from Categorize_Serials Where CategoryID=? ";
			$query=sqlsrv_query($conn,$sql,array($categ));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$NIR=$row['NumberOfItemReceived'];
		}

		return $NIR;
	}

	if($input["action"]==='retrieve')
	{
		$ret_list=$input['ret_list'];
		$ret_list_prog=$input['ret_list_prog'];
		
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

			if($ret_list_prog[$x]=="")
			{
				$sqltxtdel="Update ReceiveSerial SET Remove=?,Remove_Remarks=? Where ReceivedSerialID=?";
				$querydel=sqlsrv_query($conn,$sqltxtdel,array(NULL,NULL,$ret_list[$x]));
			}
			else
			{		
				$sqltxtdel_prog="Update ReceiveSerial_Program SET Remove=?,Remove_Remarks=? Where ReceiveSerialID_Program=?";
				$querydel_prog=sqlsrv_query($conn,$sqltxtdel_prog,array(NULL,NULL,$ret_list_prog[$x]));

				$rows=getnumRS($ret_list[$x]);
				if($rows>0)
				{
					$sqltxtdel="Update ReceiveSerial SET Remove=?,Remove_Remarks=? Where ReceivedSerialID=?";
					$querydel=sqlsrv_query($conn,$sqltxtdel,array(NULL,NULL,$ret_list[$x]));
				}
			}
			
		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
	else if($input["action"]==='PRS')
	{
		$ret_list=$input['ret_list'];
		$ret_list_prog=$input['ret_list_prog'];
		
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

			$dname=getProgramDeptName($ret_list[$x],'Single');
			$categID=GetCategID($dname,$subID,'Single');

			$cNIR=getCurrentNIR($categID,'Single');
			$newNIR=$cNIR-1;
			$sqlupdateNIR="Update Categorize_Serials SET NumberOfItemReceived=? Where CategoryID=?";
			$sqlupdateNIRquery=sqlsrv_query($conn,$sqlupdateNIR,array($newNIR,$categID));

			$stat=getstat($categID);
			if($stat=='Finished')
			{
				$sqlupdatestat="Update Subscription Set Status=? Where SubscriptionID=?";
				$sqlupdatestatquery=sqlsrv_query($conn,$sqlupdatestat,array('OnGoing',$subID));
			}

			if($ret_list_prog[$x]=="")
			{
				$sqltxtdel="Delete from ReceiveSerial Where ReceivedSerialID=?";
				$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));
			}
			else
			{
				$dname_prog=getProgramDeptName($ret_list_prog[$x],'Multiple');
				$categID_prog=GetCategID($dname_prog,$subID,'Multiple');

				$cNIR_prog=getCurrentNIR($categID_prog,'Multiple');
				$newNIR_prog=$cNIR_prog-1;
				$sqlupdateNIR_prog="Update Category_Serials_Program SET NumberofItemsReceived_Prog=? Where CategoryID_Program=?";
				$sqlupdateNIRquery_prog=sqlsrv_query($conn,$sqlupdateNIR_prog,array($newNIR_prog,$categID_prog));

				$rows=getnumRS_Removed($ret_list[$x]);
				if($rows==1)
				{
					$sqltxtdel="Delete from ReceiveSerial Where ReceivedSerialID=?";
					$querydel=sqlsrv_query($conn,$sqltxtdel,array($ret_list[$x]));
				}

				$sqltxtdel_prog="Delete from ReceiveSerial_Program Where ReceiveSerialID_Program=?";
				$querydel_prog=sqlsrv_query($conn,$sqltxtdel_prog,array($ret_list_prog[$x]));	

			}

		}
		header('Content-type: application/json');
		echo json_encode($input);
	}
 ?>