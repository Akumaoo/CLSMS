  <?php

    $receive_sqltxt="Select TOP 5 SerialName,Date_Receive_RedFlag,DepartmentID from ReceiveSerial Inner Join Notification ON ReceiveSerial.SerialID=Notification.SerialID inner join Serial On Notification.SerialID=Serial.SerialID Where Status=? AND RS_Seen=? AND NotificationType=? AND NotificationSeen=? And RS_Type IS NULL";
    $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('Received','Seen','Received','NotSeen'));

    if(sqlsrv_has_rows($receive_query))
    {
      while($receive_row=sqlsrv_fetch_array($receive_query,SQLSRV_FETCH_ASSOC))
      {

          $receive_sname=$receive_row['SerialName'];
          $receive_RSDATE=$receive_row['Date_Receive_RedFlag']->format('M-d-Y');
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
                    <strong class="rec_dept">'.$receive_Dept.'</strong> received the <strong class="serial_name">'.$receive_sname.'</strong>.<br/>
                  </p>
                </div>
              </div>
            ';
        
      }
    }
      

 ?>