  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select MAX(DistributorName) AS 'DistributorName',PackageName,MAX(ReceiveDate) as 'ReceiveDate',MAX(ExpectedReceiveDate) as 'ExpectedReceiveDate',MAX(Date_Receive_RedFlag) as 'Date_Receive_RedFlag',MAX(Package_Phase) as 'Package_Phase' from Notification inner join Subscription on Notification.SerialID=Subscription.SerialID inner join Distributor on Subscription.DistributorID=Distributor.DistributorID inner join Delivery on Subscription.SerialID=Delivery.SerialID inner join Package_Delivery on Delivery.PackageID= Package_Delivery.PackageID WHERE [Notification].[NotificationSeen]=? AND [Notification].[NotificationType]=? group by PackageName ";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotSeen','DeleyedDeliver'),$opt);
 
    while($delivery_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {

      if($delivery_row!=null)
      {
        $delivery_sname=$delivery_row['PackageName'];
        $delivery_DisbName=$delivery_row['DistributorName'];
        $delivery_ERD_deleyed=$delivery_row['Date_Receive_RedFlag']->format('M-d-Y');


        echo '
          
            <div class="thumb">
                <span class=""> <img src="img/alert2.png"  height="35" width="35"> </span>
            </div>
            <div class="details">
              <p>
                <muted>'.$delivery_ERD_deleyed.'</muted>
                <br/>
                <a href="#">'.$delivery_DisbName.'</a> is already late in delivery! <strong>'.$delivery_sname.'</strong>.<br/>
              </p>
            </div>
        ';
     }
   }

 ?>