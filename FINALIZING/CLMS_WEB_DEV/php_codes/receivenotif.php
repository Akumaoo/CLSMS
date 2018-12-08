  <?php

    $receive_sqltxt="Select Top 3 Count(asd.DepartmentID) as nums_depts,asd.DepartmentID,asd.DateReceiveNotif_Receive,Admin_Seen from
  (Select ReceiveSerial.DepartmentID,SerialName as sn_main,Status,DateReceiveNotif_Give,ReceiveSerial.Remove,Admin_Seen,ReceiveSerial.DateReceiveNotif_Receive from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
  Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status=? and ReceiveSerial.Remove IS NULL And Admin_Seen IS NULL) as asd
  Left Join
  (Select Organization.DepartmentID,SerialName as sn_prog,Organization.OrganizationID,ReceiveSerial_Program.ProgramID,DateReceiveNotif_Give_Prog from Serial Inner Join ReceiveSerial_Program On Serial.SerialID=ReceiveSerial_Program.SerialID
  Inner Join Program On ReceiveSerial_Program.ProgramID=Program.ProgramID
  inner Join Organization on Program.OrganizationID=Organization.OrganizationID) as dsa on asd.DepartmentID=dsa.DepartmentID where (sn_main=sn_prog OR sn_prog IS NULL) AND (DateReceiveNotif_Give=DateReceiveNotif_Give_Prog OR DateReceiveNotif_Give IS NOT NULL AND DateReceiveNotif_Give_Prog IS NULL) Group By asd.DepartmentID,Admin_Seen,DateReceiveNotif_Receive";
    $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('Received'));

    if(sqlsrv_has_rows($receive_query))
    {
      while($receive_row=sqlsrv_fetch_array($receive_query,SQLSRV_FETCH_ASSOC))
      {

          $rec_num=$receive_row['nums_depts'];
          $receive_RSDATE=$receive_row['DateReceiveNotif_Receive']->format('M-d-Y');
          $receive_Dept=$receive_row['DepartmentID'];

          //SETTING VALUE OF COURSENAME
             echo '
              <div class="receive_tab">
                <div class="thumb">
                  <a href="javascript:void(0)" class="receive_seen"><span> <img src="img/receive.png"  height="35" width="35"> </span></a>
                </div>
                <div class="details">
                  <p>
                    <muted class="date">'.$receive_RSDATE.'</muted>
                    <br/>
                    <strong class="rec_dept">'.$receive_Dept.'</strong> received <strong>'.$rec_num.' Serials</strong>.<br/>
                  </p>
                </div>

                <form id="hidden_form" action="Received_Serials.php" method="POST">
                  <input type="hidden" name="dept" value="'.$receive_Dept.'">
                   <input type="hidden" name="date" value="'.$receive_RSDATE.'">
                </form>
              </div>
            ';
        
      }
    }
      

 ?>