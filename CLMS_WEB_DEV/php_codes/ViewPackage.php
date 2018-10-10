

<?php 
require 'db.php';



if(isset($_POST['P_Name']))
{
$name=$_POST['P_Name'];

echo '
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<h5 class="tag_style">Package '.$name.':</h5>
			<hr class="theme_hr">
		</div>
	</div>

	<div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
	    <strong>Successfully Updated Serial Into This Package!</strong>
 	 </div>

  	<div class="alert alert-danger alert-dismissible collapse center" id="msg_fail">
	    <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
  	</div>

	<div class="row custom_table">

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
	<div class="row">
		<div class="col-lg-offset-9">
			<button type="button" name="New_pack" id="New_pack" data-toggle="modal" data-target="#add_delivery_data_Modal" class="custom-btn">Add New Serial!</button>
		</div>
	</div>
</div>';

include '../Modals/add_serial_pack_modal.php';
}

 ?>
 <script>
 	$(function(){
 		if( ! $.fn.DataTable.isDataTable("#table_pack")){
		$('#table_pack').DataTable({			
		// "processing":true,
		// "serverSide":true,
		"ordering":true,
		"searching":true,
		"pageLength":100
		// "ajax":"php_codes/serverside_currentSubs.php",
			});


		}

		$('#table_pack').Tabledit({
		url:"php_codes/modify_delivery_pack.php",
		columns:{
		identifier:[0,"DeliveryID"],
		editable:[[3,"DateofIssue"],[4,"IssueNumber"],[5,"VolumeNumber"],[6,'Copies']]
			},
		onSuccess:function(data,textStatus,jqXHR)
		{
			if(data.action=='delete')
			{
				$("#"+data.DeliveryID).remove();			
			}
			else if(data.status=='success')
			{
				$('#msg_scs').removeClass('collapse');
			}
		},onDraw: function() {
			$('tbody tr td:nth-child(4)>input').each(function(){
				$('<input class="tabledit-input form-control input-sm" type="date" style="display: none;" disabled="">').attr({ name: this.name, value: this.value }).insertBefore(this)
			}).remove()
 		 }
	
		});

	
		$('#create_new_delivery').on('submit',function(event){
		event.preventDefault();

		var d = new Date();

		var month = d.getMonth()+1;
		var day = d.getDate();

		var output_date_today = d.getFullYear() + '/' +
		    (month<10 ? '0' : '') + month + '/' +
		    (day<10 ? '0' : '') + day;


	 	if($("#SN").val()=="")
	 	{
	 		alert("Serial Name Is Required");
	 	}
	 	else if(new Date($('#DOI').val())<=new Date(output_date_today))
	 	{
	 		alert("Date of Issue Is Past The Date Today");
	 	}
	 	else if($("#Copy").val()=="")
	 	{
	 		alert('Number of Copies Is Required');
	 	}
	 	else{
	 		$.ajax({
	 			url:"php_codes/insert_serial_pack.php",
	 			method:"POST",
	 			data:$("#create_new_delivery").serialize(),
	 			success:function(data)
	 			{
 					$("#create_new_delivery")[0].reset();
 					if(data.status=='success')
 					{
 						$("#msg_scs_modal").removeClass('collapse');
 						$('#save_btn').addClass('collapse');
 						$('#retry').removeClass('collapse');

 					}
 					else
 					{
 						$('#add_delivery_data_Modal').modal('hide');
 						$("#msg_fail").removeClass('collapse');
 					}
	 			},
	 			error:function(){
	 				$("#create_new_delivery")[0].reset();
 					$("#add_delivery_data_Modal").modal('hide');
	 				$("#msg_fail").removeClass('collapse');
	 			}
	 		});
	 	}
	});

	$('#btn_yes').click(function(){
		$("#msg_scs_modal").addClass('collapse');
		$("#create_new_delivery")[0].reset();
		$('#save_btn').removeClass('collapse');
 		$('#retry').addClass('collapse');
	});

	$('#btn_no').click(function(){
		$("#create_new_delivery")[0].reset();
		$('#add_delivery_data_Modal').modal('hide');
	});

	$('#add_delivery_data_Modal').on('hidden.bs.modal', function(){
 			if(!$('#msg_fail_modal').hasClass('collapse'))
 			{
 				$('#msg_fail_modal').addClass('collapse');
 			}
 	});

 	});
 </script>