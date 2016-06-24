<?php  
session_start();   
  if(!isset($_SESSION['fname']) ){//Checking whether a user has logged in
?>
<div style="background-image: url('img/bgweb.png');height:560px">
<div class="container" ><br><br>
  <div class="row" >
    <div class="card col s12 l6 offset-l3 " >
        <div class="col s12 l10 offset-l1">
          <h4 class="light grey-text text-darken-3">Login</h4><br>
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
                    <input id="password" name="password" type="password" required/>
                    <label for="password">Password</label>
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
        <div class="card-content">
          <span style="cursor:pointer" class="activator blue-text text-darken">Forgot Password ?</span>
        </div>

        <div class="card-reveal"><br><br><br>
          <span class="card-title grey-text text-darken-4">Forgot Password<i class="material-icons right">close</i></span>
              <br>
              <form name="forgot_password" method="POST" ng-submit="forgotPassword()">
                <div class="row col s12 l10">
                  <div class="input-field">
                    <i class="material-icons prefix">email</i>
                    <input id="forgotemail" ng-model="forgotemail" name="forgotemail" type="email" required/>
                    <label  for="forgotemail">Email</label>
                    <span class="red-text" ng-show="forgot_password.forgotemail.$touched && forgot_password.forgotemail.$invalid">The Email is required.</span>
                  </div>
                </div>
                
                <div class="row col s12 l10">
                  <div ng-show="fail" class="red-text">{{fail}}</div>
                  <div ng-show="success" class="green-text">{{success}}</div>
                </div>
                <div class="row col s12 l10">
                    <div class="right">
                      <button class="btn waves-effect waves-light" type="submit" >Submit
                      </button>
                    </div>
                </div>
                
              </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php
}
else{
?>
<div class="row ">
      <div class="col s12 m3 blue lighten-4" style="height:541px">
        <br>
    
      <input name="group1" type="radio" id="test1" checked />
      <label for="test1">Time Period</label>
    
      <input name="group1" type="radio" id="test2" />
      <label for="test2">Custom Time Period</label>
    
    
  
        <div class="row" id="time">
          <div class="input-field col s12"> 
              <select id="timetype">
                <option >All</option>
                <option>This Year</option>
                <option>Last Year</option>
                <option >This Month</option>
                <option >Last Month</option>
                <option >This Week</option>
                <option >Last Week</option>
              </select>
              
          </div>
        </div>
        
        <div class="row" id="customtime">
          <div class="input-field col s12 m6"> 
              <input id="dateFrom" ng-model='from' type="date" class="datepicker">
              <label for="dateFrom">FROM</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="dateTo" ng-model='from' type="date" class="datepicker">
              <label for="dateTo">TO</label>
          </div>
        </div>

        <div class="row" id="bycatchsummery">
            <div class="card">
              <div class="card-content" style="overflow-y: scroll;height:385px">
                <h5 >By Catch Summery</h5><br>
                <div style="font-size:120%"><i class="fa fa-map-marker"></i> Lat : <span class="teal-text text-lighten-1">{{latfloor}}&#176 {{latfloor+1}}&#176</span> and Lon : <span class="teal-text text-lighten-1">{{lonfloor}}&#176 {{lonfloor+1}}&#176</span></div>
                <div style="font-size:120%">Total By Catches : <span style="font-size:150%" class="blue-text">{{total}}</span></div>

                <ul class="collection" ng-repeat="trip in trips">
                  <li>
                    <div class="col s12 m8" style="height:100px">
                    <img src="img/bycatch/{{trip.tripid}}/{{trip.image}}.jpg" style="height:100%" alt="Image not found"  class="responsive-img">
                    </div>
                    <span class="title teal-text text-lighten-1">{{trip.fishname}}</span>
                    <p> <i class="fa fa-calendar"></i> {{trip.year}}-{{trip.month}}-{{trip.day}}<br>
                    <i class="fa fa-clock-o"></i> {{trip.hour}} : {{trip.minute}}<br>
                    </p>
                    <a href="#/trip/{{trip.tripid}}" title"Trip informations"><i class="fa fa-ship"></i> Trip</a>
                  </li>
                </ul>
              </div>
            </div>
        </div>
      </div><!--left container end-->
      <div class="col s12 m6">
          <div id="gridmap" style="width:auto;height:541px;"></div>
      </div><!--map container end-->
       <div class="col s12 m3 grey lighten-4" >
        <div style="font-size:120%"><i class="fa fa-calendar"></i><span style="font-size:120%" class="blue-text"> {{timeperiod}}</span></div>
        <div style="overflow-y: scroll;height:508px">
        <table class="bordered centered ">
          <thead>
            <tr>
                <th data-field="id">Area (1&#176 * 1&#176 Square)</th>
                <th data-field="name">No. of By Catches</th>
            </tr>
          </thead>

          <tbody ng-repeat="count in counts">
            <tr>
              <td>Lat : {{count.latt}}&#176 {{count.latt+1}}&#176 Lon : {{count.lonn}}&#176 {{count.lonn+1}}&#176</td>
              <td>{{count.count}}</td>
            </tr>
            
          </tbody>
            <tr>
              <td><b>Total</b></td>
              <td><b>{{totalcount}}</b></td>
            </tr>
        </table>
      </div><!--big grid end-->
</div>

<?php
}
?>
