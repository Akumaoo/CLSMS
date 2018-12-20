  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select Top 3 Count(ReceiveSerial.DepartmentID) as nums_depts,ReceiveSerial.DepartmentID,DateReceiveNotif_Give,Staff_Seen from Serial Inner Join ReceiveSerial On Serial.SerialID=ReceiveSerial.SerialID
  Inner Join Department on ReceiveSerial.DepartmentID=Department.DepartmentID Where Status=? and ReceiveSerial.Remove IS NULL
 Group By ReceiveSerial.DepartmentID,DateReceiveNotif_Give,Staff_Seen

";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotReceived'));
  

  if(sqlsrv_has_rows($delivery_query))
  {
    while($receive_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {
        $dept=$receive_row['DepartmentID'];
        $Date=$receive_row['DateReceiveNotif_Give']->format('M-d-Y');
        $num_rec=$receive_row['nums_depts'];
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
                echo '<a href="javascript:void(0)" class="pending_click"><span> <img src="img/sent_green.png"  height="35" width="35"> </span></a>';
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
                <input type="hidden" name="date" value="'.$Date.'">';
                if(is_null($ss))
                {
                  echo ' <input type="hidden" name="seen" value="NotSeen">';
                }
                else
                {
                  echo ' <input type="hidden" name="seen" value="Seen">';
                }
     echo ' </form>
            </div>
          ';
      
    }
  }
 ?>
