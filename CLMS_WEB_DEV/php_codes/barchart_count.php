  <?php

    $sqltxt="Select count(*) Count from Subscription WHERE Archive IS NULL";
    $query=sqlsrv_query($conn,$sqltxt,array(),$opt);

	while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		echo $rows['Count'];
	}

 ?>