       <?php   
        require 'php_codes/db.php';

            // Journals
            function Jget($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription.Remove IS NULL AND Subscription_Date Between ".$bet." Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }        

            // MAGAZINE


            function  Mget($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription.Remove IS NULL AND Subscription_Date Between ".$bet." Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
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
              <?php 
                $deptget="Select DepartmentID from Department";
                $queryget=sqlsrv_query($conn,$deptget,array());
                $dept_list=[];
                $inc=0;
                while($row=sqlsrv_fetch_array($queryget,SQLSRV_FETCH_ASSOC))
                {
                  $dept_list[$inc]=$row['DepartmentID'];
                  $inc++;
                }

                for($x=0;$x<count($dept_list);$x++)
                {
                   echo '<div>
                              <div class="col-md-2">    
                                 <div><h4 class="journal-text2 right-divider">'. Jget($dept_list[$x]).'</h4></div>
                                  <div><h4 class="magazine-text2 right-divider">'. Mget($dept_list[$x]).'</h4></div>
                                  <div><h5 class="dept-text">'.$dept_list[$x].'</h5></div>
                              </div>
                         </div>';

                }

               ?>

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
  	  

  
