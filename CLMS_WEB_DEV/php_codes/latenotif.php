  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select top 5 DistributorName,SerialName,Date_Receive_RedFlag,IDD_Phase,Date_Receive_RedFlag,NotificationType from Notification inner join Serial ON Notification.SerialID=Serial.SerialID Inner Join Subscription on Serial.SerialID=Subscription.SerialID inner join Distributor on Subscription.DistributorID=Distributor.DistributorID WHERE [Notification].[NotificationSeen]=? AND NotificationType!=?  AND Status=? AND IDD_Phase IS NOT NULL";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotSeen','Received','OnGoing'));
 
    while($delivery_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {

      if($delivery_row!=null)
      {
        $delivery_sname=$delivery_row['SerialName'];
        $delivery_DisbName=$delivery_row['DistributorName'];
        $delivery_ERD_deleyed=$delivery_row['Date_Receive_RedFlag']->format('M-d-Y');
        $NotifType=$delivery_row['NotificationType'];

        if($NotifType=='DeleyedDeliver_P2')
        {
          echo '
            <div class="deleyed_tab">
              <div class="thumb">
                  <a href="javascript:void(0)" class="click_seen_deleyed"> <span class=""> <img src="img/alert3.png"  height="35" width="35"> </span></a>
              </div>
              <div class="details">
                <p>
                  <muted>'.$delivery_ERD_deleyed.'</muted>
                  <br/><span hidden class="Type">DeleyedDeliver_P2</span>
                 <strong>'.$delivery_DisbName.'</strong> is already late in deliverying <strong class="pack_name">'.$delivery_sname.'</strong>.<br/>
                </p>
              </div>
            </div>
          ';
        }
        else
        {
           echo '
            <div class="deleyed_tab">
              <div class="thumb">
                  <a href="javascript:void(0)" class="click_seen_deleyed"> <span class=""> <img src="img/alert.png"  height="35" width="35"> </span></a>
              </div>
              <div class="details">
                <p>
                  <muted>'.$delivery_ERD_deleyed.'</muted>
                  <br/><span hidden class="Type">DeleyedDeliver_P1</span>
                 <strong>'.$delivery_DisbName.'</strong> is already late in deliverying <strong class="pack_name">'.$delivery_sname.'</strong>.<br/>
                </p>
              </div>
            </div>
          ';
        }
     }
   }

 ?>