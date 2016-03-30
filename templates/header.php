    <div class="navbar-fixed" ng-controller="Ctrl">
      <nav>
        <div class="container">
          <div class="nav-wrapper">
            <a href="" class="brand-logo">MIN</a>
            <ul class="right hide-on-med-and-down">
              <?php     
                session_start();
                if(isset($_SESSION['fname']) ){//Checking whether a user has logged in
                  //$fname=$_SESSION['fname'];
              ?>
              <li><a href="#/users">Users</a>
              </li>
              <li><a href="#/pricing">Pricing Table</a>
              </li>
              <li><a href="#/about">About</a>
              </li>
              <li><a href="#/faq">FAQ</a>
              </li>
              <li><a href="#/contact">Contact</a>
              </li>
              <li><a href="php/logout.php">Logout</a>      
              </li>

              <!-- Dropdown Trigger -->
              <li>
              
            </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </div>