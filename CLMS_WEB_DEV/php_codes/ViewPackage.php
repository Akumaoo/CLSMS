

<?php 
require 'db.php';



if(isset($_POST['P_Name']))
{
$name=$_POST['P_Name'];

echo '

<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>

<div class="custom-panelbox">
	<div class="">
		<div class="">
			<h4 class="tag_style">Package '.$name.':</h4>
			<h4 class="dividerr"></h4>
		</div>
	</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Updated Serial Into This Package!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class=" custom_table">

		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_pack">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">DeliveryID</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Type Name</th>
					<th class="radio-label-center">Date Of Issue</th>
					<th class="radio-label-center">Issue Number</th>
					<th class="radio-label-center">Volume Number</th>
					<th class="radio-label-center">Copies</th>
				</tr>
				</thead>
				<tbody>
';

$getpid="Select PackageID from Package_Delivery where PackageName=?";
$querygetid=sqlsrv_query($conn,$getpid,array($name),$opt);
	if(sqlsrv_has_rows($querygetid))
	{
		while($row_id=sqlsrv_fetch_array($querygetid,SQLSRV_FETCH_ASSOC))
		{
			$pack_id=$row_id['PackageID'];
		}



		$sql="Select DeliveryID,SerialName,TypeName,DateofIssue,IssueNumber,VolumeNumber,Copies from Package_Delivery 
			Inner Join Delivery ON Package_Delivery.PackageID=Delivery.PackageID 
			INNER JOIN Serial ON Delivery.SerialID=Serial.SerialID 
			Inner Join [Type] ON Serial.TypeID=[Type].TypeID
			Where Package_Delivery.PackageID=?";
		$query=sqlsrv_query($conn,$sql,array($pack_id),$opt);
		if(sqlsrv_has_rows($query))
		{
			while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
			{
				$DelID=$row['DeliveryID'];
				$SN=$row['SerialName'];
				$TN=$row['TypeName'];
				if(isset($row['DateofIssue']))
				{
					$DOI=$row['DateofIssue']->format("Y/m/d");
				}
				else
				{
					$DOI=$row['DateofIssue'];
				}
				$IN=$row['IssueNumber'];
				$VN=$row['VolumeNumber'];
				$cop=$row['Copies'];

					echo '
						<tr class="gradeU">
							<td class="radio-label-center">'.$DelID.'</td>
							<td class="radio-label-center">'.$SN.'</td>									
							<td class="radio-label-center">'.$TN.'</td>									
							<td class="radio-label-center">'.$DOI.'</td>									
							<td class="radio-label-center">'.$IN.'</td>
							<td class="radio-label-center">'.$VN.'</td>
							<td class="radio-label-center">'.$cop.'</td>																
						</tr>
					';

			}
		}
	}
	echo '
					</tbody>
			</table>
		</div>
		
	</div>
	<div class="">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_delivery_data_Modal" class="custom-btn">Add New Serial!</button>
		</div>
	</div>
</div>
</div>';

include '../Modals/add_serial_pack_modal.php';
}

 ?>
 <script type="text/javascript" src="Js/View_pack_main.js"></script>