<?php 
require 'db.php';

if(!empty($_POST))
{
	$distname=$_POST['dname'];
	$type=$_POST['type'];
	$sn=$_POST['sname'];
	$freq=$_POST['freq'];
	$cost=$_POST['cost'];
	$dept_list=$_POST['dept'];

	if(empty($_POST['org']))
	{
		$org=array();
		$prog_list=array();
	}
	else
	{
		$org=$_POST['org'];
		$prog_list=$_POST['progs'];
	}

	
	

	// $distname="emerald";
	// $type="Manual-Activate";
	// $sn="new";
	// $freq=6;
	// $cost=6;
	// $dept_list=array('HS','JHS');
	// $org=array();
	// $prog_list=array();
	
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
	$checksqlser="Select * from [Serial] Where [Serial].[SerialName]=? AND Remove IS NULL";
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
	$sql="Select * from Subscription Where SerialID=? AND Status=? AND Remove IS NULL";
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
	$sql="Select Origin from Serial Where SerialID=? AND Remove IS NULL";
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

	if(CheckSerial($sn)!="NotValid")
	{
		if(!CheckDup(CheckSerial($sn)))
		{
			if((CheckDisbtributor($distname)!="NotValid"))
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

						for($y=0;$y<count($dept_list);$y++)
						{
							$sqlins="Insert Into Categorize_Serials(SubscriptionID,DepartmentID,NumberOfItemReceived,Usage_Stat_Employee,Usage_Stat_Student) VALUES(?,?,?,?,?)";
							$insquery=sqlsrv_query($conn,$sqlins,array($new_SubID,$dept_list[$y],0,0,0));
						}

						for($x=0;$x<count($prog_list);$x++)
						{
								$sqlins_prog="Insert Into Category_Serials_Program(SubscriptionID,ProgramID,NumberofItemsReceived_Prog,Usage_Stat_Employee_Prog,Usage_Stat_Student_Prog) VALUES(?,?,?,?,?)";
								$insqueryprog=sqlsrv_query($conn,$sqlins_prog,array($new_SubID,$prog_list[$x],0,0,0));	
						}
						
						$scs['status']="success";
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Inserting Subscriptions';
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

						for($y=0;$y<count($dept_list);$y++)
						{
							$sqlins="Insert Into Categorize_Serials(SubscriptionID,DepartmentID,NumberOfItemReceived,Usage_Stat_Employee,Usage_Stat_Student) VALUES(?,?,?,?,?)";
							$insquery=sqlsrv_query($conn,$sqlins,array($new_SubID,$dept_list[$y],0,0,0));
						}

						for($x=0;$x<count($prog_list);$x++)
						{
								$sqlins_prog="Insert Into Category_Serials_Program(SubscriptionID,ProgramID,NumberofItemsReceived_Prog,Usage_Stat_Employee_Prog,Usage_Stat_Student_Prog) VALUES(?,?,?,?,?)";
								$insqueryprog=sqlsrv_query($conn,$sqlins_prog,array($new_SubID,$prog_list[$x],0,0,0));	
						}

						$scs['status']="success";
					}
					else
					{
						$scs['status']='<br><strong>ERROR ON:</strong> Inserting Subscriptions';
					}	
				}
				 
			}
			else
			{
				$scs['status']='<br>Invalid Distributor Name';
			}
		}
		else
		{
			$scs['status']="<br><strong>Duplicate Subscription,</strong> There's Ongoing Subsciption With The Same Title";
		}
	}
	else
	{
		$scs['status']='<br>Invalid Serial Name';
	}

header('Content-type: application/json');
echo json_encode($scs);
}

 ?>