<?php 
require 'db.php';

$date_today=date("Y/m/d");

//get all deliveries
$sqltxt="Select SubscriptionID,DistributorName,InitialDeliveryDate,IDD_Phase,TypeName from Serial Inner Join Subscription On Serial.SerialID=Subscription.SerialID Inner Join Distributor On Subscription.DistributorID=Distributor.DistributorID WHERE InitialDeliveryDate<CONVERT(VARCHAR(10), GETDATE(), 110) AND Subscription.Status=? AND IDD_Phase!=?";
$query=sqlsrv_query($conn,$sqltxt,array('OnGoing','Complete'));
if(sqlsrv_has_rows($query))
{	
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$SubID=$row["SubscriptionID"];
		$ERD=$row['InitialDeliveryDate']->format("Y/m/d");
		$phase=$row['IDD_Phase'];
		$dname=$row['DistributorName'];
		$type=$row['TypeName'];

		if($phase=="Phase1")
		{	
			if($type=='International')
			{
				$phase2_date=date("Y/m/d",strtotime($ERD.'+ 2 month'));
			}
			else
			{
				$phase2_date=date("Y/m/d",strtotime($ERD.'+ 4 month'));
			}			
			
			$sqlupdate="Update Subscription Set IDD_Phase=?,InitialDeliveryDate=? Where SubscriptionID=?";
			$queryupdate=sqlsrv_query($conn,$sqlupdate,array('Phase2',$phase2_date,$SubID));

		}		
	}
}

 ?>