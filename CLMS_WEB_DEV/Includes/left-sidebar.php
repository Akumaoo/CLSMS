    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php"><img src="img/02.jpg" class="img-circle" width="95"></a></p>
          <h5 class="centered">Akumao</h5>

          <li class="mt">
            <a class="active" href="index.php">
              <i class="fa fa-home"></i>
              <span>Main Menu</span>
              </a>
          </li>

            <!-- javascript:void(0) so that if yung page na ireredirect nung link is null or nonexistent magiistay sya sa page also it's good combination for ajax para maremove din yung # sa url :))) -->
          <li>
            <a href="javascript:void(0)">
              <i class="fa fa-handshake-o"></i>
              <span>Subscription</span>
            </a>

            <ul class="sub">
              <li class="sub-menu child-tab">
                <a href="currentsubscribe.php" class="remove-hl">
                  <span>Current Subscription</span>
                </a>
              </li>

              <li class="sub-menu child-tab">
                  <a href="javascript:void(0)" class="remove-hl">
                  <span>Subscribe</span>
                </a>
              </li>
            </ul>
          </li>

          <li>
            <a href="javascript:void(0)">
              <i class="fa fa-paper-plane"></i>
              <span>Send Serials</span> 
            </a>
          </li>

          <li>
            <a href="javascript:void(0)">
              <i class="fa fa-line-chart"></i>
              <span>Reports</span>
              </a>
          </li>
          
            <!--DATA TAB-->
          <li class="sub-menu">
            <a href="javascript:void(0)">
              <i class="fa fa-file"></i>
              <span>Data's</span>
              </a>
            
            <!--ADD TAB-->
            <ul class="sub">
              <li class="sub-menu">
                <a href="javascript:void(0)" class="remove-hl">
                  <i class="fa fa-plus-square"></i>
                  <span>Add</span>
                </a>
                <ul class="sub">

                  <li class="sub-menu child-tab">
                    <a href="javascript:void(0)" class="remove-hl" id='adduser'>
                      <span>User</span>
                    </a>
                  </li>

                  <li class="sub-menu child-tab">
                    <a href="javascript:void(0)" class="remove-hl" id='adddistrib'>
                      <span>Distributor</span>
                    </a>
                  </li>

                  <li class="sub-menu child-tab">
                    <a href="javascript:void(0)" class="remove-hl" id='addserial'>
                      <span>Serial</span>
                    </a>
                  </li>

                  <li class="sub-menu child-tab">
                    <a href="javascript:void(0)" class="remove-hl" id='addtype'>
                      <span>Serial Type</span>
                    </a>
                  </li>
                  
                </ul>
              </li>

              <li>
                <a href="javascript:void(0)"  class="remove-hl">
                  <i class="fa fa-pencil"></i>
                  <span>Modify</span>
               </a>
              </li>

              <li>
                <a href="javascript:void(0)"  class="remove-hl">
                  <i class="fa fa-trash"></i>
                  <span>Delete</span>
                </a>
            </li>
            </ul>
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
