  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select TOP 5 DepartmentID,DateReceiveNotif_Give,SerialID from ReceiveSerial Where [Status]=? ";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotReceived'));
  

  if(sqlsrv_has_rows($delivery_query))
  {
    while($receive_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {
        $dept=$receive_row['DepartmentID'];
        $Date=$receive_row['DateReceiveNotif_Give']->format('M-d-Y');
        $serialID=$receive_row['SerialID'];

        $snamesql="Select SerialName from Serial Where SerialID=?";
        $query=sqlsrv_query($conn,$snamesql,array($serialID));
        $rows=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC);
        $sname=$rows['SerialName'];

        //SETTING VALUE OF COURSENAME
           echo '
            <div class="receive_tab">
              <div class="thumb">
                <span> <img src="img/receive.png"  height="35" width="35"> </span>
              </div>
              <div>
                <p>
                  <muted class="date">'.$Date.'</muted>
                  <br/>
                  <strong>'.$sname.'</strong> is not yet received (<strong>'.$dept.')</strong>.<br/>
                </p>
              </div>
            </div>
          ';
      
    }
  }
 ?>
