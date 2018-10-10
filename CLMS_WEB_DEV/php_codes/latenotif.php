  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select top 5 MAX(DistributorName) AS 'DistributorName',PackageName,MAX(ReceiveDate) as 'ReceiveDate',MAX(ExpectedReceiveDate) as 'ExpectedReceiveDate',MAX(Date_Receive_RedFlag) as 'Date_Receive_RedFlag',Max(NotificationType) as 'NotificationType' from Notification inner join Subscription on Notification.SerialID=Subscription.SerialID inner join Distributor on Subscription.DistributorID=Distributor.DistributorID inner join Delivery on Subscription.SerialID=Delivery.SerialID inner join Package_Delivery on Delivery.PackageID= Package_Delivery.PackageID WHERE [Notification].[NotificationSeen]=? AND ([Notification].[NotificationType]=? OR NotificationType=?)  AND Status=? group by PackageName ";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotSeen','DeleyedDeliver_P1','DeleyedDeliver_P2','OnGoing'));
 
    while($delivery_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {

      if($delivery_row!=null)
      {
        $delivery_sname=$delivery_row['PackageName'];
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
                  <br/>
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
                  <br/>
                 <strong>'.$delivery_DisbName.'</strong> is already late in deliverying <strong class="pack_name">'.$delivery_sname.'</strong>.<br/>
                </p>
              </div>
            </div>
          ';
        }
     }
   }

 ?>