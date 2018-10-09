<?php 
require 'db.php';

$input=filter_input_array(INPUT_POST);
if(!$_POST['DateofIssue'])
{
	$DOI=NULL;
}
else
{
	$DOI=$_POST['DateofIssue'];
}
if($_POST['IssueNumber']=="" || $_POST['IssueNumber']==0)
{
	$IN=NULL;
}
else
{
	$IN=$_POST['IssueNumber'];
}
if($_POST['VolumeNumber']==0 || $_POST['VolumeNumber']=="")
{
	$VN=NULL;
}
else
{
	$VN=$_POST['VolumeNumber'];
}
$cop=$_POST['Copies'];
$delID=$_POST['DeliveryID'];

if($input['action']=='edit')
{
	$sql="Update Delivery Set DateofIssue=?,IssueNumber=?,VolumeNumber=?,Copies=? Where DeliveryID=?";
	$query=sqlsrv_query($conn,$sql,array($DOI,$IN,$VN,$cop,$delID),$opt);
	$input['status']='success';

}
else if($input['action']=='delete')
{
	$sqltxtdel="Delete FROM Delivery Where DeliveryID=?";
	$querydel=sqlsrv_query($conn,$sqltxtdel,array($delID),$opt);
}

echo json_encode($input);

 ?>