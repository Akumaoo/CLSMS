<?php
 session_start();
require'php_codes/db.php';
if(isset($_SESSION['current_user']))
{
  header ("Location:index.php");
}


if(isset($_POST['submit'])){
    
    $username = $_POST['UserName'];
    $password = md5($_POST['Password']);
    
    
    $sql = "SELECT * from [User] WHERE UserName = ? AND Password = ?";
    $query=sqlsrv_query($conn,$sql,array($username, $password));
    if(sqlsrv_has_rows($query)){
        while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)){
         $dbusername=$row['UserName'];
         $dbrole=$row['Role'];
         $avat=$row['Avatar'];
        $dbdepartment=$row['DepartmentID'];
        $fn=$row['FirstName'];
        $ln=$row['LastName'];
        $mail=$row['Email'];
        $uID=$row['UserID'];
            
        }      
            
            $_SESSION['current_user'] = $dbusername;
            $_SESSION['Role']=$dbrole;
            $_SESSION['Avatar']=$avat;
            $_SESSION['Dept']=$dbdepartment;
            $_SESSION['FirstName']=$fn;
            $_SESSION['LastName']=$ln;
            $_SESSION['Email']=$mail;
            $_SESSION['uID']=$uID;
            header ("Location:index.php");        
    }
      

    

}
	
 ?>
 
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

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
	  	
		      <form class="form-login" method="post">
		        <h2 class="form-login-heading">Sign In now</h2>
		        <div class="login-wrap">
					<div >
						<a  class="logo" ><b><span>CL</span>SMS</b></a>
					</div>
				
					
					  
		            <input type="text" class="form-control" name="UserName" id="username" placeholder="User ID" autofocus>
		            <br>
		            <input type="password" class="form-control" name="Password" id="password" placeholder="Password">
		           
		            <button class="btn btn-theme btn-block" name="submit" value="submit" type="submit"  style="margin-top: 20px;"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		            
		            <div >
		            
		            </div>
		            
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
<script>
    $(function(){
        $('#loginid_form').on('submit',function(event){
        event.preventDefault();
        
        if($("#username").val()=="" && $("#password").val()==""){
            alert("Username and Password is required!")
        }
        else{
            
        }
                
    });
     
     });
</script>
