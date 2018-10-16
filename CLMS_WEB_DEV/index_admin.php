  <section id="main-content">
    <section class="wrapper">
  	<div class="main-chart">
      <?php   
        require 'php_codes/db.php';

            // Journals
            function JgetElem()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array('ELEM','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function JgetJH()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('JHS','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
            function JgetSH()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('SHS','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function JgetHS()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('HS','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
              function JgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where (ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=?) AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('ELEM','JSH','SHS','HS','Received','Journal'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }

            // MAGAZINE

            function  MgetElem()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                $query=sqlsrv_query($conn,$sql,array('ELEM','Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function  MgetJH()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('JHS','Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
            function  MgetSH()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('SHS','Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
             function MgetHS()
            {   require 'php_codes/db.php';
                $sql="Select  Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where ReceiveSerial.DepartmentID=? AND Status=? AND TypeName=? Group By ReceivedSerialID";
                 $query=sqlsrv_query($conn,$sql,array('HS','Received','Magazine'),$opt);
                $row=sqlsrv_num_rows($query);
                return $row;
            }
              function  MgetCOl()
            {   require 'php_codes/db.php';
                $sql="Select Max(ReceivedSerialID) AS ReceivedSerialID from ReceiveSerial Left Join Categorize_Serials ON ReceiveSerial.SerialID=Categorize_Serials.SerialID Inner Join Serial On Categorize_Serials.SerialID=Serial.SerialID Left JOin [Type] ON Serial.TypeID=[Type].TypeID Where (ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=? AND ReceiveSerial.DepartmentID!=?) AND Status=? AND TypeName=? Group By ReceivedSerialID";
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

  		    <div class="row custom-box">

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Journals</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                    <h4 ><?php echo JgetElem(); ?></h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                     <h4 ><?php echo JgetJH(); ?></h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4 ><?php echo JgetSH(); ?></h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4 ><?php echo JgetCOl(); ?></h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                 <h4 ><?php echo JgetHS(); ?></h4>
                <h6 class="custom-text1">HighSchool</h6>
              </div>
            </div>
        </div>

         <div>
            <div class="col-md-2 profile-text mt mb centered">    
              <div><h3 class="custom-pos mt">Magazine</h3></div>
              <div class="right-divider hidden-sm hidden-xs ">
                   <h4 ><?php echo MgetElem(); ?></h4>
                    <h6 class="custom-text1">ELEMENTARY</h6>
                     <h4 ><?php echo MgetJH(); ?></h4>
                    <h6 class="custom-text1">JUNIOR HIGH</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                  <h4 ><?php echo MgetSH(); ?></h4>
                <h6 class="custom-text1">SENIOR HIGH</h6>
                <h4 ><?php echo MgetCOl(); ?></h4>
                <h6 class="custom-text1">COLLEGE</h6>
              </div>
            </div>
            <div class="col-md-2 profile-text mt mb centered custom-sect">
              <div class="right-divider hidden-sm hidden-xs ">
                <h4 ><?php echo MgetHS(); ?></h4>
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
             <!---content-->
            	<div class="tab-content">
            		<div id="notification" class="tab-pane active">
            			<div class="row">
            	<!---notifbar-->	
                    <div class=" ">
                       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    			<div class="custom-boxx centered" id="NotifContainer" >
                            <div  id='notifbox'>
                      			  <h4>SENT SERIALS</h4>
                      			  <hr>     
                              <br>
                              <?php include 'php_codes/SentNotif.php';?>
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
                          </div>
                        </div>
                   </div>
            	<!---notifbar-->		
                	</div>
                </div>
                              			
                              	<div id="overview" class="tab-pane ">
                              		<div class="row">
                              			            <!--CUSTOM CHART START -->
                                          <div class="border-head">
                                            <h3>Subscription Chart</h3>
                                          </div>
                                          <div class="custom-bar-chart">
                                            <ul class="y-axis">
                                              <li><span><?php include 'php_codes/barchart_count.php';?></span></li>
                                              <li><span></span></li>
                                              <li><span></span></li>
                                              <li><span></span></li>
                                          
                                              <li><span>0</span></li>
                                            </ul>
                                            <div class="bar">
                              			  <div class="title">On Going</div>
                                              <?php include 'php_codes/barchart_ongoing.php';?>
                                            </div>
                                            <div class="bar ">
                                              <div class="title">Cancelled</div>
                                              <?php include 'php_codes/barchart_cancelled.php';?>
                                            </div>
                                            <div class="bar ">
                                              <div class="title">Refunded</div>
                                             <?php include 'php_codes/barchart_refunded.php';?>
                                            </div>
                                            <div class="bar ">
                                              <div class="title">Finished</div>
                                              <?php include 'php_codes/barchart_finished.php';?>
                                            </div>

                                          </div>
                                          <!--custom chart end-->
                              		</div>
            	                     </div>
            	
            	</div>	
            </div>
                                  <!---panelbody-->	 
      </div>
  		
   </div>
  	  

  
    </div>
    </section>
  </section>