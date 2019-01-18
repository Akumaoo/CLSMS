  <?php
	Function ongoingtotalc()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) Countd From Subscription where Subscription.Status ='Cancelled' AND Archive IS NULL And Remove IS NULL AND Subscription_Date Between ".$bet;
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['Countd'];
		}

	}
	
	$ongoingtot1 = ongoingtotalc();
	
	@$percent1 = ($ongoingtot1/$total)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot1.' data-toggle="tooltip" data-placement="top">'.$percent1.'%</div>';
	
 ?>