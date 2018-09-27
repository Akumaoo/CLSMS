	<?php
		if(isset($_SESSION['Error']))
		{
		echo	"<div class='row' id='Error'>";
		echo		"<div class='col-md-12'>";
		echo 			'<div class="alert-error">';
		echo 				'<p class="text-center" style="padding-top:13px;"><i class="fa fa-info-circle" style="margin-right:16px;"></i>'.$_SESSION['Error'].'</p>';
		echo 			'</div>';
		echo		"</div>";
		echo	"</div>";
			unset($_SESSION['Error']);
		}
		else if(isset($_SESSION['Success']))
		{
		echo	"<div class='row' id='Success'>";
		echo		"<div class='col-md-12'>";
		echo 			'<div class="alert-success">';
		echo 				'<p class="text-center" style="padding-top:13px;"><i class="fa fa-check" style="margin-right:16px;"></i>'.$_SESSION['Success'].'</p>';
		echo 			'</div>';
		echo		"</div>";
		echo	"</div>";
			unset($_SESSION['Success']);
	}
	?>