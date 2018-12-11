       <?php   
        require 'php_codes/db.php';

            // Journals
            function JgetElem($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function JgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select Count(*) as nums from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID
                      Inner Join ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
                      Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID
                      Where Status_Prog=? And TypeName=? AND (ReceiveSerial_Program.Remove IS NULL AND Subscription.Remove IS NULL) And Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))";
                 $query=sqlsrv_query($conn,$sql,array('Received','Journal'));
                $row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
                $nums=$row['nums'];
                return $nums;
            }

            // MAGAZINE


            function  MgetElem($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function  MgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select Count(*) as nums from Subscription Inner Join Serial On Subscription.SerialID=Serial.SerialID
                      Inner Join ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
                      Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID
                      Where Status_Prog=? And TypeName=? AND (ReceiveSerial_Program.Remove IS NULL AND Subscription.Remove IS NULL) And Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01'))";
                 $query=sqlsrv_query($conn,$sql,array('Received','Magazine'));
                $row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
                $nums=$row['nums'];
                return $nums;
            }
       ?>

        <div class="custom-upperbox">
         <div class="col-md-12 profile-text">      
          <h2>College Library Serial Monitoring System</h2>
          <h4 ><strong id="dept_branch">Main</strong> Branch</h4>
         <br>
         </div>
        </div>

         <div class="custom-midbox ">
         <div class="">

            <div class="">
                 <div class="col-md-12 totalrec-text centered">
                     <h4><strong id="dept_branch">Total Received Serials</strong></h4>  
                 </div>
              <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 right-divider">JOURNALS</h4></div>
                      <div><h4 class="magazine-text2 right-divider">MAGAZINES</h4></div>
                  </div>
             </div>

              <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 right-divider"><?php echo JgetElem('ELEM'); ?></h4></div>
                      <div><h4 class="magazine-text2 right-divider"><?php echo MgetElem('ELEM'); ?></h4></div>
                      <div><h5 class="dept-text">ELEMENTARY</h5></div>
                  </div>
             </div>

              <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 right-divider"><?php echo JgetElem('JHS'); ?></h4></div>
                      <div><h4 class="magazine-text2 right-divider"><?php echo MgetElem('JHS'); ?></h4></div>
                      <div><h5 class="dept-text">JUNIOR HIGH</h5></div>
                  </div>
             </div>

              <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 right-divider"><?php echo JgetElem('HS'); ?></h4></div>
                      <div><h4 class="magazine-text2 right-divider"><?php echo MgetElem('HS'); ?></h4></div>
                      <div><h5 class="dept-text">HIGH SCHOOL</h5></div>
                  </div>
             </div>

              <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 right-divider"><?php echo JgetElem('SHS'); ?></h4></div>
                      <div><h4 class="magazine-text2 right-divider"><?php echo MgetElem('SHS'); ?></h4></div>
                      <div><h5 class="dept-text">SENIOR HIGH</h5></div>
                  </div>
             </div>

               <div>
                  <div class="col-md-2">    
                     <div><h4 class="journal-text2 "><?php echo JgetCOl(); ?></h4></div>
                      <div><h4 class="magazine-text2"><?php echo MgetCOl(); ?></h4></div>
                      <div><h5 class="dept-text">COLLEGE</h5></div>
                  </div>
             </div>            

            </div>



          </div>
        </div>

      <div class=" ">
          <div class="content-panel">

            <div class="">
              <ul class="nav nav-tabs nav-justified">
                <li class="active">
                  <a data-toggle="tab" href="#notification" id='notf'>Notification</a>
                </li>
                <li>
                  <a data-toggle="tab" href="#overview" id='ov'>Overview</a>
                </li>
              </ul>
            </div>
                                    <!---TAb--> 
                                  <!---panelbody-->
            <div class="panel-body" style="margin-top: 20px">
             <!---content-->
              <div class="tab-content">
                <div id="notification" class="tab-pane active">
                  <div class="">
              <!---notifbar-->  
                    <div class=" ">
                       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                          <div class="custom-boxx centered" id="NotifContainer" >
                            <div class="adminserial" id='notifbox'>
                              <h4>Pending SERIALS</h4>
                              <hr>     
                             
                              <?php include 'php_codes/SentNotif.php';?>
                            </div>

                          <div class="See-All1">
                            <a href="Pending_Serials.php">See All >></a>
                          </div>

                          </div>
                        </div>

                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">  
                        <div class="custom-boxx centered" id="NotifContainer" >
                          <div class="adminserial" id='notifbox'>
                            <h4>RECEIVED SERIALS</h4>
                            <hr>
                            
                            <?php include 'php_codes/receivenotif.php';?>
                          </div>

                          <div class="See-All1" id="RS_SEE_ALL">
                            <a href="Received_Serials.php">See All >></a>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="custom-boxx centered" id="NotifContainer" >
                          <div class="adminserial" id='notifbox'>
                            <h4>LATE DELIVERY</h4>
                            <hr>
                            <br>
                           <?php include 'php_codes/latenotif.php';?>
                          </div>

                          <div class="See-All1">
                            <a href="Late_Deliv.php">See All >></a>
                          </div>
                          </div>
                        </div>
                   </div>
              <!---notifbar-->    
                  </div>
                </div>
                                    
                    <div id="overview" class="tab-pane ">
                        <div class="container-fluid">
                            <div class="custom-subsbox">
                                <div id="">
                            
                        <!--CUSTOM CHART START -->
                                       
                              <div class="border-head adminsubs ">
                                    <h3>Subscribed Titles Chart</h3>
                                </div>        
                                          <div class="custom-bar-chart  ">
                                            <ul class="y-axis">
                                              <li><span><?php include 'php_codes/barchart_count.php';?></span></li>
                                              <li><span></span></li>
                                              <li><span></span></li>
                                              <li><span></span></li>

                                              <li><span>0</span></li>
                                            </ul>
                                            <div class="bar" id="OG_Click">
                                      <div class="title">OnGoing</div>
                                              <?php include 'php_codes/barchart_ongoing.php';?>
                                            </div>
                                            <div class="bar" id="Cancel_Click">
                                              <div class="title">Cancelled</div>
                                              <?php include 'php_codes/barchart_cancelled.php';?>
                                            </div>
                                            <div class="bar" id="REF_Click">
                                              <div class="title">Refunded</div>
                                             <?php include 'php_codes/barchart_refunded.php';?>
                                            </div>
                                            <div class="bar" id="Fulfilled_Click">
                                              <div class="title border-head">Fulfilled</div>
                                              <?php include 'php_codes/barchart_finished.php';?>
                                            </div>

                                          </div>
                                       </div> 
                                          <!--custom chart end-->
                                          <div id="panel_subs_chart">                      
                                    <h5 style="margin-bottom: 16px;margin-top: 43px;"><strong>Fulfilled: </strong><?php echo $ongoingtot.'/'.$total ?></h5>
                                     <h5 style="margin-bottom: 16px;"><strong>OnGoing: </strong><?php echo ongoingtotal().'/'.$total ?></h5>
                                    <h5 style="margin-bottom: 16px;"><strong>Refunded: </strong><?php echo ongoingtotalr().'/'.$total ?></h5>
                                    <h5 style="margin-bottom: 16px;"><strong>Cancelled: </strong><?php echo ongoingtotalc().'/'.$total ?></h5>
                                  </div>

                                  </div>
                      <!----END CUSTOM CHART--->
                            <!-----start graph--->
                              <div id="morris">
                                  <div class="">
                                    <div class="">
                                      <div  class="border-head adminsubs">
                                        <h3>Subscription Overview Per Distributors</h3>
                                        <div class="panel-body">
                                          <div id="hero-donut" class="graph"></div>
                                          <div hidden id="disb">
                                            <?php  
                                            require 'php_codes/db.php';

                                              $disblist_ID=array();
                                              $disblist_names=array();
                                              $inc=0;
                                              $sqldisb="Select DistributorID,DistributorName From Distributor Where Remove IS NULL";
                                              $querydisb=sqlsrv_query($conn,$sqldisb,array());
                                              while($row=sqlsrv_fetch_array($querydisb,SQLSRV_FETCH_ASSOC))
                                              {
                                                $disblist_ID[$inc]=$row['DistributorID'];
                                                $disblist_names[$inc]=$row['DistributorName'];
                                                $inc++;
                                              }              
                                            
                                            ?>
                                          </div>
                                          <div class="col-lg-3">
                                            <select class="form-control col-lg-4" id="morris_select_chart">
                                              <?php 
                                              for($z=0;$z<count($disblist_ID);$z++)
                                              {
                                                echo '<option  value="'.$disblist_ID[$z].'">'.$disblist_names[$z].'</option>';
                                              }
                                               ?>
                                              }
                                              
                                            </select>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
          <!-----end graph--->
                                  </div>

                                  </div>
            	                     </div>
            	
            	</div>	
            </div>
                                  <!---panelbody-->	 
      </div>
  		
   </div>
  	  

  
