
<?php 
require 'php_codes/db.php';
 ?>

<div id="Receive_Modal" class="modal fade">
	<div class="modal-dialog" style="margin:0 0 0 15%;">
		<div class="modal-content" style="width: 1000px;">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Receive Modal</h4>
			</div>
			<div class="modal-body">
			 <div class="container-fluid">
			 	<div class="row">
			 		<div class="col-lg-12">
			 			<div class="form form_custom form-panel" style="padding-top: 10px;min-height: 548px">
				 			<form class="cmxform form-horizontal style-form" id="SEND_RECEIVE" method="post">

			 				<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover">
							
							 <?php 
							 			echo '
											<thead class="thead_theme">
												<tr>
													<th class="radio-label-center" width="60" style="font-size: 10px;">Check All<br><input type="checkbox" id="SA"></th>
													<th class="radio-label-center">Control Number</th>
													<th class="radio-label-center">Serial Name</th>
													<th class="radio-label-center">Volume Number</th>
													<th class="radio-label-center">Issue Number</th>
													<th class="radio-label-center" >Date Of Issue</th>
													<th class="radio-label-center">Remarks</th>

												</tr>
											</thead>
											<tbody>
							 				';

							 		
									
									$sql="
									Select ReceivedSerialID,ReceiveSerial.DepartmentID,ControlNumber,SerialName,VolumeNumber,IssueNumber,DateofIssue,Staff_Comment
									 from Delivery Inner Join Delivery_Subs On Delivery.DeliveryID=Delivery_Subs.DeliveryID  Inner Join Subscription On Delivery_Subs.SubscriptionID=Subscription.SubscriptionID Inner JOin Serial On Subscription.SerialID=Serial.SerialID Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
									Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID WHERE (Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) OR Subscription.Status='OnGoing') AND Receive_Date=DateReceiveNotif_Give AND ReceiveSerial.Remove IS NULL And ReceiveSerial.Status='NotReceived' And ReceiveSerial.DepartmentID=?";
									$query=sqlsrv_query($conn,$sql,array($dept));
									if(sqlsrv_has_rows($query))
									{
										while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
										{
											$RSID=$row['ReceivedSerialID'];
											$cn=$row['ControlNumber'];
											$SerialName=$row['SerialName'];
											$vn=$row['VolumeNumber'];
											$in=$row['IssueNumber'];
											if(isset($row['DateofIssue']))
											{
												$doi=$row['DateofIssue']->format('Y-m-d');
											}
											else
											{
												$doi=$row['DateofIssue'];
											}
											$sc=$row['Staff_Comment'];

											echo '
												<tr>
												<td>
												<input type="checkbox" name="rs_id" value="'.$RSID.'" style="margin-left:16px">
												</td>
												<td>
												<input type="number"  class="cn" name="cont_no" value="'.$cn.'">
												</td>
												<td>'.$SerialName.'</td>
												<td>'.$vn.'</td>
												<td>'.$in.'</td>
												<td>'.$doi.'</td>
												<td>
												<textarea rows="1" cols="35" name="sc" form="SEND_RECEIVE" required class="text_area">'.$sc.'</textarea>
												</td>
												</tr>
													';
										}
									}
								 ?> 

							</tbody>
							</table>


				 				<div class="form-group form-group-center">
				 					<div class="col-lg-offset-9">
				 						<button class="custom-btn" type="submit" id="btn_insert" value="save" name="save" style="width: 160px;">Receive Serial!</button>
				 					</div>
				 				</div>
				 			</form>
			 			</div>
			 		</div>
			 	</div><!--row-->
			 </div><!--container-->
			</div><!--modal-body-->
		</div>
	</div>
</div>

