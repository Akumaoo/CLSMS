<?php 
require 'db.php';
if(!empty($_POST))
{
	$year_today=date('Y');
	$subs_list=array();

	if ($_POST['data_type']=='Count_Archive') {	

		$sql="Select Count(*) as Nums from Subscription Where Status!=? AND Archive IS NULL AND Year(Subscription_Date)<?";
		$query=sqlsrv_query($conn,$sql,array('OnGoing',$year_today));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$nums_data=$row['Nums'];

		 header('Content-type: application/json');
		echo json_encode($nums_data);

	}
	else if($_POST['data_type']=='Archive_datas')
	{

		$sql2="Select SubscriptionID from Subscription Where Status!=? AND Archive IS NULL AND Year(Subscription_Date)<?";
		$query2=sqlsrv_query($conn,$sql2,array('OnGoing',$year_today));
		if(sqlsrv_has_rows($query2))
		{	
			$inc=0;
			$inc_error=0;
			$inc_scs=0;
			while($row=sqlsrv_fetch_array($query2,SQLSRV_FETCH_ASSOC))
			{
				$subs_list[$inc]=$row['SubscriptionID'];
				$inc++;
			}
		

			for($x=0;$x<count($subs_list);$x++)
			{
				$sqlup="Update Subscription Set Archive=? where SubscriptionID=?";
				$queryup=sqlsrv_query($conn,$sqlup,array('Archived',$subs_list[$x]));
				if($queryup)
				{
					$inc_scs++;
				}
				else
				{
					$inc_error++;
				}
			}

			if($inc_error==0)
			{
				$msg='complete_archive';
			}
			else if($inc_scs==0)
			{
				$msg='error_archive';
			}
			else
			{
				$msg='incomplete_archive';
			}


			 header('Content-type: application/json');
			echo json_encode($msg);

		}
	}

	
}

 ?>