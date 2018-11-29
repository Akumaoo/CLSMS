<?php 
echo '
		<div class="col-lg-10 col-lg-offset-1">	
			<span class="fa fa-cog fa-lg cog_action" id="cog_action"></span>								
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_user">
				<thead class="thead_theme">
				<tr>
					<th class="radio-label-center">UserID</th>
					<th class="radio-label-center">Username</th>
					<th class="radio-label-center">First Name</th>
					<th class="radio-label-center">Last Name</th>
					<th class="radio-label-center">Email</th>
					<th class="radio-label-center">Role</th>
					<th class="radio-label-center">Department</th>
					<th class="radio-label-center">Remarks</th>
				</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

			<button class="custom-btn collapse" id="PRS" style="float: left;height: 43px;margin-left: 0">Permanently Remove Selected</button>
			<button class="custom-btn collapse" id="RS" style="float: right;height: 43px;">Retrieve Selected</button>
		</div>

			<script src="Js/recycle/User.js?v=1" type="text/javascript"></script>
			';
 ?>