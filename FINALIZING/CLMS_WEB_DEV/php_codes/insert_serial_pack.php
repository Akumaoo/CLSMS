<?php 
require 'db.php';

if(!empty($_POST))
{
	$SN=$_POST['sn'];
	// $SN='test5';

	if(!$_POST['DOI'])
	{
		$DOI=NULL;
	}
	else
	{
		$DOI=$_POST['DOI'];
	}
	if($_POST['IN']==0)
	{
		$IN=NULL;
	}
	else
	{
		$IN=$_POST['IN'];
	}
	if($_POST['VN']==0)
	{
		$VN=NULL;
	}
	else
	{
		$VN=$_POST['VN'];
	}
	$depts_list=$_POST['depts'];
	
	// $depts_list=array('College');


	function GetSerialID($sn)
	{
		require 'db.php';
		$getsidsql="Select SerialID from Serial Where SerialName=? AND Remove Is NULL";
		$getidquery=sqlsrv_query($conn,$getsidsql,array($sn));
		if(sqlsrv_has_rows($getidquery))
		{
			while($row=sqlsrv_fetch_array($getidquery,SQLSRV_FETCH_ASSOC))
			{
				$rid=$row['SerialID'];
			}
			return $rid;
		}
		else
		{
			return 'NotValid';
		}
	}


	function subsID($sid)
	{
		require 'db.php';
		$sql='Select SubscriptionID from Subscription Where SerialID=? AND Status=? AND Archive IS NULL AND Remove IS NULL';
		$query=sqlsrv_query($conn,$sql,array($sid,"OnGoing"));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$id=$row['SubscriptionID'];
		return $id;
	}

	function getFreq($s)
	{
		require 'db.php';
		$sql="Select Frequency from Subscription Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($s));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$freq=$row['Frequency'];
		return $freq;
	}

	function checkPhase($n)
	{
		require 'db.php';
		$sql="Select IDD_Phase from Subscription Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($n));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$IDDP=$row['IDD_Phase'];
		if(!is_null($IDDP))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	function checkDeliv()
	{
		require 'db.php';
		$date_today=date('Y/m/d');
		$delID="";

		$sql="Select * from Delivery Where Receive_Date=?";
		$query=sqlsrv_query($conn,$sql,array($date_today));
		if(sqlsrv_has_rows($query))
		{
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$delID=$row['DeliveryID'];
			return $delID;
		}
		else
		{
			$sqlins="Insert Into Delivery(Receive_Date) Values(?)";
			$insquery=sqlsrv_query($conn,$sqlins,array($date_today));
			if($insquery)
			{
				$sqlget="Select Max(DeliveryID) as NewDel from Delivery";
				$getquery=sqlsrv_query($conn,$sqlget,array());
				$rows=sqlsrv_fetch_array($getquery,SQLSRV_FETCH_ASSOC);
				$delID=$rows['NewDel'];
			}
			return $delID;
		}
	}


	function checkFinished($sub){
		require 'db.php';

		$sql="Select NumberOfItemReceived AS Total_NIR from Categorize_Serials Where SubscriptionID=?";
		$sqlquery=sqlsrv_query($conn,$sql,array($sub));
		$row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC);
		$Total_NIR=$row['Total_NIR'];

		$getfreqtxt="Select Frequency from Subscription Where SubscriptionID=?";
		$queryfreq=sqlsrv_query($conn,$getfreqtxt,array($sub));
		$row=sqlsrv_fetch_array($queryfreq,SQLSRV_FETCH_ASSOC);
		$freq=$row['Frequency'];

		if($Total_NIR==$freq)
		{
			return 'Finished';
		}
		else
		{
			return 'Not-Finish';
		}

	}
	function checkDupRS($sID,$date,$dept)
	{
		require 'db.php';
		$sql="Select Count(*) as nums from ReceiveSerial where DepartmentID=? AND SerialID=? AND DateReceiveNotif_Give=? AND Remove IS NULL";
		$query=sqlsrv_query($conn,$sql,array($dept,$sID,$date));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num_rows=$row['nums'];

		if($num_rows>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function getKey($dept,$subID)
	{
		require 'db.php';
			$sql="Select CategoryID from Subscription Inner join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
					Inner Join Department ON Categorize_Serials.DepartmentID=Department.DepartmentID Where Categorize_Serials.SubscriptionID=? AND Categorize_Serials.DepartmentID=?";
			$query=sqlsrv_query($conn,$sql,array($subID,$dept));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$key=$row['CategoryID'];
		


		return $key;
		
	}

	function currentNIR($dept,$subID)
	{
		require 'db.php';

			$sql="Select NumberOfItemReceived from Subscription Inner join Categorize_Serials On Subscription.SubscriptionID=Categorize_Serials.SubscriptionID
					Inner Join Department ON Categorize_Serials.DepartmentID=Department.DepartmentID Where Categorize_Serials.SubscriptionID=? AND Categorize_Serials.DepartmentID=?";
			$query=sqlsrv_query($conn,$sql,array($subID,$dept));
			$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
			$key=$row['NumberOfItemReceived'];

		return $key;
		
	}

	function getType_dept($dept)
	{
		require 'db.php';
		$sql="Select Count(*) as nums from Department Inner Join Organization On Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
		$query=sqlsrv_query($conn,$sql,array($dept));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num=$row['nums'];

		if($num>0)
		{
			$type='Multiple';
		}
		else
		{
			$type='Single';
		}

		return $type;
	}


	if(GetSerialID($SN)!='NotValid')
	{
		$serial_id=GetSerialID($SN);
		$sub_id=subsID($serial_id);
		$date_today=date('Y/m/d');


			if(checkPhase($sub_id))
			{
				$delID=checkDeliv();
				for($x=0;$x<count($depts_list);$x++)
				{	
					$send_ser=true;
					if(checkDupRS($serial_id,$date_today,$depts_list[$x]))
					{
						// UPDATING NIR
						$cNIR=currentNIR($depts_list[$x],$sub_id);
						$freq_dept=getFreq($sub_id);
						$newNIR=$cNIR+1;

						if($newNIR>$freq_dept)
						{
							$newNIR=$freq_dept;
							$send_ser=false;
						}
						// UPDATING NIR
						$key=getKey($depts_list[$x],$sub_id);
						$updateNIR="Update Categorize_Serials Set NumberOfItemReceived=? Where CategoryID=?";
						$updateNIRquery=sqlsrv_query($conn,$updateNIR,array($newNIR,$key));
						
						

						// SENDING SERIAL PROCESS
						if($send_ser)
						{
							$sendsertxt="Insert Into ReceiveSerial(DepartmentID,SerialID,Status,DateReceiveNotif_Give) VALUES (?,?,?,?)";
							$sendserquery=sqlsrv_query($conn,$sendsertxt,array($depts_list[$x],$serial_id,'NotReceived',$date_today));

						}
						else
						{
							$sendserquery=true;
						}
					}
					else
					{
						$sendserquery=false;
					}
				}

				if(checkFinished($sub_id)=='Finished')
				{
					$sqlup="Update Subscription Set IDD_Phase=?,Status=? Where SubscriptionID=?";
					$upquery=sqlsrv_query($conn,$sqlup,array('P3','Finished',$sub_id));
				}
				else
				{
					$sqlup="Update Subscription Set IDD_Phase=? Where SubscriptionID=?";
					$upquery=sqlsrv_query($conn,$sqlup,array('P3',$sub_id));
				}	

				if($sendserquery)
				{
					if($updateNIRquery)
					{

						$sqlcheckdelsubs="Select Count(*) as rows from Delivery_Subs Where DeliveryID=? And SubscriptionID=?";
						$queryup=sqlsrv_query($conn,$sqlcheckdelsubs,array($delID,$sub_id));
						$row_ds=sqlsrv_fetch_array($queryup,SQLSRV_FETCH_ASSOC);
						$num_ds_rows=$row_ds['rows'];

						if($num_ds_rows==0)
						{
							$insertsql="Insert Into Delivery_Subs(DeliveryID,SubscriptionID,DateofIssue,IssueNumber,VolumeNumber) VALUES(?,?,?,?,?)";
							$insertquery=sqlsrv_query($conn,$insertsql,array($delID,$sub_id,$DOI,$IN,$VN));
						}

						if($upquery)
						{
							$scs['status']='success';
						}
						else
						{
							$scs['status']='<strong>Error ON</strong>: Updating Subscription Status';
						}
					}
					else
					{
						$scs['status']='<strong>ERROR ON</strong>: Updating Number Of Items Received';
					}
				}
				else
				{
					$scs['status']='<br>Title Already Sent To The Selected Department! You Can Only Send <strong>One</strong> Specific Title On A Department Each Day';
				}

			}
			else
			{

				$scs['status']="<br><strong>Subscription Haven't Started Yet</strong>";
			}		
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>
