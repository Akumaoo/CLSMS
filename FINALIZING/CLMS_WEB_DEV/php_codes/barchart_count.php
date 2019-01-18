  <?php

    $sqltxt="Select count(*) Count from Subscription WHERE Archive IS NULL And Remove IS NULL AND Subscription_Date Between ".$bet;
    $query=sqlsrv_query($conn,$sqltxt,array(),$opt);

	while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		echo $rows['Count'];
	}

 ?>