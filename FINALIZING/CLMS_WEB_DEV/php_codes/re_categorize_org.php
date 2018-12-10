<?php 
require 'db.php';	
// $_POST['list']='BS,IT';
// // $_POST['list']='BS';
// $_POST['orgID']='asd';
if(!empty($_POST))
{
	$list_string=$_POST['list'];
	$orgID=$_POST['orgID'];
	
	$list_array=explode(',', $list_string);

	function checkorg($orgID)
	{
		require 'db.php';
		$sql="Select Count(*) as rows from Organization Where  OrganizationID=?";
		$query=sqlsrv_query($conn,$sql,array($orgID));
		$rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
		$num_rows=$rows['rows'];
		if($num_rows>0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function getKey($needle,$haystack)
	{
		$key='NotFound';
		for($x=0;$x<count($haystack);$x++)
		{
			if($needle==$haystack[$x])
			{
				$key=$x;
				break;
			}

		}

		return $key;
	}
	
	if(checkorg($orgID))
	{
		// GET CURRENT LIST PROGRAMS

		$clistsql="Select ProgramID from Organization Inner Join Program On Organization.OrganizationID=Program.OrganizationID Where Organization.OrganizationID=?";
		$clistquery=sqlsrv_query($conn,$clistsql,array($orgID));
		$inc=0;
		$clist=[];
		if(sqlsrv_has_rows($clistquery))
		{
			while($row=sqlsrv_fetch_array($clistquery,SQLSRV_FETCH_ASSOC))
			{
				$clist[$inc]=$row['ProgramID'];
				$inc++;
			}
		}

		// REMOVE PROGRAMS THAT ARE NOT IN THE NEW LIST
		for($x=0;$x<count($clist);$x++)
		{
			if(in_array($clist[$x],$list_array))
			{
				$key=getKey($clist[$x],$list_array);
			 	unset($list_array[$key]);			
			}
			else
			{
				$sqlrem="Delete from Program Where ProgramID=?";
				$remquery=sqlsrv_query($conn,$sqlrem,array($clist[$x]));
			}
		}

		$new_array_list=array_values($list_array);//RE-ARRANGE ARRAY KEYS


		// INSERTING THE FILTERED NEW PROG LIST
		if(count($new_array_list)>0)
		{
			for($z=0;$z<count($new_array_list);$z++)
			{
				$sqlinsert="Insert Into Program(ProgramID,OrganizationID) VALUES(?,?)";
				$insertquery=sqlsrv_query($conn,$sqlinsert,array($new_array_list[$z],$orgID));

			}
		}
		else
		{
			$insertquery=true;
		}

		if($insertquery)
		{
			$scs['status']="success";
		}
		else
		{
			$scs['status']="<br><strong>ERROR ON:</strong> Inserting New Programs";
		}

	}
	else
	{
		$scs['status']="Organization Name Doesn't Exist!";
	}

}

header('Content-type: application/json');
echo json_encode($scs);

 ?>