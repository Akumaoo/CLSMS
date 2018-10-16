<?php 
require 'db.php';

if(!empty($_POST))
{
	$SN=$_POST['sn_rec'];
	// $SN='Disney Princess';

	if(!$_POST['DOI_rec'])
	{
		$DOI=NULL;
	}
	else
	{
		$DOI=$_POST['DOI_rec'];
	}
	if($_POST['IN_rec']==0)
	{
		$IN=NULL;
	}
	else
	{
		$IN=$_POST['IN_rec'];
	}
	if($_POST['VN_rec']==0)
	{
		$VN=NULL;
	}
	else
	{
		$VN=$_POST['VN_rec'];
	}
	$cop=$_POST['copy_rec'];
	$RD=$_POST['DR_rec'];
	// $cop=2;
	// $RD='2018-10-16';

	function checkONgoing($sid)
	{
		require 'db.php';
		$sql="Select * from Subscription Where SerialID=? And Status=?";
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

	function GetSerialID($sn)
	{
		require 'db.php';
		$getsidsql="Select SerialID from Serial Where SerialName=?";
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

	function CheckDup($sid,$rd)
	{
		require 'db.php';
		$dupsql="Select * from Delivery Where SerialID=? AND Receive_Date=?";
		$dupquery=sqlsrv_query($conn,$dupsql,array($sid,$rd),$opt);
		if(sqlsrv_num_rows($dupquery)>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	function subsID($sid)
	{
		require 'db.php';
		$sql='Select SubscriptionID from Subscription Where SerialID=? AND Status=?';
		$query=sqlsrv_query($conn,$sql,array($sid,"OnGoing"));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$id=$row['SubscriptionID'];
		return $id;
	}
	function getPrevCop($subs)
	{
		require 'db.php';
		$sql="Select NumberOfItemReceived from Subscription Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($subs));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$id=$row['NumberOfItemReceived'];
		return $id;
	}
	function getFreq($s)
	{
		require 'db.php';
		$sql="Select Orders from Subscription Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($s));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$freq=$row['Orders'];
		return $freq;
	}
	function checkPhase($n)
	{
		require 'db.php';
		$sql="Select IDD_Phase from Subscription Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($n));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$freq=$row['IDD_Phase'];
		if(!is_null($freq))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	if(GetSerialID($SN)!='NotValid')
	{
		$serial_id=GetSerialID($SN);
		$sub_id=subsID($serial_id);
		$prev_cop=getPrevCop($sub_id);
		$new_copy=$cop+$prev_cop;
		$order=getFreq($sub_id);


		if(CheckDup($serial_id,$RD) && checkONgoing($serial_id))
		{
			if(checkPhase($sub_id))
			{
				if($new_copy<$order)
				{
					$sqlup="Update Subscription Set NumberOfItemReceived=?,IDD_Phase=? Where SubscriptionID=?";
					$upquery=sqlsrv_query($conn,$sqlup,array($new_copy,'Complete',$sub_id));

					if($upquery)
					{
						$insertsql="Insert Into Delivery(SerialID,DateofIssue,IssueNumber,VolumeNumber,Copies,Receive_Date) Values(?,?,?,?,?,?)";
						$insertquery=sqlsrv_query($conn,$insertsql,array($serial_id,$DOI,$IN,$VN,$cop,$RD));

						if($insertquery)
						{
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
					$sqlup2="Update Subscription Set NumberOfItemReceived=?,IDD_Phase=?,Status=? Where SubscriptionID=?";
					$upquery2=sqlsrv_query($conn,$sqlup2,array($order,'Complete','Finished',$sub_id));

					if($upquery2)
					{
						$insertsql2="Insert Into Delivery(SerialID,DateofIssue,IssueNumber,VolumeNumber,Copies,Receive_Date) Values(?,?,?,?,?,?)";
						$insertquery2=sqlsrv_query($conn,$insertsql2,array($serial_id,$DOI,$IN,$VN,$cop,$RD));

						if($insertquery2)
						{
							$scs['status']="success";
						}
						else
						{
							$scs['status']='fail';
						}
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
	}
}
 ?>
