<?php
session_start();
include 'includes/header.php';

?>

<div class="">
<div class="custom-panelbox1">
<?php 
  echo '
     <div class="centered profile-pic "><img src="img/Avatars/'.$_SESSION['Avatar'].'"weight="180px" height="180px" alt="No-Image"></div>
    <h4 class="centered prof-text ">'.$_SESSION['current_user'].'</h4>
     ';
 


    echo '
    
    <h4 class="centered prof-text "> '.$_SESSION['LastName'].', '.$_SESSION['FirstName'].'</h4>
     ';                  
?>

</div>

      <!---TAb-->
<div class="content-panel">

            <div class="">
              <ul class="nav nav-tabs nav-justified">
                <li class="active">
                  <a data-toggle="tab" href="#allusers">ALL USERS</a>
                </li>
                <li>
                  <a data-toggle="tab" href="#edit">EDIT PROFILE</a>
                </li>
              </ul>
            </div>
    <!---TAb-->  
  <div class="panel-body">
    <div class="tab-content">

      <div id="allusers" class="tab-pane active">  
        <?php 
        require 'php_codes/db.php';
        $sql="Select * from [User] WHERE Remove IS NULL";
        $query=sqlsrv_query($conn,$sql,array());
        if(sqlsrv_has_rows($query))
        {
          while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
          {
          $id=$row['UserID'];
          $username=$row['UserName'];
          $FN=$row['FirstName'];
          $LN=$row['LastName'];
          $Email=$row['Email'];
          $role=$row['Role'];
          $Avatar=$row['Avatar'];
          $dept=$row['DepartmentID'];

          echo '
          <div class="">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="custom-boxx centered" id="NotifContainer" >
                <div id="notifbox">
                  <h4 class="centered prof-text ">'.$role.'</h4>
                  <hr>     
                  <br>
                  <div class="centered profile-pic "><img src="img/Avatars/'.$Avatar.'"weight="200px" height="200px"></div>
                  <h4 class="centered prof-text ">'.$FN.' '.$LN.'</h4>
                  <h4 >';
                  if(isset($dept))
                  {
                    echo $dept;
                  }
                  else
                  {
                    echo 'College';
                  }
                  echo ' </h4>
                </div>       
              </div>
            </div>
          </div>
          
          ';

          }             
        }

        ?>
      </div>

      <div id="edit" class="tab-pane">
        <div class="row">

          <div class="col-lg-8 col-lg-offset-2 detailed">
            <h4 class="mb">Personal Information</h4>

            <div class="alert alert-success alert-dismissible collapse center" id="msg_scs">
                <strong>Successfully Updated Profile!</strong> ,Please Re-LogIn For The Changes To Take Effect.
             </div>
            
            <div class="alert alert-danger alert-dismissible collapse center" id="msg_fail_enter">
              <strong>Something Went Wrong!</strong> , Please Check The Values You Entered And Try Again.
            </div>

            <div class="form form_custom form-panel">
              <form class="cmxform form-horizontal style-form" id="Update_User" method="post" enctype="multipart/form-data">

              <div class="form-group">
                <label for="FN" class="control-label col-lg-4">First Name</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name='FN' id="FN" required value="<?php echo $_SESSION['FirstName'];?>">
              </div>

              </div>  
              <div class="form-group">
                <label for="LN" class="control-label col-lg-4">Last Name</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name='LN' id="LN" required value="<?php echo $_SESSION['LastName'];?>">
                </div>
              </div>  

              <div class="form-group">
                <label for="mail" class="control-label col-lg-4">Email</label>
                <div class="col-lg-8">
                  <input type="email" class="form-control" name='mail' id="mail" value="<?php echo $_SESSION['Email'];?>">
                </div>
              </div>

              <div class="form-group">
                <label for="username" class="control-label col-lg-4">Username</label>
                <div class="col-lg-8">
                  <input type="text" class="form-control" name='username' id="username" value="<?php echo $_SESSION['current_user'];?>">
                  <input type="hidden" name="prev_ava" value="<?php echo $_SESSION['Avatar']?>">
                  <input type="hidden" name="uID" value="<?php echo $_SESSION['uID']?>">
                </div>

              </div>    
   <!--            <div class="form-group">
                <label for="pass1" class="control-label col-lg-4">Password</label>
                <div class="col-lg-8">
                  <input type="password" class="form-control" name='pass1' id="pass1">
                </div>

              </div>
              <div class="form-group">
                <label for="pass2" class="control-label col-lg-4">Confirm Password</label>
                <div class="col-lg-8">
                  <input type="password" class="form-control " name='pass2' id="pass2">
                </div>
              </div>   -->

              <div class="form-group">
                <label for="ava" class="control-label col-lg-4">Avatar</label>
                <div class="col-lg-8">
                  <input type="file" class="form-control " name='ava' id="ava">
                </div>
              </div>
              
              <a href="javascript:void(0)" id="Reset_pass" style="float: right">Reset Password</a>
              <br><br>
              <div class="form-group">
                <div class="col-lg-offset-9">
                  <button class="custom-btn" type="submit" name="save">Save</button>
                </div>
              </div>

              
              </form>
            </div>

          </div>

        </div>
      </div>
            <!-- /row -->
    </div>
  </div>
</div>        
            <!--row-->

</div>


 <?php
include 'Modals/Reset_Pass.php';
include 'includes/footer.php';
 ?>
<script src="Js/Profile.js?v=33" type="text/javascript"></script>