  <?php
	
	Function totalsubs()
	{
		 require 'php_codes/db.php';
		 
		$sqltxt="Select Count(*) as CountA From Subscription WHERE Archive IS NULL And Remove IS NULL 
		AND Subscription_Date Between ".$bet;
		$query=sqlsrv_query($conn,$sqltxt,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountA'];
		}

	}
	Function ongoingtotal()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) CountB From Subscription where Subscription.Status ='OnGoing' AND Archive IS NULL And Remove IS NULL AND Subscription_Date Between ".$bet;
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountB'];
		}

	}
	
	$total = totalsubs();
	$ongoingtot = ongoingtotal();
	
	@$percent = ($ongoingtot/$total)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot.' data-toggle="tooltip" data-placement="top">'.$percent.'%</div>';
	
 ?>