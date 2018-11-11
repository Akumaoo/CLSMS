  <?php
	
	Function totalsubsc()
	{
		 require 'php_codes/db.php';
		 
		$sqltxt="Select Count(*) Countc From Subscription WHERE Archive IS NULL";
		$query=sqlsrv_query($conn,$sqltxt,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['Countc'];
		}

	}
	Function ongoingtotalc()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) Countd From Subscription where Subscription.Status ='Cancelled' AND Archive IS NULL";
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['Countd'];
		}

	}
	
	$total1 = totalsubsc();
	$ongoingtot1 = ongoingtotalc();
	
	$percent1 = ($ongoingtot1/$total1)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot1.' data-toggle="tooltip" data-placement="top">'.$percent1.'%</div>';
	
 ?>