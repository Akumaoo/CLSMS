<?php 
require '../php_codes/db.php';
$disbname=$_POST['DN'];
$pack_name=$_POST['PN'];
// $disbname='Hajie';
// $pack_name='asd';
function CheckDisbtributor($disb){
	require '../php_codes/db.php';
	$Dname=$disb;
	$checksql="Select * from [Distributor] Where [Distributor].[DistributorName]=?";
	$query=sqlsrv_query($conn,$checksql,array($disb),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$DisbID=$row["DistributorID"];
			return $DisbID;
		}
	}
	else
	{
		return "NotValid";
	}
}


function CheckPackName($pn)
{
	require '../php_codes/db.php';
	$sql="Select PackageID FROM Package_Delivery Where PackageName=?";
	$query=sqlsrv_query($conn,$sql,array($pn),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
			$id=$row['PackageID'];
			return $id;
		}
	}
	else
	{
		return 'NotValid';
	}
}
function CheckPackDistributor($pn2)
{
	require '../php_codes/db.php';
	$cpd="Select DistributorID From Package_Delivery Where PackageName=?";
	$cpdquery=sqlsrv_query($conn,$cpd,array($pn2),$opt);
	if(sqlsrv_has_rows($cpdquery))
	{
		while($row=sqlsrv_fetch_array($cpdquery,SQLSRV_FETCH_ASSOC))
		{
			$Disb_id=$row['DistributorID'];
			return $Disb_id;
		}
	}
	else
	{
		return 'NotValid';
	}
}
if((CheckDisbtributor($disbname)!='NotValid' && CheckPackName($pack_name)!='NotValid') && (CheckDisbtributor($disbname)==CheckPackDistributor($pack_name)))
{
	$scs['status']='success';
}
else
{
	$scs['status']='fail';


}
 header('Content-type: application/json');
 echo json_encode($scs);

?>
