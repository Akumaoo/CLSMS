  <?php

    $receive_sqltxt="Select TOP 3 Count(Subq.DepartmentID) AS NumRec,Subq.DepartmentID,DateReceiveNotif_Receive from
(Select ReceiveSerial.DepartmentID,DateReceiveNotif_Receive from ReceiveSerial inner join Subscription on ReceiveSerial.SerialID=Subscription.SerialID Where Subscription.Status=? AND ReceiveSerial.Status=? AND Admin_Seen IS NULL) AS Subq Group By DepartmentID,DateReceiveNotif_Receive";
    $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('OnGoing','Received'));

    if(sqlsrv_has_rows($receive_query))
    {
      while($receive_row=sqlsrv_fetch_array($receive_query,SQLSRV_FETCH_ASSOC))
      {

          $rec_num=$receive_row['NumRec'];
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
                </form>
              </div>
            ';
        
      }
    }
      

 ?>