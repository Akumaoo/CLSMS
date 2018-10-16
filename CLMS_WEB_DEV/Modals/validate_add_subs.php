<?php 
require '../php_codes/db.php';
$disbname=$_POST['DN'];
// $disbname='Hajie';
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
function CheckDistributortype($pn2)
{
	require '../php_codes/db.php';
	$cpd="Select Distributor_Type From Distributor Where DistributorID=?";
	$cpdquery=sqlsrv_query($conn,$cpd,array($pn2));
	if(sqlsrv_has_rows($cpdquery))
	{
		while($row=sqlsrv_fetch_array($cpdquery,SQLSRV_FETCH_ASSOC))
		{
			$Disb_id=$row['Distributor_Type'];
			return $Disb_id;
		}
	}
	else
	{
		return 'NotValid';
	}
}
if((CheckDisbtributor($disbname)!='NotValid'))
{
	$scs['status']='success';
	$scs['disbID']=CheckDisbtributor($disbname);
	$scs['disbname']=$disbname;
	$scs['disbtype']=CheckDistributortype(CheckDisbtributor($disbname));
}
else
{
	$scs['status']='fail';


}
 header('Content-type: application/json');
 echo json_encode($scs);

?>
