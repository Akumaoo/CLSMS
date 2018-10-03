<?php
require "db.php";

$input=filter_input_array(INPUT_POST);
$serialname=$input["SerialName"];

$orders=$input["Orders"];
$cost=$input["Cost"];
$NIR=$input["NumberOfItemReceived"];
$stat=$input["Status"];
$sub_id=$input['SubscriptionID'];

function CheckSerial($ser)
{
	require "db.php";
	$Sname=$ser;
	$checksqlser="Select * from [Serial] Where [Serial].[SerialName]=?";
	$queryser=sqlsrv_query($conn,$checksqlser,array($Sname));
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
	if(CheckSerial($serialname)!="NotValid" && $stat!='stat')
	{
		$serial_id=CheckSerial($serialname);
		$sqltxt="Update [Subscription] SET [SerialID]=?,[Orders]=?,[Cost]=?,[NumberOfItemReceived]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
		$queryedit=sqlsrv_query($conn,$sqltxt,array($serial_id,$orders,$cost,$NIR,$stat,$sub_id));
		$input['status']='success';

	}
	else
	{
		$input['status']='fail';
	}
}
else if($input["action"]==='delete')
{
	$sqltxtdel="Delete FROM [Subscription] Where [SubscriptionID]=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($sub_id),$opt);
}

echo json_encode($input);

?>