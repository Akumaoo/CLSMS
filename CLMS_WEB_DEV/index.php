<?php 
include 'Includes/header.php';
require 'php_codes/db.php'
 ?>
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
		<div class="main-chart">
		  <div class="row custom-box">
		  
	        <div>

            <div class="col-md-2 profile-text mt mb centered">    
						<div><h3 class="custom-pos mt">Journals</h3></div>
				<div class="right-divider hidden-sm hidden-xs ">
                  <h4 >1922</h4>
                  <h6 class="custom-text1">ELEMENTARY</h6>
                  <h4>290</h4>
                  <h6 class="custom-text1">JUNIOR HIGH</h6>
                </div>
				
            </div>
	        <div class="col-md-2 profile-text mt mb centered custom-sect">
        
				<div class="right-divider hidden-sm hidden-xs ">

                  <h4>13,980</h4>
                  <h6 class="custom-text1">SENIOR HIGH</h6>
				  <h4>13,980</h4>
                  <h6 class="custom-text1">COLLEGE</h6>
                </div>
				
            </div>
			
		</div>
		              <div class="col-md-4 profile-text">
                
                <h1 class="custom-sect1">College Library Serial Monitoring System</h1>
               <br>
              </div>
              <!-- /col-md-4 -->

				</div>
		
	<!---TAb-->
	<div class="col-lg-12  ">
        <div class="row content-panel">
              <div class="panel-heading">
                <ul class="nav nav-tabs nav-justified">
                  <li class="active">
                    <a data-toggle="tab" href="#notification">Notification</a>
                  </li>
                  <li>
                    <a data-toggle="tab" href="#overview">Overview</a>
                  </li>

                </ul>
              </div>
	<!---TAb--> 
<!---panelbody-->
 <div class="panel-body">
 <!---content-->
	<div class="tab-content">
		<div id="notification" class="tab-pane active">
			<div class="row">
	<!---notifbar-->	
		<div class=" ">
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="custom-boxx centered" id="NotifContainer" >
              <div  id='notifbox'>
			  <h4>SENT SERIALS</h4>
			  <hr>               
              </div>			 
            </div>
          </div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">	
			<div class="custom-boxx centered" id="NotifContainer" >
              <div  id='notifbox'>
			  <h4>RECEIVED SERIALS</h4>
			  <hr>
			  <br>
                <?php include 'php_codes/receivenotif.php'?>
             </div>			 
            </div>
          </div>
		  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="custom-boxx centered" id="NotifContainer" >
              <div  id='notifbox'>
			  <h4>LATE DELIVERY</h4>
			  <hr>
			  <br>
                <?php include 'php_codes/latenotif.php'?>
              </div>
			 
            </div>
        </div>
		</div>
	<!---notifbar-->		
	</div>
</div>
			
	<div id="overview" class="tab-pane ">
		<div class="row">
			            <!--CUSTOM CHART START -->
            <div class="border-head">
              <h3>Subscription Chart</h3>
            </div>
            <div class="custom-bar-chart">
              <ul class="y-axis">
                <li><span><?php include 'php_codes/barchart_count.php'?></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
            
                <li><span>0</span></li>
              </ul>
              <div class="bar">
			  <div class="title">On Going</div>
                <?php include 'php_codes/barchart_ongoing.php'?>
              </div>
              <div class="bar ">
                <div class="title">Cancelled</div>
                <?php include 'php_codes/barchart_cancelled.php'?>
              </div>
              <div class="bar ">
                <div class="title">Refunded</div>
               <?php include 'php_codes/barchart_refunded.php'?>
              </div>
              <div class="bar ">
                <div class="title">Finished</div>
                <?php include 'php_codes/barchart_finished.php'?>
              </div>

            </div>
            <!--custom chart end-->
		</div>
	</div>
	
	</div>
 <!---content-->		
</div>
<!---panelbody-->	  

            </div>
		
     </div>
	  


          <!-- /col-lg-12 -->
  
           </div>
          
            <!-- /col-lg-12 -->
          </div>		
        <!-- /row -->
      </section>

    </section>
    <!--main content end-->
   <?php
   include 'Includes/footer.php';
   // check for deleyed deliveries
   include 'php_codes/Check_Deliveries.php';
   ?>
</body>

</html>

<!-- CUSTOM SCRIPT -->
<script>
  $(function(){
    $('.click_seen_deleyed').click(function(){
      $pack=$(this).closest('.deleyed_tab').find('.pack_name').text();
      
      $.ajax({
        url:'php_codes/update_seen_deleyed.php',
        method:'POST',
        data:{pn:$pack},
        success:function(data)
        {
          if(data=='success')
          {
            location.reload(true);
          }
          else
          {
            alert('fail');
          }

        }
      });
    });

  });
</script>