<div class="container-fluid">
			<div class="row custom-boxxx">		
		        <div>
					<h2 class="custom-sect2 ">College Library Serial Monitoring System</h2><br>
				</div>
			</div>
			
<div class=" custom-panelbox">			
	<div class="">
		<div class="">
			<h4 class="fa fa-truck tag_style "> Manage Deliveries:</h4>
			<h4 class="dividerr"></h4>
		</div>

	<div class="custom_table" >
		<div class="col-lg-10 col-lg-offset-1">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_deli">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">Delivery ID</th>
					<th class="radio-label-center">Distributor Name</th>
					<th class="radio-label-center">Serial Name</th>
					<th class="radio-label-center">Date of Issue</th>
					<th class="radio-label-center">Volume Number</th>
					<th class="radio-label-center">Issue Number</th>
					<th class="radio-label-center">Copies</th>
					<th class="radio-label-center">Receive Date</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>

		<div>
			<div class="col-lg-offset-9">
				<button type="button" name="deliv_rec" id="deliv_rec" data-toggle="modal" data-target="#receive_deliv_modal" class="custom-btn">Receive Delivery</button>
			</div>
		</div>
	</div>

</div>
</div>
<?php 
include 'Modals/Receive_Ser_Deliv_Modal.php';
 ?>

<script type="text/javascript" src="Js/Delivery_main.js?v=16"></script>