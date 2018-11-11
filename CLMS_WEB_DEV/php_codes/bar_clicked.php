<?php 
require 'db.php';
if(isset($_POST['type']))
{
	$type=$_POST['type'];
	$inc=0;
	$titles=array();
	$subs_list=array();
	$sql="Select SerialID,SubscriptionID FROM Subscription Where Status=? AND Archive IS NULL";
	$query=sqlsrv_query($conn,$sql,array($type));
	if(sqlsrv_has_rows($query))
	{	
		while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$titles[$inc]=$rows['SerialID'];
			$subs_list[$inc]=$rows['SubscriptionID'];
			$inc++;

		}
	}
	
	

	function GetDepts($subsiD)
	{
		require 'db.php';
		$inc_dept=0;
		$depts=array();
		$sql="Select DepartmentID from Categorize_Serials Where SubscriptionID=?";
		$query=sqlsrv_query($conn,$sql,array($subsiD));
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$depts[$inc_dept]=$row['DepartmentID'];
				$inc_dept++;
			}
		}
		return $depts;

	}
	function GetSerialName($sID)
	{
		require 'db.php';
		$sql="Select SerialName From Serial Where SerialID=?";
		$query=sqlsrv_query($conn,$sql,array($sID));
		$row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$name=$row['SerialName'];
		return $name;
	}

	$list_titles=$titles;
	for($x=0;$x<count($list_titles);$x++)
	{
		$list_depts=GetDepts($subs_list[$x]);
		$string_depts="";
		for($y=0;$y<count($list_depts);$y++)
		{
			$string_depts.='['.$list_depts[$y].']';
	

		}

		echo 	'<h5><strong>Title: </strong>'.GetSerialName($list_titles[$x]).'</h5>
	            <h5><strong>Depts: </strong>'.$string_depts.'</h5>
	            <hr class="theme_hr">';

	}
}

 ?>