<?php
	require 'db.php';

	$name=$_POST['name'];
	$status=$_POST['stat'];
	$sqltxt="Select [Distributor].[DistributorName],[Serial].[SerialName],[Subscription].[Orders],[Subscription].[Cost],[Subscription].[NumberOfItemReceived],[Subscription].[Status] From [Distributor] Inner Join [Subscription] ON [Distributor].[DistributorID]=[Subscription].[DistributorID] Inner Join [Serial] ON [Subscription].[SerialID]=[Serial].[SerialID] Where [Distributor].[DistributorName]=? OR [Serial].[SerialName]=? AND [Subscription].[Status]=?";
	$query=sqlsrv_query($conn,$sqltxt,array($name,$name,$Status),$opt);
	if(sqlsrv_has_rows($query))
	{
		while($rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
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
	echo	'</tbody>
		
	</table>
</div>

    <script type="text/javascript">
     $(function(){
     		var fname=$("input[type=text][name=search]").val();
     		var fstat=$("select#stat option:checked").val();
           $(".button_search").click(function(){
                $.ajax({
                	method:"POST",
                	url:php_codes/search_subs.php,
                	data:{name:fname,status:fstat}
                	success:function(data){
						$("table_body").html(data)
                	}
                	});
             });
         });
    </script>

	';
	}

?>