  <?php
     $initial_notif_launch="Select [Serial].[SerialName],[Notification].[NotificationType],[Notification].[NotificationSeen] from Serial Inner Join [Notification] ON [Serial].[SerialID]=[Notification].[SerialID] Where [Notification].[NotificationSeen]=?";
      $opt=array('Scrollable'=>'keyset');
      $query=sqlsrv_query($conn,$initial_notif_launch,array('NotSeen'),$opt);

      
      if(sqlsrv_has_rows($query))
      {
        while($row=sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC))
        {
          $Sname=$row['SerialName'];
          $NotifType=$row['NotificationType'];

          // GET EXTRA INFO
          // GET ADDITIONAL INFO ON RECEIVED NOTIF
          if($NotifType=='Received')
          {
            $receive_sqltxt="Select [Serial].[SerialName],[ReceiveSerial].[RSDate],[ReceiveSerial].[DepartmentID] from [Serial] inner Join [Notification] ON [Serial].[SerialID]=[Notification].[SerialID] left join [ReceiveSerial] ON [Notification].[SerialID]=[ReceiveSerial].[SerialID] WHERE [ReceiveSerial].[Status]=? AND [NotificationSeen]=? AND [Serial].[SerialName]=?";
            $receive_query=sqlsrv_query($conn,$receive_sqltxt,array('Received','NotSeen',$Sname),$opt);

            $receive_row=sqlsrv_fetch_array($receive_query,SQLSRV_FETCH_ASSOC);

            if($receive_row!=null)
            {
              $receive_sname=$receive_row['SerialName'];
              $receive_RSDATE=$receive_row['RSDate']->format('M-d-Y');
              $receive_Dept=$receive_row['DepartmentID'];

              //SETTING VALUE OF COURSENAME
              if(isset($receive_row['CourseName']))
              {
                $receive_course=$receive_row['CourseName'];
              }

              //!College
              if(!isset($receive_course))
              {   

                 echo '
                  
                    <div class="thumb">
                      <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                      <p>
                        <muted>'.$receive_RSDATE.'</muted>
                        <br/>
                        <a href="#">'.$receive_Dept.'</a> received the '.$receive_sname.'.<br/>
                      </p>
                    </div>
                ';

              }
              //COLLEGE
              else
              {
                 echo '
                  
                    <div class="thumb">
                      <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                      <p>
                        <muted>'.$receive_RSDATE.'</muted>
                        <br/>
                        <a href="#">'.$receive_course.'</a> received the '.$receive_sname.'.<br/>
                      </p>
                    </div>
                ';
              }
            }


          }
          // GET ADDITIONAL INFO ON DELEYED NOTIF
          else
          {
            $delivery_sqltxt="Select [Serial].[SerialName],[Notification].[NotificationType],[Notification].[NotificationSeen],[Distributor].[DistributorName],[Delivery].[ExpectedReceiveDate] from Serial Inner Join [Notification] ON [Serial].[SerialID]=[Notification].[SerialID] Right JOIN Subscription ON [Notification].[SerialID]=[Subscription].[SerialID] INNER JOIN Delivery ON [Subscription].[DistributorID]=[Delivery].[DistributorID] LEFT JOIN [Distributor] ON [Delivery].[DistributorID]=[Distributor].[DistributorID] Where [Notification].[NotificationSeen]=? AND [Notification].[NotificationType]=? AND [Serial].[SerialName]=?";

            $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('NotSeen','DeleyedDeliver',$Sname),$opt);
           
              $delivery_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC);

              if($delivery_row!=null)
              {
                $delivery_sname=$delivery_row['SerialName'];
                $delivery_DisbName=$delivery_row['DistributorName'];
                $delivery_ERD_deleyed=$delivery_row['ExpectedReceiveDate']->modify('+1 day')->format('M-d-Y');


                echo '
                  
                    <div class="thumb">
                      <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                    </div>
                    <div class="details">
                      <p>
                        <muted>'.$delivery_ERD_deleyed.'</muted>
                        <br/>
                        <a href="#">'.$delivery_DisbName.'</a> is already late in deliverying'.$delivery_sname.'.<br/>
                      </p>
                    </div>
                ';
             }
            
          }
        }
      }

 ?>