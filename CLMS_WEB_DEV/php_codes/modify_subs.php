<?php
require "db.php";

$input=filter_input_array(INPUT_POST);
$distname=$input["DistributorName"];
$serialname=$input["SerialName"];

$orders=$input["Orders"];
$cost=$input["Cost"];
$NIR=$input["NumberOfItemReceived"];
$stat=$input["Status"];
$sub_id=$input['SubscriptionID'];

function CheckDisbtributor($disb){
	require "db.php";
	$Dname=$disb;
	$checksql="Select * from [Distributor] Where [Distributor].[DistributorName]=?";
	$query=sqlsrv_query($conn,$checksql,array($Dname),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$DisbID=$row["DistributorID"];
			return $DisbID;
		}
	}
	else
	{
		return "NotValid";
	}
}
function CheckSerial($ser)
{
	require "db.php";
	$Sname=$ser;
	$checksqlser="Select * from [Serial] Where [Serial].[SerialName]=?";
	$queryser=sqlsrv_query($conn,$checksqlser,array($Sname),$opt);
	if(sqlsrv_has_rows($queryser))
	{
		while($row=sqlsrv_fetch_array($queryser,SQLSRV_FETCH_ASSOC))
		{
			$SerID=$row["SerialID"];
			return $SerID;
		}
	}
	else
	{
		return "NotValid";
	}
}

if($input["action"]==="edit")
{
	if((CheckDisbtributor($distname)!="NotValid" && CheckSerial($serialname)!="NotValid"))
	{
		$disb_id=CheckDisbtributor($distname);
		$serial_id=CheckSerial($serialname);
		$sqltxt="Update [Subscription] SET [DistributorID]=?,[SerialID]=?,[Orders]=?,[Cost]=?,[NumberOfItemReceived]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
		$queryedit=sqlsrv_query($conn,$sqltxt,array($disb_id,$serial_id,$orders,$cost,$NIR,$stat,$sub_id),$opt);
	}
}
else if($input["action"]==='delete')
{
	$sqltxtdel="Delete FROM [Subscription] Where [SubscriptionID]=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($sub_id),$opt);
}

echo json_encode($input);

?>