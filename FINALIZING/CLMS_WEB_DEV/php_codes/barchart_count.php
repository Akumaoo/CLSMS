  <?php

    $sqltxt="Select count(*) Count from Subscription WHERE Archive IS NULL And Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))";
    $query=sqlsrv_query($conn,$sqltxt,array(),$opt);

	while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
	{
		echo $rows['Count'];
	}

 ?>