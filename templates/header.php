    <div class="navbar-fixed" ng-controller="Ctrl">
      <nav>
        <div class="container">
          <div class="nav-wrapper">
            <a href="http://localhost/min/#/" class="brand-logo">MIN</a>

            <ul class="right hide-on-med-and-down">
              <?php     
                session_start();
                if(isset($_SESSION['fname'])){//Checking whether a user has logged in
                  //$fname=$_SESSION['fname'];
              
                  if($_SESSION['type']=="Admin"){
              ?>
                  <li><a href="#/users">Users</a>
                  </li>
              <?php
                }
              ?>
              <!-- Dropdown Trigger -->
              <li>
                <!-- Dropdown Trigger -->
                <a class='dropdown-button' href='#' data-activates='dropdown1'><?=$_SESSION['fname']?></a>
                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                  <li><a href="#!">Profile</a></li>
                  <li><a href="php/logout.php">Logout</a></li>
                </ul>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>