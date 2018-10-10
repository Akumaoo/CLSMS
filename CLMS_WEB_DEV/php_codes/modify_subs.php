<?php
require "db.php";

$input=filter_input_array(INPUT_POST);
$serialname=$input["SerialName"];

$orders=$input["Orders"];
$cost=$input["Cost"];
$stat=$input["Status"];
$sub_id=$input['SubscriptionID'];
// $sub_id=151;
// $input['action']='delete';

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
	if(CheckSerial($serialname)!="NotValid")
	{
		if($stat!='OnGoing')
		{
			if($stat=='Finished')
			{
				$sqldeliv_del="Select SubscriptionID,DeliveryID,Delivery.SerialID from Subscription Inner JOin Delivery ON Subscription.SerialID=Delivery.SerialID Where Subscription.Status=? AND SubscriptionID=?";
				$querydeliv_del=sqlsrv_query($conn,$sqldeliv_del,array('OnGoing',$sub_id));
				if(sqlsrv_has_rows($querydeliv_del))
				{	$id_list=[];
					$inc=0;
					while($row=sqlsrv_fetch_array($querydeliv_del))
					{
						$id_list[$inc]=$row['DeliveryID'];
						$inc++;
					}
				}

				if(isset($id_list))
				{
					for($x=0;$x<count($id_list);$x++)
					{
						$del="Delete From Delivery Where DeliveryID=?";
						$delquery=sqlsrv_query($conn,$del,array($id_list[$x]));
					}
				}

				$serial_id=CheckSerial($serialname);
				$sqltxt="Update [Subscription] SET [SerialID]=?,[Orders]=?,[Cost]=?,[Status]=?,NumberOfItemReceived=? WHERE [Subscription].[SubscriptionID]=?";
				$queryedit=sqlsrv_query($conn,$sqltxt,array($serial_id,$orders,$cost,$stat,$orders,$sub_id));
				$input['status']='success';

			}
			else
			{
				$sqldeliv_del="Select SubscriptionID,DeliveryID,Delivery.SerialID from Subscription Inner JOin Delivery ON Subscription.SerialID=Delivery.SerialID Where Subscription.Status=? AND SubscriptionID=?";
				$querydeliv_del=sqlsrv_query($conn,$sqldeliv_del,array('OnGoing',$sub_id));
				if(sqlsrv_has_rows($querydeliv_del))
				{	$id_list=[];
					$inc=0;
					while($row=sqlsrv_fetch_array($querydeliv_del))
					{
						$id_list[$inc]=$row['DeliveryID'];
						$inc++;
					}
				}

				if(isset($id_list))
				{
					for($x=0;$x<count($id_list);$x++)
					{
						$del="Delete From Delivery Where DeliveryID=?";
						$delquery=sqlsrv_query($conn,$del,array($id_list[$x]));
					}
				}

				$serial_id=CheckSerial($serialname);
				$sqltxt="Update [Subscription] SET [SerialID]=?,[Orders]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
				$queryedit=sqlsrv_query($conn,$sqltxt,array($serial_id,$orders,$cost,$stat,$sub_id));
				$input['status']='success';
			}
		}
		else
		{
			$serial_id=CheckSerial($serialname);
			$sqltxt="Update [Subscription] SET [SerialID]=?,[Orders]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($serial_id,$orders,$cost,$stat,$sub_id));
			$input['status']='success';
		}

	}
	else
	{
		$input['status']='fail';
	}
}
else if($input["action"]==='delete')
{
	$sqldeliv_del="Select SubscriptionID,DeliveryID,Delivery.SerialID from Subscription Inner JOin Delivery ON Subscription.SerialID=Delivery.SerialID Where Subscription.Status=? AND SubscriptionID=?";
	$querydeliv_del=sqlsrv_query($conn,$sqldeliv_del,array('OnGoing',$sub_id));
	if(sqlsrv_has_rows($querydeliv_del))
	{	$id_list=[];
		$inc=0;
		while($row=sqlsrv_fetch_array($querydeliv_del))
		{
			$id_list[$inc]=$row['DeliveryID'];
			$inc++;
		}
	}

	if(isset($id_list))
	{
		for($x=0;$x<count($id_list);$x++)
		{
			$del="Delete From Delivery Where DeliveryID=?";
			$delquery=sqlsrv_query($conn,$del,array($id_list[$x]));
		}
	}

	$sqltxtdel="Delete FROM [Subscription] Where [SubscriptionID]=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($sub_id));
}

echo json_encode($input);

?>