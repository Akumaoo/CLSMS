<?php 
require 'db.php';

if(!empty($_POST))
{


	$SN=$_POST['sername'];
	$dept_list=$_POST['depts'];
	// $SN='Dummy';
	// $dept_list=['Highschool'];
	$date_today=date('Y/m/d');

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
	function CheckDup($dept,$sid)
	{
		require 'db.php';
		$getsidsql="Select * from ReceiveSerial Where SerialID=? AND DepartmentID=? AND Status=?";
		$getidquery=sqlsrv_query($conn,$getsidsql,array($sid,$dept,'NotReceived'));
		if(sqlsrv_has_rows($getidquery))
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
		$scs['status']=0;
		$scs['fail_enter']=0;
		for($y=0;$y<count($dept_list);$y++)
		{
			if(CheckDup($dept_list[$y],$serial_id))
			{
				$insertsql="Insert Into ReceiveSerial(DepartmentID,SerialID,Status,DateReceiveNotif_Give,ControlNumber,Rs_Seen,Staff_Comment) Values(?,?,?,?,?,?,?)";
				$insertquery=sqlsrv_query($conn,$insertsql,array($dept_list[$y],$serial_id,'NotReceived',$date_today,NULL,'NotSeen',NULL));
				
				if($insertquery)
				{
					$scs['status']++;
				}
			}
			else
			{
				$scs['fail_enter']++;
			}
		}
			
		
	}
	else
	{
		$scs['fail_enter']++;
	}
header('Content-type: application/json');
echo json_encode($scs);
}
 ?>
