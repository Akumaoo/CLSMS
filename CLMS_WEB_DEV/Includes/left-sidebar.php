   <?php 
    if($_SESSION['Role']=='Admin')
      {
        echo '
        
         <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php"><img src="img/Avatars/'.$_SESSION['Avatar'].'" class="img-circle" width="95"></a></p>
          <h5 class="centered">'.$_SESSION['current_user'].'</h5>

          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-home"></i>
              <span>Dash Board</span>
              </a>
          </li>

            <!-- javascript:void(0) so that if yung page na ireredirect nung link is null or nonexistent magiistay sya sa page also its good combination for ajax para maremove din yung # sa url :))) -->

          <li>
            <a href="javascript:void(0)" id="CS">
              <i class="fa fa-handshake-o"></i>
              <span>Subscription</span>
            </a>
          </li>

          <li>
            <a href="javascript:void(0)" id="Deli">
              <i class="fa fa-truck"></i>
              <span>Manage Deliveries</span> 
            </a>
          </li>

          <li class="sub-menu">
            <a href="javascript:void(0)">
              <i class="fa fa-book"></i>
              <span>Serials</span> 
            </a>

             <ul class="sub">
              <li>
                <a href="javascript:void(0)" class="remove-hl" id="MS">
                  <i class="fa fa-plus-square"></i>
                  <span>Manage Serial</span>
                </a>
              </li>

              <li>
                <a href="javascript:void(0)" class="remove-hl" id="SS">
                  <i class="fa fa-paper-plane"></i>
                  <span>Send Serials</span>
                </a>
              </li>

              </ul>

          </li>

          <li class="sub-menu">
            <a href="javascript:void(0)">
              <i class="fa fa-wrench"></i>
              <span>Maintenance</span> 
            </a>

             <ul class="sub">
              <li>
                <a href="javascript:void(0)" class="remove-hl" id="Disb">
                  <i class="fa fa-building"></i>
                  <span>Distributors</span>
                </a>
              </li>

              <li>
                <a href=javascript:void(0)" class="remove-hl" id="Dept">
                  <i class="fa fa-university"></i>
                  <span>Departments</span>
                  </a>
              </li>

              <li>
                <a href="javascript:void(0)" class="remove-hl" id="MT">
                  <i class="fa fa-plus-square"></i>
                  <span>Manage Type</span>
                </a>
              </li>

               <li>
                <a href="javascript:void(0)" class="remove-hl" id="MU">
                  <i class="fa fa-user-plus"></i>
                  <span>Manage User</span>
                </a>
              </li>

              </ul>

          </li>

         

          <li>
            <a href=javascript:void(0)" id="overallreport">
              <i class="fa fa-line-chart"></i>
              <span>Reports</span>
              </a>
          </li>

          <li>
            <a href="javascript:void(0)" id="arch">
              <i class="fa fa-archive"></i>
              <span>Archive</span>
              </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

        ';
    }
    else
    {

      echo '

       <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php"><img src="img/02.jpg" class="img-circle" width="95"></a></p>
          <h5 class="centered">'.$_SESSION['current_user'].'</h5>

          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-home"></i>
              <span>Dash Board</span>
              </a>
          </li>

            <!-- javascript:void(0) so that if yung page na ireredirect nung link is null or nonexistent magiistay sya sa page also its good combination for ajax para maremove din yung # sa url :))) -->

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

      ';
    }
     ?>
    }
   