<?php 
require '../php_codes/db.php';

$data=$_POST['data'];
$date=strtotime($_POST['date']);
$newdate=date('Y-m-d',$date);
$seen=$_POST['seen'];
if($seen=="seen")
{
	$seen_stat='Staff_Seen IS NOT NULL';
}
else
{
	$seen_stat='Staff_Seen IS NULL';
}

$table=<<<EOT
 (Select SerialName,ReceivedSerialID,asd.DepartmentID,asd.DateReceiveNotif_Give,Staff_Seen,asd.Remove as remv_main,ReceiveSerialID_Program,ProgramID,dsa.Remove as remv_prog from
	(Select ReceivedSerialID,ReceiveSerial.DepartmentID,SerialName as sn_main,Status,DateReceiveNotif_Give,ReceiveSerial.Remove,Staff_Seen,SerialName from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
	Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status='NotReceived' and ReceiveSerial.Remove IS NULL) as asd
	Left Join
	(Select ReceiveSerialID_Program,Organization.DepartmentID,SerialName as sn_prog,Organization.OrganizationID,ReceiveSerial_Program.ProgramID,DateReceiveNotif_Give_Prog,ReceiveSerial_Program.Remove from Serial Inner Join ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
	Inner Join Program On ReceiveSerial_Program.ProgramID=Program.ProgramID
	inner Join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID where (sn_main=sn_prog OR sn_prog IS NULL)  AND (asd.Remove IS NULL and dsa.Remove IS NULL)) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'ReceiveSerialID_Program','dt'=>3),	
	array('db'=>'ProgramID','dt'=>4),
	array('db'=>'DateReceiveNotif_Give','dt'=>5),
	array('db'=>'Staff_Seen','dt'=>6)

);

require( 'ssp.php' );
if($data!="")
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"DepartmentID='".$data."' AND ".$seen_stat." AND DateReceiveNotif_Give='".$newdate."' AND (remv_main IS NULL AND remv_prog IS NULL)")
	);
}
else
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
	);
}

 ?>
