<?php 
require '../php_codes/db.php';

$data=$_POST['data'];
$date=strtotime($_POST['date']);
$newdate=date('Y-m-d',$date);
$seen=$_POST['seen'];
if($seen=="Seen")
{
	$seen_stat='Staff_Seen IS NOT NULL';
}
else
{
	$seen_stat='Staff_Seen IS NULL';
}

$table=<<<EOT
 (Select SerialName,ReceivedSerialID,ReceiveSerial.DepartmentID,ReceiveSerial.DateReceiveNotif_Give,Staff_Seen,ReceiveSerial.Remove as remv_main from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
  Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status='NotReceived' and ReceiveSerial.Remove IS NULL
) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'DateReceiveNotif_Give','dt'=>3),
	array('db'=>'Staff_Seen','dt'=>4)

);

require( 'ssp.php' );
if($data!="")
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"DepartmentID='".$data."' AND ".$seen_stat." AND DateReceiveNotif_Give='".$newdate."' AND (remv_main IS NULL)")
	);
}
else
{
	echo json_encode(
		SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
	);
}

 ?>
