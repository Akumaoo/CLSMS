  <?php

    $receive_sqltxt="Select [Serial].[SerialName],[Notification].[Date_Receive_RedFlag],[ReceiveSerial].[DepartmentID] from [Serial] inner Join [Notification] ON [Serial].[SerialID]=[Notification].[SerialID] left join [ReceiveSerial] ON [Notification].[SerialID]=[ReceiveSerial].[SerialID] WHERE [NotificationType]=? AND [NotificationSeen]=? AND ReceiveSerial.[Status]=?";
    $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('Received','NotSeen','Received'),$opt);

    while($receive_row=sqlsrv_fetch_array($receive_query,SQLSRV_FETCH_ASSOC))
    {

      if($receive_row!=null)
      {
        $receive_sname=$receive_row['SerialName'];
        $receive_RSDATE=$receive_row['Date_Receive_RedFlag']->format('M-d-Y');
        $receive_Dept=$receive_row['DepartmentID'];

        //SETTING VALUE OF COURSENAME
           echo '
            
              <div class="thumb">
                <span class=""> <img src="img/receive.png"  height="35" width="35"> </span>
              </div>
              <div class="details">
                <p>
                  <muted>'.$receive_RSDATE.'</muted>
                  <br/>
                  <a href="#">'.$receive_Dept.'</a> received the <strong>'.$receive_sname.'</strong>.<br/>
                </p>
              </div>
          ';
      }
    }
      

 ?>