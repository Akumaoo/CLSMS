  <?php
	
	Function totalsubsr()
	{
		 require 'php_codes/db.php';
		 
		$sqltxt="Select Count(*) CountA From Subscription WHERE Archive IS NULL";
		$query=sqlsrv_query($conn,$sqltxt,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountA'];
		}

	}
	Function ongoingtotalr()
	{
		 require 'php_codes/db.php';
		$sqltxt1="Select Count(*) CountB From Subscription where Subscription.Status ='Refunded' AND Archive IS NULL";
		$query=sqlsrv_query($conn,$sqltxt1,array());
			while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
		{
		
		return $rows['CountB'];
		}

	}
	
	$total = totalsubsr();
	$ongoingtot = ongoingtotalr();
	
	$percent = ($ongoingtot/$total)*100;
	
	echo ' <div class="value tooltips" data-original-title='.$ongoingtot.' data-toggle="tooltip" data-placement="top">'.$percent.'%</div>';
	
 ?>