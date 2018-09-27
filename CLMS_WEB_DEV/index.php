<?php 
include 'Includes/header.php';
require 'php_codes/db.php'
 ?>
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <div class="row main-chart">
          <div class="col-lg-9">

            <div class="row">
             <?php
                 $query = sqlsrv_query ($conn, 'SELECT * FROM Department');
              if ($query){
                
                if(sqlsrv_has_rows($query) === true){
                  while ($row = sqlsrv_fetch_array($query)){
                    ?>
                    <div class = "col-sm-6 col-xl-5">
                      <form method = "post" action = "">
                        <div class = "dept">
                          <a href= "details.php?ID=<?php echo $row['DepartmentID']; ?>"> <img src ="img/<?php echo $row['DepartmentImage']; ?>"class = 'img-responsive'"/></a>
                          <h4 class = "text-center"> <a href= "details.php?ID=<?php echo $row['DepartmentID']; ?>"> <?php echo $row['DepartmentName']; ?></a></h4>
                        </div>
                      </form>
                    </div>
                    <?php
                  }
                }
                else{
                  echo "There are no rows. <br />";
                }
              }

              ?>
            </div>
            <!-- /row -->
          </div>
          <!-- /col-lg-9 END SECTION MIDDLE -->
          
          <!--right Sidebar-->
          <?php include 'includes/right-sidebar.php'; ?>
        </div>
        <!-- /row -->
      </section>

    </section>
    <!--main content end-->
   <?php
   include 'Includes/footer.php';
   ?>
 
  <!--script for this page-->
  <script src="lib/zabuto_calendar.js"></script>

  <script type="application/javascript">
    $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      $("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);

    }
  </script>
  <!-- Script for left category click -->

<!--   <script type="text/javascript">
  $(function(){
    
      setInterval(function(){
          $.ajax({
          url:'php_codes/reloadnotif.php',
          success:function(data){
            $('#notifbox').html(data).hide().slideDown(1000);    
             }
          }); 
    },1000*10*1);

  });
</script> -->
</body>

</html>
