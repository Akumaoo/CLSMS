  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select TOP 5 Count(Subq.DepartmentID) AS NumRec,Subq.DepartmentID,DateReceiveNotif_Give,Staff_Seen from
(Select ReceiveSerial.DepartmentID,DateReceiveNotif_Give,Staff_Seen from ReceiveSerial inner join Subscription on ReceiveSerial.SerialID=Subscription.SerialID Where Subscription.Status=? AND ReceiveSerial.Status=? AND Admin_Seen IS NULL) AS Subq Group By DepartmentID,DateReceiveNotif_Give,Staff_Seen";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('OnGoing','NotReceived'));
  

  if(sqlsrv_has_rows($delivery_query))
  {
    while($receive_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {
        $dept=$receive_row['DepartmentID'];
        $Date=$receive_row['DateReceiveNotif_Give']->format('M-d-Y');
        $num_rec=$receive_row['NumRec'];
        $ss=$receive_row['Staff_Seen'];

           echo '
            <div class="pending_tab">
              <div class="thumb">
              ';
              if(is_null($ss))
              {
                echo '<a href="javascript:void(0)" class="pending_click"><span> <img src="img/alert.png"  height="35" width="35"> </span></a>';
              }
              else
              {
                echo '<a href="javascript:void(0)" class="pending_click"><span> <img src="img/receive.png"  height="35" width="35"> </span></a>';
              }
             
        echo' </div>
              <div>
                <p>
                  <muted>'.$Date.'</muted>
                  <br/>
                  <strong>'.$dept.'</strong> has <strong>'.$num_rec.'</strong> pending serials.<br/>
                </p>
              </div>

             <form id="pending_form" action="Pending_Serials.php" method="POST">
                <input type="hidden" name="dept" value="'.$dept.'">
                <input type="hidden" name="date" value="'.$Date.'">
              </form>
            </div>
          ';
      
    }
  }
 ?>
