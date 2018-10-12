  <section id="main-content">
    <section class="wrapper">
  	<div class="main-chart">

  		 <div class="row custom-box">
  		   <div class="col-md-12 profile-text">      
          <h1>College Library Serial Monitoring System</h1>
          <h4><strong id="dept_branch"><?php echo $_SESSION['Dept']; ?></strong> Branch</h4>
         <br>
         </div>
  		</div>

       <div class="row custom-box">

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Journals</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                    <h4 >1922</h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                    <h4>290</h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4>13,980</h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
        </div>

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Journals</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                    <h4 >1922</h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                    <h4>290</h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4>13,980</h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
        </div>

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Journals</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                    <h4 >1922</h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                    <h4>290</h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4>13,980</h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4>13,980</h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
        </div>
        
      </div>
  		
  	<!---TAb-->
    <div class="col-lg-12  ">
        <div class="row content-panel">

          <div class="panel-heading">
            <ul class="nav nav-tabs nav-justified">
              <li class="active">
                <a data-toggle="tab" href="#notification">Notification</a>
              </li>
              <li>
                <a data-toggle="tab" href="#overview">Overview</a>
              </li>
            </ul>
          </div>
                                	<!---TAb--> 
                                <!---panelbody-->
          <div class="panel-body">
          <div class="tab-content">

          		<div id="notification" class="tab-pane active">

          		  <div class="row">
                  <div class=" ">
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  			<div class="custom-boxx centered" id="NotifContainer" >
                          <div  id='notifbox'>
                    			  <h4>RECEIVE SERIALS</h4>
                    			  <hr>     
                            <br>
  
                            <?php 
                              $dept= $_SESSION['Dept'];
                              require 'php_codes/db.php';

                              $sql="Select * from ReceiveSerial Where DepartmentID=? AND Status=?";
                              $query=sqlsrv_query($conn,$sql,array($dept,'NotReceived'));

                              function getSNAME($sid)
                              {
                                require 'php_codes/db.php';
                                $sqltxt="Select SerialName From Serial Where SerialID=?";
                                $sqlquery=sqlsrv_query($conn,$sqltxt,array($sid));

                                $row=sqlsrv_fetch_array($sqlquery,SQLSRV_FETCH_ASSOC);
                                $sname=$row['SerialName'];
                                return $sname;
                              }

                              if(sqlsrv_has_rows($query))
                              {
                                while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
                                {
                                  $sID=$row['SerialID'];
                                  $name=getSNAME($sID);

                                  echo '
                                      <div class="rs-notif custom-box">
                                        <div class="rs_content">
                                          <span> <img src="img/receive.png"  height="40" width="40"> </span>
                                          <p class="rs_msg"><strong class="rs_dept">'.$name.'</strong>has been sent to you by the College Library</p>
                                        </div>
                                      </div>
                                  ';
                                }
                              }

                             ?>

                          </div>			 
                        </div>
                      </div>

                 </div>
              </div>
            </div>

              <div id="overview" class="tab-pane ">
                  <div class="row">

          	     </div>
          	</div>

          </div>
          </div>
		
      </div>
    </div>
    <?php include 'Modals/Receive_Modal.php' ?>
  </section>
</section>
