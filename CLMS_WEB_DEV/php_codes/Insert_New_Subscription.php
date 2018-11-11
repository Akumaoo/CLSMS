<?php 
require 'db.php';

if(!empty($_POST))
{
	$distname=$_POST['dname'];
	$type=$_POST['type'];
	$sn=$_POST['sname'];
	$freq=$_POST['freq'];
	$cost=$_POST['cost'];
	$dept_list=$_POST['depts'];

	// $distname="UMX";
	// $type="Auto-Activate";
	// $sn="DUMMY";
	// $freq=6;
	// $cost=6;
	// $dept_list=array('HS','ELEM');
	
	// $date_today=date('Y/m/d');

function CheckDisbtributor($disb){
	require 'db.php';
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
	require 'db.php';
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
function CheckDup($sid)
{
	require 'db.php';
	$sql="Select * from Subscription Where SerialID=? AND Status=?";
	$query=sqlsrv_query($conn,$sql,array($sid,'OnGoing'));
	if(sqlsrv_has_rows($query))
	{
		return true;
	}
	else
	{
		return false;
	}
}
function getStype($sid)
{
	require 'db.php';
	$sql="Select Origin from Serial Where SerialID=?";
	$query=sqlsrv_query($conn,$sql,array($sid));
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$type=$row['Origin'];
	return $type;
}
function getNewSubID()
{
	require 'db.php';
	$sql="Select Max(SubscriptionID) AS SubscriptionID from Subscription";
	$query=sqlsrv_query($conn,$sql,array());
	$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
	$nid=$row['SubscriptionID'];
	return $nid;
}


	if((CheckDisbtributor($distname)!="NotValid" && CheckSerial($sn)!="NotValid" && !CheckDup(CheckSerial($sn))))
	{
		$dID=CheckDisbtributor($distname);
		$SID=CheckSerial($sn);
		

		if($type=="Manual-Activate")
		{
		
			// inserting on subscription table
			$sqlinsert="Insert Into [Subscription](DistributorID,SerialID,Frequency,Cost,Status) Values(?,?,?,?,?)";
			$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$freq,$cost,'OnGoing'));

			if($query)
			{
				$new_SubID=getNewSubID();

				for($x=0;$x<count($dept_list);$x++)
				{
					$dept=$dept_list[$x];
					$sqlins="Insert Into Categorize_Serials(SubscriptionID,DepartmentID,NumberOfItemReceived,Usage_Stat) VALUES(?,?,?,?)";
					$insquery=sqlsrv_query($conn,$sqlins,array($new_SubID,$dept,0,0));
				}
				$scs['status']="success";
			}
			else
			{
				$scs['status']='fail';
			}
		}
		else
		{
			$SED=$_POST['SED'];
			$SSD=$_POST['SSD'];
			$RT=getStype($SID);
			// $SED='2018-10-10';
			// $RT='Local';

			

			if($RT=='Local')
			{
				$ERD=date("Y/m/d",strtotime($SSD.'+ 4 month'));
			}
			else if($RT=='International')
			{
				$ERD=date("Y/m/d",strtotime($SSD.'+ 6 month'));	
			}
			$sqlinsert="Insert Into Subscription(DistributorID,SerialID,Frequency,Cost,Status,IDD_Phase,InitialDeliveryDate,Subscription_Date,Subscription_End_Date) Values(?,?,?,?,?,?,?,?,?)";
			$query=sqlsrv_query($conn,$sqlinsert,array($dID,$SID,$freq,$cost,'OnGoing','Phase1',$ERD,$SSD,$SED));

			if($query)
			{
				$new_SubID=getNewSubID();

				for($x=0;$x<count($dept_list);$x++)
				{
					$dept=$dept_list[$x];
					$sqlins="Insert Into Categorize_Serials(SubscriptionID,DepartmentID,NumberOfItemReceived,Usage_Stat) VALUES(?,?,?,?)";
					$insquery=sqlsrv_query($conn,$sqlins,array($new_SubID,$dept,0,0));
				}

				$scs['status']="success";
			}
			else
			{
				$scs['status']='fail';
			}	
		}
		 
	}
	else
	{
		$scs['status']='fail';
	}

header('Content-type: application/json');
echo json_encode($scs);
}

 ?>