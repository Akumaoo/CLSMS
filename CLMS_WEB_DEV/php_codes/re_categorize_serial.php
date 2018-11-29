<?php 
require 'db.php';	
if(!empty($_POST))
{
	$sname=$_POST['sname'];
	$depts=$_POST['depts'];
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
	
	
	// $sname='new';
	// $depts=array('College','HS','JHS');
	// $orgs=array('Seafa','SEAS');
	// $progs=array('BSIT','HRM');

	function GetCurrentList($subID)
	{
		$categ_list[]=[];
		$inc=0;
		require 'db.php';
		$sql="Select * from 
			(Select CategoryID,DepartmentID as dept_main from Categorize_Serials Inner Join Subscription On Categorize_Serials.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as asd
			Left join
			(Select Category_Serials_Program.CategoryID_Program,Organization.DepartmentID as dept_prog,Organization.OrganizationID,Category_Serials_Program.ProgramID from Organization inner join Program On Organization.OrganizationID=Program.OrganizationID Inner Join Category_Serials_Program On Program.ProgramID=Category_Serials_Program.ProgramID
			Inner Join Subscription On Category_Serials_Program.SubscriptionID=Subscription.SubscriptionID Inner Join Serial On Subscription.SerialID=Serial.SerialID Where Subscription.Status=? And Subscription.SubscriptionID=?) as dsa
			On asd.dept_main=dsa.dept_prog";
		$query=sqlsrv_query($conn,$sql,array('OnGoing',$subID,'OnGoing',$subID));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				// $categ_list[$inc]=['CategoryID'=>$row['CategoryID'],'CategoryID_Program'=>$row['CategoryID_Program'],'DepartmentID'=>$row['DepartmentID'],'ProgramID'=>$row['ProgramID']];

				$categ_list[$inc]['CategoryID']=$row['CategoryID'];
				$categ_list[$inc]['CategoryID_Program']=$row['CategoryID_Program'];
				$categ_list[$inc]['DepartmentID']=$row['dept_main'];
				$categ_list[$inc]['ProgramID']=$row['ProgramID'];
				$inc++;
			}
		}
		return $categ_list;
	}
	function GetSubID($sname)
	{
		require 'db.php';
		$sql='Select SubscriptionID from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID Where SerialName=? AND Status=?';
		$query=sqlsrv_query($conn,$sql,array($sname,'OnGoing'));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$subID=$row['SubscriptionID'];
		return $subID;
	}
	function getDeptID($categID)
	{
		require 'db.php';
		$sql='Select DepartmentID from Categorize_Serials Where CategoryID=?';
		$query=sqlsrv_query($conn,$sql,array($categID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$dept=$row['DepartmentID'];
		return $dept;
	}
	function getprog($categID)
	{
		require 'db.php';
		$sql='Select ProgramID from Category_Serials_Program Where CategoryID_Program=?';
		$query=sqlsrv_query($conn,$sql,array($categID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$prog=$row['ProgramID'];
		return $prog;
	}
	function Multiarray_check($haystack,$needle)
	{
		$identifier=0;
		$row="";
		for($x=0;$x<count($haystack);$x++)
		{
			if($haystack[$x]==$needle)
			{
				$identifier++;
				$row=$x;
				break;
			}
		}

		if($identifier>0)
		{
			return $row;
		}
		else
		{
			return 'NotFound';
		}
	}
	function checkDupCSmain($subID,$deptID)
	{	
		require 'db.php';
		$sql="Select Count(*) as rows from Categorize_Serials Where  SubscriptionID=? AND DepartmentID=?";
		$query=sqlsrv_query($conn,$sql,array($subID,$deptID));
		$rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num_rows=$rows['rows'];
		if($num_rows>0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	
	$subID=GetSubID($sname);
	$categ_list=GetCurrentList($subID);

	// if(isset($categ_list[0]['ProgramID']))
	// {
	// 	var_dump($categ_list);
	// }
	// else
	// {
	// 	echo 'asd';
	// }
	
	if(count($categ_list)>0)
	{
		for($x=0;$x<count($categ_list);$x++)
		{
			$type="";
			if(!isset($categ_list[$x]['ProgramID']))
			{
				// !COLLEGE
				$data=getDeptID($categ_list[$x]['CategoryID']);
				$type="NOT COLLEGE";
			}
			else
			{
				// COLLEGE
				$data=getprog($categ_list[$x]['CategoryID_Program']);
				$type="COLLEGE";
			}

			if($type=='COLLEGE')
			{
				$key=Multiarray_check($depts,$data);
				if($key!='NotFound')
				{
					unset($progs[$key]);
					unset($depts[$key]);
					$sqlquerydel=true;
				}
				else
				{
					$sqldel="Delete from Category_Serials_Program Where CategoryID_Program=?";
					$sqlquerydel=sqlsrv_query($conn,$sqldel,array($categ_list[$x]['CategoryID_Program']));
				}
			}
			else
			{
				$key=Multiarray_check($depts,$data);
				if($key!='NotFound')
				{
					unset($depts[$key]);
					$sqlquerydel=true;
				}
				else
				{
					$sqldel="Delete from Categorize_Serials Where CategoryID=?";
					$sqlquerydel=sqlsrv_query($conn,$sqldel,array($categ_list[$x]['CategoryID']));
				}
			}
		}
	}
	else
	{
		$sqlquerydel=true;
	}

	$reindex_depts=array_values($depts);
	$reindex_progs=array_values($progs);
	if(count($reindex_depts)>0)
	{
		for($y=0;$y<count($reindex_depts);$y++)
		{
			if(checkDupCSmain($subID,$reindex_depts[$y]))
			{
				$sqlinsert="Insert Into Categorize_Serials(DepartmentID,SubscriptionID,NumberOfItemReceived,Usage_Stat) Values(?,?,?,?)";
				$queryinsert=sqlsrv_query($conn,$sqlinsert,array($reindex_depts[$y],$subID,0,0));
			}
			else
			{
				$queryinsert=true;
			}
		}

		for($z=0;$z<count($reindex_progs);$z++)
		{
			$sqlinsert_prog="Insert Into Category_Serials_Program(ProgramID,SubscriptionID,NumberofItemsReceived_Prog) Values(?,?,?)";
			$queryinsert_prog=sqlsrv_query($conn,$sqlinsert_prog,array($reindex_progs[$z],$subID,0));
		}
	}
	else
	{
		$queryinsert=true;
	}

	if($queryinsert && $sqlquerydel)
	{
		$scs['status']='success';
	}
}

header('Content-type: application/json');
echo json_encode($scs);

 ?>