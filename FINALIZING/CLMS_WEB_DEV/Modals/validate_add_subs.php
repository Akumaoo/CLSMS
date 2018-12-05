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
if((CheckDisbtributor($disbname)!='NotValid'))
{
	$scs['status']='success';
	$scs['disbID']=CheckDisbtributor($disbname);
	$scs['disbname']=$disbname;
}
else
{
	$scs['status']='fail';


}
 header('Content-type: application/json');
 echo json_encode($scs);

?>
