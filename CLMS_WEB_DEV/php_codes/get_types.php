<?php 

require 'db.php';
$sql="Select TypeName from [Type]";
$query=sqlsrv_query($conn,$sql,array());
if(sqlsrv_has_rows($query))
{
$list="";
	while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		$name=$row['TypeName'];
		$list.='<option value="'.$name.'">'.$name.'</option>';

	}
	echo $list;
}
 ?>
