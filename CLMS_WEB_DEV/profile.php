<?php
include 'includes/header.php';

?>

    <section id="main-content">
      <section class="wrapper ">
 
       <div class="row custom-panelbox">
<?php 
  echo '
       <div class="centered profile-pic "><img src="img/Avatars/'.$_SESSION['Avatar'].'"weight="200px" height="200px"></div>
      <h4 class="centered prof-text ">'.$_SESSION['current_user'].'</h4>
       ';
   
 

      echo '
      
      <h4 class="centered prof-text "> '.$_SESSION['LastName'].', '.$_SESSION['FirstName'].'</h4>
       ';         
                   
  
?>

       </div>

      <!---TAb-->
 
          <div class="row content-panel">
            <div class="panel-heading">
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
            $sql="Select * from [User]";
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
                               <h4 >'.$Email.' </h4>
                            </div>       
                          </div>
                        </div>
                  </div>
            
                ';

              }             
            }

           ?>
       </div>
                  <div id="edit" class="tab-pane active">
                    <div class="row">
                      <div class="col-lg-8 col-lg-offset-2 detailed">
                        <h4 class="mb">Personal Information</h4>
                        <form role="form" class="form-horizontal">
                          <div class="form-group">
                            <label class="col-lg-2 control-label"> Avatar</label>
                            <div class="col-lg-6">
                              <input type="file" id="exampleInputFile" class="file-pos">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-lg-2 control-label">Email</label>
                            <div class="col-lg-6">
                              <input type="text" placeholder=" "  class="form-control">
                            </div>
                          </div>


                        </form>
                      </div>
                     
                          <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                              <button class="btn btn-theme" type="submit">Save</button>
                              <button class="btn btn-theme04" type="button">Cancel</button>
                            </div>
                          </div>

                        </form>
                      </div>
                      <!-- /col-lg-8 -->
                    </div>
                    <!-- /row -->
                  </div>



     </div>
  </div>
         
            <!--row-->

      </section>
      <!-- /wrapper -->
    </section>

 <?php
include 'includes/footer.php';
 ?>
