<?php 
include 'Includes/header.php';
require 'php_codes/db.php';
?>

 <section id="main-content">
      <section class="wrapper">
        <div class="row" id='whole_page'>
          <div class="col-lg-12 main-chart">

            <div class="row">
            	
<?php
echo '

	<div id="search_subs">
		<form method="POST" class="search_tab">
			<input type="text" placeholder="Search..." name="Search">
			<select class="select_drop" name="stat">
				<option style="display:none">---Status---</option>
				<option value="OnGoing">OnGoing</option>
				<option value="Cancelled">Cancelled</option>
				<option value="Refunded">Refunded</option>
				<option value="Finished">Finished</option>
			</select>
		</form>

	</div>

<div class="adv-table custom_table">
	<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
		<thead class="thead_theme">
			<tr>
				<th class="radio-label-center">Distributor</th>
				<th class="radio-label-center">Serial</th>
				<th class="radio-label-center">Frequency</th>
				<th class="radio-label-center">Cost</th>
				<th class="radio-label-center">Received</th>
				<th class="radio-label-center">Status</th>
			</tr>
		</thead>
		<tbody>';

	if(@$_POST['stat']=='---Status---')
	{
		$_POST['stat']=null;
	}
	if((@(isset($_POST['Search']) && $_POST['Search']!="")))
	{
		if((isset($_POST['Search']) && $_POST['Search']!="") && isset($_POST['stat']))
		{
			$name=$_POST['Search'];
			$status=$_POST['stat'];
			$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID] Where [Distributor].[DistributorName]=? OR [Serial].[SerialName]=? AND [Subscription].[Status]=?";
			$query=sqlsrv_query($conn,$sqltxt,array($name,$name,$status),$opt);
			if(sqlsrv_has_rows($query))
			{
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$distname=$row['DistributorName'];
					$serialname=$row['SerialName'];
					$orders=$row['Orders'];
					$cost=$row['Cost'];
					$NIR=$row['NumberOfItemReceived'];
					$stat=$row['Status'];
			echo '
					<tr class="gradeU">
						<td class="radio-label-center">'.$distname.'</td>
						<td class="radio-label-center">'.$serialname.'</td>
						<td class="radio-label-center">'.$orders.'</td>
						<td class="radio-label-center">'.$cost.'</td>
						<td class="radio-label-center">'.$NIR.'</td>
						<td class="radio-label-center">'.$stat.'</td>
					</tr>

				';
				}
				unset($_POST['Search']);
				unset($_POST['stat']);
			}
		}
		else
		{
			$name=$_POST['Search'];
			$status=$_POST['stat'];
			$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID] Where [Distributor].[DistributorName]=? OR [Serial].[SerialName]=?";
			$query=sqlsrv_query($conn,$sqltxt,array($name,$name),$opt);
			if(sqlsrv_has_rows($query))
			{
				while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
				{
					$distname=$row['DistributorName'];
					$serialname=$row['SerialName'];
					$orders=$row['Orders'];
					$cost=$row['Cost'];
					$NIR=$row['NumberOfItemReceived'];
					$stat=$row['Status'];
			echo '
					<tr class="gradeU">
						<td class="radio-label-center">'.$distname.'</td>
						<td class="radio-label-center">'.$serialname.'</td>
						<td class="radio-label-center">'.$orders.'</td>
						<td class="radio-label-center">'.$cost.'</td>
						<td class="radio-label-center">'.$NIR.'</td>
						<td class="radio-label-center">'.$stat.'</td>
					</tr>

				';
				}
				unset($_POST['Search']);
				unset($_POST['stat']);	
			}
		}

	}
	else if(isset($_POST['stat']))
	{
		$status=$_POST['stat'];
		$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID] Where [Subscription].[Status]=?";
		$query=sqlsrv_query($conn,$sqltxt,array($status),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$distname=$row['DistributorName'];
				$serialname=$row['SerialName'];
				$orders=$row['Orders'];
				$cost=$row['Cost'];
				$NIR=$row['NumberOfItemReceived'];
				$stat=$row['Status'];
		echo '
				<tr class="gradeU">
					<td class="radio-label-center">'.$distname.'</td>
					<td class="radio-label-center">'.$serialname.'</td>
					<td class="radio-label-center">'.$orders.'</td>
					<td class="radio-label-center">'.$cost.'</td>
					<td class="radio-label-center">'.$NIR.'</td>
					<td class="radio-label-center">'.$stat.'</td>
				</tr>
			';
			}
			unset($_POST['Search']);
			unset($_POST['stat']);
		}
	}
	else
	{
		$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID]";
		$query=sqlsrv_query($conn,$sqltxt,array(),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$distname=$row['DistributorName'];
				$serialname=$row['SerialName'];
				$orders=$row['Orders'];
				$cost=$row['Cost'];
				$NIR=$row['NumberOfItemReceived'];
				$stat=$row['Status'];

		echo '
					<tr class="gradeU">
						<td class="radio-label-center">'.$distname.'</td>
						<td class="radio-label-center">'.$serialname.'</td>
						<td class="radio-label-center">'.$orders.'</td>
						<td class="radio-label-center">'.$cost.'</td>
						<td class="radio-label-center">'.$NIR.'</td>
						<td class="radio-label-center">'.$stat.'</td>
					</tr>
			';
			}
		}
	}
	echo	'</tbody>
				
			</table>
		</div>';
?>
 </div>
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
        </div>
        <!-- /row -->
      </section>

    </section>
    <!--main content end-->
   <?php
   include 'Includes/footer.php';
   ?>
 
  <!--script for this page-->
   <script src="lib/zabuto_calendar.js"></script>
</body>

</html>



