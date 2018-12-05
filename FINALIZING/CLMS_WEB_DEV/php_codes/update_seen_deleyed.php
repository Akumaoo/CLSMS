<?php 

if(!empty($_POST))
{
	require 'db.php';

	// $_POST['pn']='DUMMY';
	// $_POST['type']='DeleyedDeliver_P2';
	if(!empty($_POST['type']))
	{	
		$type=$_POST['type'];

		if($type=='per dept')
		{
			$dept=$_POST['dept'];
			// $dept="SEAIDITE";

			function getRSID_List($dept){
				require 'db.php';
				$rs_list=[];
				$inc=0;
				$sql="Select ReceivedSerialID from Serial inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID Where DepartmentID=? AND Status=? AND Admin_Seen IS NULL";
				$query=sqlsrv_query($conn,$sql,array($dept,'Received'));
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$rs_list[$inc]=$row['ReceivedSerialID'];
					$inc++;
				}
				return $rs_list;
			}
			$rsID_list=getRSID_List($dept);

			for($x=0;$x<count($rsID_list);$x++)
			{
				$sqlup="Update ReceiveSerial Set Admin_Seen=? Where ReceivedSerialID=?";
				$upquery=sqlsrv_query($conn,$sqlup,array('Seen',$rsID_list[$x]));

			}
			$msg='success';
		}
		else
		{
			function getRSID_List($dept){
				require 'db.php';
				$rs_list=[];
				$inc=0;
				$sql="Select ReceivedSerialID from Serial inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID Where Status=? AND Admin_Seen IS NULL";
				$query=sqlsrv_query($conn,$sql,array('Received'));
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$rs_list[$inc]=$row['ReceivedSerialID'];
					$inc++;
				}
				return $rs_list;
			}
			$rsID_list=getRSID_List($dept);

			for($x=0;$x<count($rsID_list);$x++)
			{
				$sqlup="Update ReceiveSerial Set Admin_Seen=? Where ReceivedSerialID=?";
				$upquery=sqlsrv_query($conn,$sqlup,array('Seen',$rsID_list[$x]));

			}
			$msg='success';

		}

	}
		header('Content-type: application/json');
		echo json_encode($msg);
}

 ?>