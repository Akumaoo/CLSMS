  <?php

    $receive_sqltxt="Select top 5 Max([Serial].[SerialName]) as 'SerialName',Max([Notification].[Date_Receive_RedFlag]) as 'Date_Receive_RedFlag',Max([ReceiveSerial].[DepartmentID]) as 'DepartmentID' from [Serial] inner Join [Notification] ON [Serial].[SerialID]=[Notification].[SerialID] left join [ReceiveSerial] ON [Notification].[SerialID]=[ReceiveSerial].[SerialID] WHERE [NotificationType]=? AND [NotificationSeen]=? AND ReceiveSerial.[Status]=? Group by NotificationID";
    $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('Received','NotSeen','Received'));

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
                    <strong>'.$receive_Dept.'</strong> received the <strong class="serial_name">'.$receive_sname.'</strong>.<br/>
                  </p>
                </div>
              </div>
            ';
        
      }
    }
      

 ?>