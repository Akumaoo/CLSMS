<?php 
require 'db.php';

if(!empty($_POST))
{
	$SN=$_POST['sn'];
	// $SN='DUMMY';

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

	if(empty($_POST['orgs']))
	{
		$orgs=array();
		$progs=array();
	}
	else
	{
		$orgs=$_POST['orgs'];
		$progs=$_POST['progs'];
	}
	
	// $depts_list=array('ELEM','JHS','College');
	// $progs=array('CS','IT');


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

		$sql="Select Sum(NumberOfItemReceived) AS Total_NIR from Categorize_Serials Where SubscriptionID=?";
		$sqlquery=sqlsrv_query($conn,$sql,array($sub));
		$row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC);
		$Total_NIR=$row['Total_NIR'];

		$sqlcount="
				Select Count(*) as nums from 
				(Select CategoryID,DepartmentID as dept_main from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as asd
				Left join
				(Select Category_Serials_Program.CategoryID_Program,Organization.DepartmentID as dept_prog,Organization.OrganizationID,Category_Serials_Program.ProgramID from Organization inner join Program On Organization.OrganizationID=Program.OrganizationID Inner Join Category_Serials_Program On Program.ProgramID=Category_Serials_Program.ProgramID
				Inner Join Subscription On Category_Serials_Program.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as dsa
				On asd.dept_main=dsa.dept_prog";
		$querycount=sqlsrv_query($conn,$sqlcount,array('OnGoing',$sub,'OnGoing',$sub));
		$row=sqlsrv_fetch_array($querycount,SQLSRV_FETCH_ASSOC);
		$deptCount=$row['nums'];

		$getfreqtxt="Select Frequency from Subscription Where SubscriptionID=?";
		$queryfreq=sqlsrv_query($conn,$getfreqtxt,array($sub));
		$row=sqlsrv_fetch_array($queryfreq,SQLSRV_FETCH_ASSOC);
		$freq=$row['Frequency'];

		$sum_finish=$freq*$deptCount;

		if($Total_NIR==$sum_finish)
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
		$sql="Select Count(*) as nums from ReceiveSerial where DepartmentID=? AND SerialID=? AND DateReceiveNotif_Give=? AND Status=?";
		$query=sqlsrv_query($conn,$sql,array($dept,$sID,$date,'NotReceived'));
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
	function checkDupRS_prog($sID,$date,$prog)
	{
		require 'db.php';
		$sql="Select Count(*) as nums from ReceiveSerial_Program where ProgramID=? AND SerialID=? AND DateReceiveNotif_Give_Prog=?";
		$query=sqlsrv_query($conn,$sql,array($prog,$sID,$date));
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


	if(GetSerialID($SN)!='NotValid')
	{
		$serial_id=GetSerialID($SN);
		$sub_id=subsID($serial_id);
		$order=getFreq($sub_id);
		$date_today=date('Y/m/d');


			if(checkPhase($sub_id))
			{
				$delID=checkDeliv();
				// $scs['del']=$delID.",".$sub_id.",".$DOI.",".$IN.",".$VN;
				$insertsql="Insert Into Delivery_Subs(DeliveryID,SubscriptionID,DateofIssue,IssueNumber,VolumeNumber) VALUES(?,?,?,?,?)";
				$insertquery=sqlsrv_query($conn,$insertsql,array($delID,$sub_id,$DOI,$IN,$VN));

				if($insertquery)
				{
					for($x=0;$x<count($depts_list);$x++)
					{
						// SENDING SERIAL PROCESS
						if(checkDupRS($serial_id,$date_today,$depts_list[$x]))
						{
							$sendsertxt="Insert Into ReceiveSerial(DepartmentID,SerialID,Status,DateReceiveNotif_Give) VALUES (?,?,?,?)";
							$sendserquery=sqlsrv_query($conn,$sendsertxt,array($depts_list[$x],$serial_id,'NotReceived',$date_today));
						}
					}

					for($z=0;$z<count($progs);$z++)
					{
						// SENDING SERIAL PROCESS
						if(checkDupRS_prog($serial_id,$date_today,$progs[$z]))
						{
							$sendsertxt_prog="Insert Into ReceiveSerial_Program(SerialID,ProgramID,DateReceiveNotif_Give_Prog) VALUES (?,?,?)";
							$sendserquery_prog=sqlsrv_query($conn,$sendsertxt_prog,array($serial_id,$progs[$z],$date_today));
						}
						
					}

					if(checkFinished($sub_id)=='Finished')
					{
						$sqlup="Update Subscription Set IDD_Phase=?,Status=? Where SubscriptionID=?";
						$upquery=sqlsrv_query($conn,$sqlup,array('Complete','Finished',$sub_id));
					}
					else
					{
						$sqlup="Update Subscription Set IDD_Phase=? Where SubscriptionID=?";
						$upquery=sqlsrv_query($conn,$sqlup,array('Complete',$sub_id));
					}	
					// ($upquery && $sendserquery && $sqlupCSquery)
					if(($upquery && $sendserquery))
					{
						$scs['status']='success';
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
	}

	header('Content-type: application/json');
	echo json_encode($scs);
}
 ?>
