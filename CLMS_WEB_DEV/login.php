<?php if (isset($_POST['login'])){
        header('location: index.php');
    } 
	
require "php_codes/db.php"
 ?>
 
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CLSMS</title>

    <!-- Bootstrap core CSS -->
    <link href="lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
	 <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
	<link href="css/customlogin.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    
</head>
<body>
  	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="index.php" method="post">
		        <h2 class="form-login-heading">Sign In now</h2>
		        <div class="login-wrap">
					<div >
						<a  class="logo" ><b><span>CL</span>SMS</b></a>
					</div>
				
					
					  
		            <input type="text" class="form-control" placeholder="User ID" autofocus>
		            <br>
		            <input type="password" class="form-control" placeholder="Password" style="margin-bottom: 15px;">
		            <button class="btn btn-theme btn-block" href="index.php" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		        </div>
		
		          <!-- Modal -->
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                    
		                      
		                      
		                  </div>
		              </div>
		          </div>
		
		      </form>	  	
	  	
	  	</div>
	  </div>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("img/login-bg.jpg", {speed: 500});
    </script>
  </body>