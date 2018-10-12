<?php 
include 'Includes/header.php';
require 'php_codes/db.php';
session_start();

if($_SESSION['Role']=='Admin')
{
  include 'index_admin.php';
}
else
{
	 include 'index_staff.php';
}

 include 'Includes/footer.php';

 // check for deleyed deliveries
	if($_SESSION['Role']=='Admin')
	{

	 include 'php_codes/Check_Deliveries.php';
	 echo '<script type="text/javascript" src="Js/Index_main_admin.js"></script>';
	}
	else if($_SESSION['Role']=='Staff')
	{
		echo '<script type="text/javascript" src="Js/Index_staff.js"></script>';
	}

   ?>
</body>

</html>

<!-- CUSTOM SCRIPT -->
