<?php 
require 'db.php';

if(!empty($_POST))
{
	$serialname=$_POST['serialname'];
	$catid = $_POST['CategoryID'];
	$deptid = $_POST['DepartmentID'];
	$type=$_POST['type'];
	$departmentid=$_POST['DepartmentID'];
	$checkbox1=$_POST['dept']
	$chk="";
	for ($j=0; $j < count($_POST['dept']);$j++) 
{
    $insert="INSERT INTO Categorize_Serials (CategoryID, DepartmentID, DepartmentName) VALUES ?,?,'".$_POST['lol'][$j]."'");
}	$queryinsert1=sqlsrv_query($conn,$insert. array($catid, $deptid, '".$_POST['dept'][$j]."'));

		
\
	{
		$insertsql="Insert INTO Distributor(DistributorName,NameOfIncharge,ContactNumber,Email) VALUES(?,?,?,?)";
		$queryinsert=sqlsrv_query($conn,$insertsql,array($name,$NOI,$contact,$mail),$opt);
		if($queryinsert)
			{
				$scs['status']="success";
			}
			else
			{
				$scs['status']='fail';
			}
		 header('Content-type: application/json');
		echo json_encode($scs);
	}
}
 ?>