	<?php 
require 'php_codes/db.php';
$sqltype="Select Count(*) as nums from Department INNER Join Organization ON Department.DepartmentID=Organization.DepartmentID Where Department.DepartmentID=?";
$querytype=sqlsrv_query($conn,$sqltype,array($_SESSION['Dept']));
$row=sqlsrv_fetch_array($querytype,SQLSRV_FETCH_ASSOC);
$datatype=$row['nums'];

if($datatype==0)
{
  $type='Single';
}
else
{
  $type='Multiple';
}

  function JgetElem($dept)
  {   require 'php_codes/db.php';
      $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
      $query=sqlsrv_query($conn,$sql,array($dept,'Received','Journal'),$opt);
      $row=sqlsrv_num_rows($query);
      return $row;
  }

  function  MgetElem($dept)
  {   require 'php_codes/db.php';
      $sql="Select ReceivedSerialID from ReceiveSerial Inner Join Serial On ReceiveSerial.SerialID=Serial.SerialID Inner Join Subscription On Serial.SerialID=Subscription.SerialID Where ReceiveSerial.DepartmentID=? AND ReceiveSerial.Status=? AND TypeName=? And ReceiveSerial.Remove IS NULL AND Subscription_Date Between CONCAT(DATEPART(YYYY,GETDATE()),'-08-01') AND DATEADD(YEAR,1,CONCAT(DATEPART(YYYY,GETDATE()),'-05-01')) Group By ReceivedSerialID";
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

   ?>

 <div class="row custom-box">
   <div class="col-md-12 profile-text">      
    <h1>College Library Serial Monitoring System</h1>
    <h4><strong id="dept_branch"><?php echo $_SESSION['Dept']; ?></strong> Branch</h4>
   <br>
   </div>
</div>

 <div class="row custom-box" style="min-height: 160px;">

  <div class="container-fluid">
    <div class="row">
       <div class="col-md-12 profile-text centered">
          <h4><strong id="dept_branch">Total Received Serials</strong></h4>  
       </div>
    </div>
  </div>
  
  <div class="container-fluid">

  <div class="row">
     <div class="col-lg-6 profile-text"><h3>Journals</h3></div>
     <div class="col-lg-6 profile-text"><h3>Magazine</h3></div>
  </div>

  <div class="row">
  <div class="col-lg-6">
    
  <div class="contaniner-fluid">
    <div class="row">

    <div class="col-lg-offset-4 col-lg-3">
        <!-- JOURNAL -->
        <div class="profile-text hidden-sm hidden-xs " style="margin-left: 35px;">
              <h4 ><?php
               if($type=='Single')
                {
                  echo JgetElem($_SESSION['Dept']);
                }
                else
                {
                  echo JgetCOl();
                }
               ?></h4>
        </div>
    </div>


    </div>
    </div>
    </div>

    <!-- MAGAZINE -->
  <div class="col-lg-6">

    <div class="contaniner-fluid">
    <div class="row">
    <div class="col-lg-offset-4 col-lg-3">
        <!-- MAGAZINE -->
        <div class="profile-text hidden-sm hidden-xs " style="margin-left: 35px;">
              <h4 ><?php 
              if($type=='Single')
              {
                echo MgetElem($_SESSION['Dept']);
              }
              else
              {
                echo MgetCOl();
              }
              
              ?></h4>
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
      

      $sql="Select Count(*) as Num_rec from 
          (Select SerialName,ReceiveSerial.DepartmentID,Status,DateReceiveNotif_Give,ReceiveSerial.Remove from Serial Inner Join ReceiveSerial on Serial.SerialID=ReceiveSerial.SerialID 
          Inner JOin Department On ReceiveSerial.DepartmentID=Department.DepartmentID) as asd
        Left Join
          (Select SerialName,Organization.DepartmentID,ReceiveSerial_Program.ProgramID,DateReceiveNotif_Give_Prog,Status_Prog,ReceiveSerial_Program.Remove from Serial Inner JOin ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
          Inner Join Program on ReceiveSerial_Program.ProgramID=Program.ProgramID
          Inner JOin Organization on Program.OrganizationID=Organization.OrganizationID) as dsa ON asd.DepartmentID=dsa.DepartmentID 
          WHERE (asd.SerialName=dsa.SerialName OR (asd.SerialName IS NOT NULL AND dsa.SerialName IS NULL)) AND (asd.DateReceiveNotif_Give=dsa.DateReceiveNotif_Give_Prog OR (asd.DateReceiveNotif_Give IS NOT NULL AND dsa.DateReceiveNotif_Give_Prog IS NULL)) AND (asd.Remove IS NULL AND dsa.Remove IS NULL) AND (asd.Status=? AND dsa.Status_Prog=? OR(asd.Status=? AND dsa.Status_Prog IS NULL)) AND asd.DepartmentID=?";
      $query=sqlsrv_query($conn,$sql,array('NotReceived','NotReceived','NotReceived',$dept));
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
                  <?php 
                    if($type=='Single')
                    {
                      echo '
                            <tr>
                              <th class="radio-label-center">Control Number</th>
                              <th class="radio-label-center">Serial Name</th>
                              <th class="radio-label-center">Volume Number</th>
                              <th class="radio-label-center">Issue Number</th>
                              <th class="radio-label-center">Date Of Issue</th>
                              <th class="radio-label-center">Remarks</th>
                            </tr>
                      ';
                    }
                    else
                    {
                      echo '
                            <tr>
                              <th class="radio-label-center">Program</th>
                              <th class="radio-label-center">Control Number</th>
                              <th class="radio-label-center">Serial Name</th>
                              <th class="radio-label-center">Volume Number</th>
                              <th class="radio-label-center">Issue Number</th>
                              <th class="radio-label-center">Date Of Issue</th>
                              <th class="radio-label-center">Remarks</th>
                            </tr>';
                    }
                   ?>
             
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
