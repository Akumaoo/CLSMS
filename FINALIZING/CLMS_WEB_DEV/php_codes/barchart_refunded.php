  <?php
	
	Function ongoingtotalr()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) CountB From Subscription where Subscription.Status ='Refunded' AND Archive IS NULL And Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))";
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountB'];
		}

	}
	
	$ongoingtot = ongoingtotalr();
	
	$percent = ($ongoingtot/$total)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot.' data-toggle="tooltip" data-placement="top">'.$percent.'%</div>';
	
 ?>