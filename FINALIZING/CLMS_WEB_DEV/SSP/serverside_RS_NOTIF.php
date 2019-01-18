<?php 
require '../php_codes/db.php';

// $_POST['data']='ELEM';
// $_POST['date']='Dec-07-2018';

if($_POST['data']!="")
{
	$data="AND ReceiveSerial.DepartmentID='".$_POST['data']."'";
	$date=strtotime($_POST['date']);
	$newdate=date('Y-m-d',$date);

	$date_string_up="AND (DateReceiveNotif_Receive='".$newdate."')";

	
}
else
{
	$data="";
	$date_string_up="";
}

$table=<<<EOT
 (Select SerialName,TypeName,ReceivedSerialID,ReceiveSerial.DepartmentID,ReceiveSerial.DateReceiveNotif_Give,Staff_Seen,ReceiveSerial.Remove as remv_main from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
  Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status='Received' and ReceiveSerial.Remove IS NULL
  AND DateReceiveNotif_Give Between $bet $data $date_string_up
	) temp
EOT;

$primary_key='ReceivedSerialID';

$columns=array(
	array('db'=>'ReceivedSerialID','dt'=>0),
	array('db'=>'DepartmentID','dt'=>1),
	array('db'=>'SerialName','dt'=>2),
	array('db'=>'TypeName','dt'=>3)

);

require( 'ssp.php' );
echo json_encode(
	SSP::complex( $_POST, $sql_details, $table, $primary_key, $columns,null,"")
);


 ?>
