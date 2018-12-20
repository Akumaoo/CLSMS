  <?php

    $receive_sqltxt="Select Top 3 Count(ReceiveSerial.DepartmentID) as nums_depts,ReceiveSerial.DepartmentID,DateReceiveNotif_Receive,Staff_Seen from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
  Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status=? and ReceiveSerial.Remove IS NULL and Admin_Seen IS NULL
 Group By ReceiveSerial.DepartmentID,DateReceiveNotif_Receive,Staff_Seen";
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