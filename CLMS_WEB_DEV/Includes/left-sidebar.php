   <?php 
        echo '
        
         <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="javascript:void(0)"><img src="img/Avatars/'.$_SESSION['Avatar'].'" class="img-circle" width="95"></a></p>
          <h5 class="centered">'.$_SESSION['current_user'].'</h5>

          <li class="mt">
            <a href="index.php" id="DB">
              <i class="fa fa-home"></i>
              <span>Dash Board</span>
              </a>
          </li>

            <!-- javascript:void(0) so that if yung page na ireredirect nung link is null or nonexistent magiistay sya sa page also its good combination for ajax para maremove din yung # sa url :))) -->
            ';
          if($_SESSION['Role']=='Admin')
          {
            // ADMIN UI
          echo '
          <li>
            <a href="Request.php" id="CS">
              <i class="fa fa-handshake-o"></i>
              <span>Subscription</span>
            </a>
          </li>

          <li class="sub-menu">
            <a href="javascript:void(0)">
              <i class="fa fa-wrench"></i>
              <span>Maintenance</span> 
            </a>

             <ul class="sub">

              <li>
                <a href="manage_serials.php" class="remove-hl" id="MS">
                  <i class="fa fa-book"></i>
                  <span>Serials</span> 
                </a>
              </li>

              <li>
                <a href="Distributors.php" class="remove-hl" id="Disb">
                  <i class="fa fa-building"></i>
                  <span>Distributors</span>
                </a>
              </li>

              <li>
                <a href="Department.php" class="remove-hl" id="Dept">
                  <i class="fa fa-university"></i>
                  <span>Departments</span>
                  </a>
              </li>

               <li>
                <a href="User.php" class="remove-hl" id="MU">
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
            <a href="Archiving.php" id="arch">
              <i class="fa fa-archive"></i>
              <span>Archive</span>
              </a>
          </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>';
      }
      else
      {
        // STAFF UI
        echo '

         <li>
            <a href="manage_serials_Staff.php" id="MS_STAFF">
              <i class="fa fa-book"></i>
              <span>List Of Serials</span>
            </a>
         </li>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>

        ';
      }
     ?>
    
   