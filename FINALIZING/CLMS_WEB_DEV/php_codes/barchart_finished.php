  <?php

	Function ongoingtotalf()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) CountB From Subscription where Subscription.Status ='Finished' AND Archive IS NULL And Remove IS NULL AND Subscription_Date Between ".$bet;
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountB'];
		}

	}
	
	$ongoingtot = ongoingtotalf();
	
	@$percent = ($ongoingtot/$total)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot.' data-toggle="tooltip" data-placement="top">'.$percent.'%</div>';
	
 ?>