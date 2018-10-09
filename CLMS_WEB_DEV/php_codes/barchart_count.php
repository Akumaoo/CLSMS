  <?php

    $sqltxt="Select count(*) Count from Subscription";
    $query=sqlsrv_query($conn,$sqltxt,array(),$opt);

	while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		echo $rows['Count'];
	}

 ?>