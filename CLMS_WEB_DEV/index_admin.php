       <?php   
        require 'php_codes/db.php';

            // Journals
            function JgetElem($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function JgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where (ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=?) AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('ELEM','JSH','SHS','HS','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }

            // MAGAZINE


            function  MgetElem($dept)
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array($dept,'Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function  MgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where (ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=?) AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('ELEM','JSH','SHS','HS','Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
       ?>
        <div class="row custom-box">
         <div class="col-md-12 profile-text">      
          <h1>College Library Serial Monitoring System</h1>
          <h4><strong id="dept_branch">Main</strong> Branch</h4>
         <br>
         </div>
        </div>

  		  <div class="row custom-box" style="max-height: 100%;">
          
          <div class="container-fluid">
            <div class="row">
               <div class="col-md-12 profile-text centered">
                  <h4><strong id="dept_branch">Total Received Serials</strong></h4>  
               </div>
            </div>
          </div>

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Journals</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                    <h4 ><?php echo JgetElem('ELEM'); ?></h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                     <h4 ><?php echo JgetElem('JHS'); ?></h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4 ><?php echo JgetElem('SHS'); ?></h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4 ><?php echo JgetCOl(); ?></h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                 <h4 ><?php echo JgetElem('HS'); ?></h4>
                <h6 class="custom-text1">HighSchool</h6>
              </div>
            </div>
        </div>

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Magazine</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                   <h4 ><?php echo MgetElem('ELEM'); ?></h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                     <h4 ><?php echo MgetElem('JHS'); ?></h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                  <h4 ><?php echo MgetElem('SHS'); ?></h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4 ><?php echo MgetCOl(); ?></h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4 ><?php echo MgetElem('HS'); ?></h4>
                <h6 class="custom-text1">HighSchool</h6>
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
                  <a data-toggle="tab" href="#notification" id='notf'>Notification</a>
                </li>
                <li>
                  <a data-toggle="tab" href="#overview" id='ov'>Overview</a>
                </li>
              </ul>
            </div>
                                  	<!---TAb--> 
                                  <!---panelbody-->
            <div class="panel-body">
             <!---content-->
            	<div class="tab-content">
            		<div id="notification" class="tab-pane active">
            			<div class="row">
            	<!---notifbar-->	
                    <div class=" ">
                       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    			<div class="custom-boxx centered" id="NotifContainer" >
                            <div  id='notifbox'>
                      			  <h4>Pending SERIALS</h4>
                      			  <hr>     
                              <br>
                              <?php include 'php_codes/SentNotif.php';?>
                            </div>

                          <div class="See-All">
                            <a href="Pending_Serials.php">See all</a>
                          </div>

                          </div>
                        </div>

                  		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
                  			<div class="custom-boxx centered" id="NotifContainer" >
                          <div  id='notifbox'>
                    			  <h4>RECEIVED SERIALS</h4>
                    			  <hr>
                    			  <br>
                            <?php include 'php_codes/receivenotif.php';?>
                          </div>

                          <div class="See-All" id="RS_SEE_ALL">
                            <a href="Received_Serials.php">See all</a>
                          </div>
                        </div>
                      </div>

                  		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  			<div class="custom-boxx centered" id="NotifContainer" >
                          <div  id='notifbox'>
                    			  <h4>LATE DELIVERY</h4>
                    			  <hr>
                    			  <br>
                           <?php include 'php_codes/latenotif.php';?>
                          </div>

                          <div class="See-All">
                            <a href="Late_Deliv.php">See all</a>
                          </div>
                          </div>
                        </div>
                   </div>
            	<!---notifbar-->		
                	</div>
                </div>
                              			
                              	<div id="overview" class="tab-pane ">
                                  <div class="container-fluid">
                              		<div class="row">
                                  <div id="subs_chart">
                                    
                              			            <!--CUSTOM CHART START -->
                                       
                                          <div class="border-head">
                                            <?php 
                                            $c_year=date('Y');
                                            $n_year=date('Y',strtotime('+1 year'));
                                             ?>
                                            <h3>Subscribed Titles [S.Y. <?php echo $c_year.'-'.$n_year ?>]</h3>
                                          </div>
                                          <div class="custom-bar-chart">
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
                                            <div class="bar " id="Cancel_Click">
                                              <div class="title">Cancelled</div>
                                              <?php include 'php_codes/barchart_cancelled.php';?>
                                            </div>
                                            <div class="bar " id="REF_Click">
                                              <div class="title">Refunded</div>
                                             <?php include 'php_codes/barchart_refunded.php';?>
                                            </div>
                                            <div class="bar " id="Fulfilled_Click">
                                              <div class="title">Fulfilled</div>
                                              <?php include 'php_codes/barchart_finished.php';?>
                                            </div>

                                          </div>
                                        
                                          <!--custom chart end-->
                              		</div>
                                  <div id="panel_subs_chart">                      
                                    <h5 style="margin-bottom: 16px;margin-top: 43px;"><strong>Fulfilled: </strong><?php echo $ongoingtot.'/'.$total ?></h5>
                                     <h5 style="margin-bottom: 16px;"><strong>OnGoing: </strong><?php echo ongoingtotal().'/'.$total ?></h5>
                                    <h5 style="margin-bottom: 16px;"><strong>Refunded: </strong><?php echo ongoingtotalr().'/'.$total ?></h5>
                                    <h5 style="margin-bottom: 16px;"><strong>Cancelled: </strong><?php echo ongoingtotalc().'/'.$total ?></h5>


                                   
                                  </div>

                                  </div>

                                  <div id="morris">
                                  <div class="row">
                                    <div class="col-lg-11 col-lg-offset-1">
                                      <div class="content-panel">
                                        <h4>Subscription Overview Per Distributors</h4>
                                        <div class="panel-body">
                                          <div id="hero-donut" class="graph"></div>
                                          <div hidden id="disb">
                                            <?php  
                                            require 'php_codes/db.php';

                                              $disblist_ID=array();
                                              $disblist_names=array();
                                              $inc=0;
                                              $sqldisb="Select DistributorID,DistributorName From Distributor WHERE Remove IS NULL";
                                              $querydisb=sqlsrv_query($conn,$sqldisb,array());
                                              while($row=sqlsrv_fetch_array($querydisb,SQLSRV_FETCH_ASSOC))
                                              {
                                                $disblist_ID[$inc]=$row['DistributorID'];
                                                $disblist_names[$inc]=$row['DistributorName'];
                                                $inc++;
                                              }              
                                            
                                            ?>
                                          </div>
                                          <div>
                                            <select id="morris_select_chart">
                                              <?php 
                                              for($z=0;$z<count($disblist_ID);$z++)
                                              {
                                                echo '<option value="'.$disblist_ID[$z].'">'.$disblist_names[$z].'</option>';
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

                                  </div>
            	                     </div>
            	
            	</div>	
            </div>
                                  <!---panelbody-->	 
      </div>
  		
   </div>
  	  

  
