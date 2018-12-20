	<?php 
require 'php_codes/db.php';

  function JgetElem($dept)
  {   require 'php_codes/db.php';
      $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
      $query=sqlsrv_query($conn,$sql,array($dept,'Journal'),$opt);
      $row=sqlsrv_num_rows($query);
      return $row;
  }

  function  MgetElem($dept)
  {   require 'php_codes/db.php';
      $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
      $query=sqlsrv_query($conn,$sql,array($dept,'Magazine'),$opt);
      $row=sqlsrv_num_rows($query);
      return $row;
  }

   ?>

<div class="custom-upperbox">
  <div class="col-md-12 profile-text">      
     <h2>College Library Serial Monitoring System</h2>
    <h4><strong id="dept_branch"><?php echo $_SESSION['Dept']; ?></strong> Branch</h4>
   <br>
   </div>
</div>

 <div class="custom-midbox" >
  <div class="">
    <div class="">
       <div class="col-md-12 totalrec-text  centered">
          <h4><strong id="dept_branch">Total Received Serials</strong></h4>  
       </div>
    </div>
  </div>
  
  <div class="">
    <div class="" >
       <div class="col-lg-6 journal-text2"><h4>Journals</h4></div>
       <div class="col-lg-6 magazine-text2"><h4>Magazine</h4></div>
    </div>

  <div class="">

    <div class="col-lg-6">
      <div class="col-lg-offset-4 col-lg-3">
          <!-- JOURNAL -->
          <div class=" hidden-sm hidden-xs " style="margin-left: 40px;">
                <h4 ><?php
                    echo JgetElem($_SESSION['Dept']);
                 ?></h4>
          </div>
      </div>
    </div>

    <!-- MAGAZINE -->
  <div class="col-lg-6">

    <div >
    <div >
    <div class="col-lg-offset-4 col-lg-3">
        <!-- MAGAZINE -->
        <div class=" hidden-sm hidden-xs " style="margin-left: 35px;">
              <h4 ><?php 
                echo MgetElem($_SESSION['Dept']);
              ?></h4>
        </div>
    </div>

  </div>
  </div>
  </div>

  </div>

  </div>
  
</div>

<div class="content-panel">

<div class="">
  <div class="" style="padding:0">
     <?php 
      $dept= $_SESSION['Dept'];
      

      $sql="Select Count(*) as Num_rec from  Serial Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
            Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID
            WHERE ReceiveSerial.Remove IS NULL  AND ReceiveSerial.Status=? AND ReceiveSerial.DepartmentID=?";
      $query=sqlsrv_query($conn,$sql,array('NotReceived',$dept));
      $row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
      $Num_rec=$row['Num_rec'];

      if($Num_rec!=0)
      {
        $Num_rec=$row['Num_rec'];

        echo '
            <div class="rs-notif custom-notif">
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
<div class="">
<div class=""  style="padding:0">
  <div class="">
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
                <span class="fa fa-print fa-lg cog_action" id="gen_rep_rt"></span>
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
<?php include 'Modals/Receive_Modal.php';
      include 'Modals/Print_modal.php';
 ?>