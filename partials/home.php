<?php  
session_start();   
  if(!isset($_SESSION['fname']) ){//Checking whether a user has logged in
?>

<div class="container" >
<div class="row" >
          <div class="col s12 l6 offset-l3 card-panel">

            <div class="col s12 l10 offset-l1">
              <div class="row">

              <label ><h5>Login</h5></label>
           
              </div>
              <form name="loginForm" method="POST" ng-submit="login()">
                <?php
                  if(isset($_COOKIE["email"]) && isset($_COOKIE["password"])){
                ?>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="email" name="email" type="text" value="<?=$_COOKIE['email']?>" autofocus required/>
                    <label class="active"  for="email">Email</label>
                    <span class="red-text" ng-show="loginForm.email.$touched && loginForm.email.$invalid">The Email is required.</span>

                  </div>
                </div>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" name="password" type="password" value="<?=$_COOKIE['password']?>" required/>
                    <label class="active" for="password">Password</label>
                    <span class="red-text" ng-show="loginForm.password.$touched && loginForm.password.$invalid">The Password is required.</span>
                    
                  </div>
                </div>
                <div class="row">
                  <div ng-show="message" class="red-text">{{message}}</div>
                </div>
                <div class="row">
                  <div class="input-field">
                  <input type="checkbox" name="remember" id="test5" value="1" checked/>
                  <label for="test5">Remember me</label>
                    <div class="right">
                      <button class="btn waves-effect waves-light" type="submit" >Login
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>
                <?php
                  }else{
                ?>
                  <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="email" name="email" ng-model="email" type="text" autofocus required/>
                    <label for="email">Email</label>
                    <span class="red-text" ng-show="loginForm.email.$touched && loginForm.email.$invalid">The Email is required.</span>
                    
                  </div>
                </div>
                <div class="row">
                  <div class="input-field">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" name="password" ng-model="password" type="password" required/>
                    <label for="password">Password</label>
                    <span class="red-text" ng-show="loginForm.password.$touched && loginForm.password.$invalid">The Password is required.</span>
                    
                  </div>
                </div>
                <div class="row">
                  <div ng-show="message" class="red-text">{{message}}</div>
                </div>
                <div class="row">
                  <div class="input-field">
                  <input type="checkbox" name="remember" id="test5" value="1"/>
                  <label for="test5">Remember me</label>
                    <div class="right">
                      <button class="btn waves-effect waves-light" type="submit" >Login
                        <i class="material-icons right">send</i>
                      </button>
                    </div>
                  </div>
                </div>

                <?php
                  }
                ?>
              </form>
              
            </div>
            </div>
      </div>
</div>

<?php
}
else{
?>
<div> home page</div>
 <!-- Dropdown Trigger -->

<?php
}
?>
