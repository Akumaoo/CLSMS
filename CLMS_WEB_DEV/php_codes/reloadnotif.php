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
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
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
      
  // GET ADDITIONAL INFO ON DELEYED NOTIF

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
              <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
              <p>
                <muted>'.$delivery_ERD_deleyed.'</muted>
                <br/>
                <a href="#">'.$delivery_DisbName.'</a> is already late in deliverying <strong>'.$delivery_sname.'</strong>.<br/>
              </p>
            </div>
        ';
     }
   }

 ?>