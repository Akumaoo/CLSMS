<?php
require "db.php";

$input=filter_input_array(INPUT_POST);

if($input["action"]==="edit")
{
	$sub_id=$input['SubscriptionID'];
	$orders=$input["Orders"];
	$cost=$input["Cost"];
	$stat=$input["Status"];

	// $orders='4';
	// $cost='5';
	// $stat='OnGoing';

	if($stat!='OnGoing')
	{
		if($stat=='Finished')
		{

			$sqltxt="Update [Subscription] SET [Frequency]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$sub_id));
			
			if($queryedit)
			{
				function getcateg($sub)
				{
					require 'db.php';

					$cID_list=[];
					$inc=0;
					$sql="Select CategoryID from Categorize_Serials Where SubscriptionID=?";
					$query=sqlsrv_query($conn,$sql,array($sub));

					while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
					{
						$cID_list[$inc]=$row['CategoryID'];
						$inc++;
					}
					return $cID_list;
				}

				$num_dept=getcateg($sub_id);

				for($x=0;$x<count($num_dept);$x++)
				{
					$updatesql="Update Categorize_Serials SET NumberOfItemReceived=? Where CategoryID=?";
					$queryup=sqlsrv_query($conn,$updatesql,array($orders,$num_dept[$x]));
				}

				$input['status']='success';

			}

		}
		else
		{
			$sqltxt="Update [Subscription] SET [Frequency]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
			$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$sub_id));
			$input['status']='success';
		}
	}
	else
	{
		$sqltxt="Update [Subscription] SET [Frequency]=?,[Cost]=?,[Status]=? WHERE [Subscription].[SubscriptionID]=?";
		$queryedit=sqlsrv_query($conn,$sqltxt,array($orders,$cost,$stat,$sub_id));
		$input['status']='success';
	}
	echo json_encode($input);
}
else if($input["action"]==='delete')
{

	$reason=$input['reason'];
	$subID=$input['subID'];
		// $reason='asdas';
		// $sID=34;
	
	$sqltxtdel="Update Subscription SET Remove=?,Remove_Remarks=? Where SubscriptionID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array('Removed',$reason,$subID));
	
	header('Content-type: application/json');
	echo json_encode($input);
}



?>