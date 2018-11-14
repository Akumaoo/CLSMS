  		 <div class="row custom-box">
  		   <div class="col-md-12 profile-text">      
          <h1>College Library Serial Monitoring System</h1>
          <h4><strong id="dept_branch"><?php echo $_SESSION['Dept']; ?></strong> Branch</h4>
         <br>
         </div>
  		</div>

       <div class="row custom-box">
        
        <div class="container-fluid">

        <div class="row">
           <div class="col-lg-6 profile-text"><h3>Journals</h3></div>
           <div class="col-lg-6 profile-text"><h3>Magazine</h3></div>
        </div>

        <div class="row">
        <div class="col-lg-6">
          
        <div class="contaniner-fluid">
          <div class="row">

          <div class="col-lg-offset-1 col-lg-3">
  
              <div class="profile-text hidden-sm hidden-xs ">
                    <h4 >1922</h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                    <h4>290</h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
          </div>

          <div class="col-lg-3">

              <div class="profile-text hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4>13,980</h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
          </div>

          <div class="col-lg-3">

              <div class="profile-text hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">HIGHSCHOOL</h6>
              </div>
          </div>

          </div>
          </div>
          </div>

          <!-- MAGAZINE -->
        <div class="col-lg-6">

          <div class="contaniner-fluid">
          <div class="row">
          <div class="col-lg-offset-2 col-lg-3">
  
              <div class="profile-text hidden-sm hidden-xs ">
                    <h4 >1922</h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                    <h4>290</h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
          </div>

          <div class="col-lg-3">

              <div class="profile-text hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4>13,980</h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
          </div>

          <div class="col-lg-3">

              <div class="profile-text hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">HIGHSCHOOL</h6>
              </div>
          </div>

        </div>
        </div>
        </div>

        </div>

        </div>
        
      </div>

      <div class="container-fluid">
    
      <div class="row">
        <div class="col-lg-12" style="padding:0">
           <?php 
            $dept= $_SESSION['Dept'];
            require 'php_codes/db.php';

            $sql="Select Count(*) as Num_rec from ReceiveSerial Where Status=? AND DepartmentID=? AND Staff_Comment IS NULL";
            $query=sqlsrv_query($conn,$sql,array('NotReceived',$dept),$opt);
            $row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
            $Num_rec=$row['Num_rec'];

            if($Num_rec!=0)
            {
              $Num_rec=$row['Num_rec'];

              echo '
                  <div class="rs-notif custom-box">
                    <div class="rs_content">
                      <span> <img src="img/alert.png"  height="40" width="40"> </span>
                      <p class="rs_msg_staff">There are <strong>'.$Num_rec.'</strong> pending serial/s sent to you by the College Library</p>
                    </div>
                  </div>
              ';
              
            }

           ?>

        </div>
      </div>
      
  	<!---TAb-->
    <div class="row">
    <div class="col-lg-12"  style="padding:0">
        <div class="content-panel">
          <div class="panel-heading" style="padding-left: 0px;padding-right: 0px;">
            <ul class="nav nav-tabs nav-justified">
              <li>
                <h4 href="javascript:void(0)" style="color:black;text-align: center"><strong>Overview</strong></h4>
              </li>
            </ul>
          </div>
                                	<!---TAb--> 
                                <!---panelbody-->
          <div class="panel-body">
          <div class="tab-content">
              <div id="overview" class="tab-pane active">
                <div class="container-fluid">
                <div class="row" style="margin-top: 20px;">
                  <div class="col-lg-offset-1">
                    <h4>List Of Received Serials:</h4>
                  </div>
                </div>
                  <div class="row">
                  
                  <div class=" custom_table">

                    <div class="container-fluid">
                    <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover" id="table_RS_STAFF" ">
                      <thead class="thead_theme">
                        <tr>
                        <th class="radio-label-center">Control Number</th>
                        <th class="radio-label-center">Serial Name</th>
                        <th class="radio-label-center">Volume Number</th>
                        <th class="radio-label-center">Issue Number</th>
                        <th class="radio-label-center">Date Of Issue</th>
                        <th class="radio-label-center">Remarks</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </table>
                  </div>
                  </div>
                  </div>

                </div>


          	     </div>
                 </div>
          	</div>

          </div>
          </div>
		
      </div>
    </div>
    </div>
    </div>
    <?php include 'Modals/Receive_Modal.php' ?>
