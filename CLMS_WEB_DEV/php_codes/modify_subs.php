<?php
require "db.php";

$input=filter_input_array(INPUT_POST);

$orders=$input["Orders"];
$cost=$input["Cost"];
$stat=$input["Status"];
$sub_id=$input['SubscriptionID'];
// $sub_id=151;
// $input['action']='delete';


if($input["action"]==="edit")
{
	if($stat!='OnGoing')
	{
		if($stat=='Finished')
		{

			$sqltxt="Update [Subscription] SET [Orders]=?,[Cost]=?,[Status]=?,NumberOfItemReceived=? WHERE [Subscription].[SubscriptionID]=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$orders,$sub_id));
			$input['status']='success';

		}
		else
		{
			$sqltxt="Update [Subscription] SET [Orders]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$sub_id));
			$input['status']='success';
		}
	}
	else
	{
		$sqltxt="Update [Subscription] SET [Orders]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
		$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$sub_id));
		$input['status']='success';
	}

}
else if($input["action"]==='delete')
{

	$sqltxtdel="Delete FROM [Subscription] Where [SubscriptionID]=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($sub_id));
}

echo json_encode($input);

?>