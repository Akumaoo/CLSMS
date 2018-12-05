  <?php
  // GET ADDITIONAL INFO ON DELAYED NOTIF

  $delivery_sqltxt="Select TOP 3 Count(DistributorName) AS num_rec,DistributorName,IDD_Phase from Subscription Inner Join Distributor ON Subscription.DistributorID=Distributor.DistributorID WHERE InitialDeliveryDate<CONVERT(VARCHAR(10), GETDATE(), 110) AND Subscription.Status=? AND IDD_Phase!=? AND Subscription.Remove IS NULL Group By DistributorName,IDD_Phase
";

  $delivery_query=sqlsrv_query($conn,$delivery_sqltxt,array('OnGoing','Complete'));
 
    while($delivery_row=sqlsrv_fetch_array($delivery_query,SQLSRV_FETCH_ASSOC))
    {

      if($delivery_row!=null)
      {
        $delivery_DisbName=$delivery_row['DistributorName'];
        $num_rec=$delivery_row['num_rec'];
        $phase=$delivery_row['IDD_Phase'];
        $date=date('M-d-Y');

        
          echo '
            <div class="deleyed_tab">
              <div class="thumb">';
              if($phase=='Phase2')
                { 
                 echo '<a href="javascript:void(0)" class="click_seen_deleyed"> <span class=""> <img src="img/alert3.png"  height="35" width="35"> </span></a>';
                }
                else
                {
                  echo '<a href="javascript:void(0)" class="click_seen_deleyed"> <span class=""> <img src="img/alert.png"  height="35" width="35"> </span></a>';
                }
                echo '
              </div>
              <div class="details">
                <p>
                  <muted>'.$date.'</muted>
                  <br/><span hidden class="Type">DeleyedDeliver_P2</span>
                 <strong>'.$delivery_DisbName.'</strong> has <strong>'.$num_rec.'</strong> late <strong>'.$phase.'</strong> delivery.<br/>
                </p>
              </div>

             <form id="late_deliv_form" action="Late_Deliv.php" method="POST">
              <input type="hidden" name="disb" value="'.$delivery_DisbName.'">
              <input type="hidden" name="phase" value="'.$phase.'">
            </form>
            </div>';
        }
     }

 ?>