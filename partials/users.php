<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#tab1">Users</a>hthtyj</li>
            <li class="tab col s3"><a href="#tab2">New User</a></li>
        </ul>
    </div>
</div>

<div class = "container" id="tab1"><!--all page center-->
    
    <table class="highlight bordered">
        <thead>
          <tr>
              <th data-field="id">First Name</th>
              <th data-field="name">Last Name</th>
              <th data-field="price">Email</th>
              <th data-field="price">User Type</th>
              <th data-field="price">Contact NO</th>
          </tr>
        </thead>

        <tbody>
          <tr ng-repeat="user in users">
            <td>{{user.fname}}</td>
            <td>{{user.lname}}</td>
            <td>{{user.email}}</td>
            <td>{{user.type}}</td>
            <td>{{user.contact_no}}</td>
          </tr>
        </tbody>
      </table>
</div>       
<div class = "container" id="tab2">
    <div class="row">
    <div class= "col s12 l8 offset-l2 card-panel">
        <div class="col s12 l10 offset-l1">
            <div class="row"></div><!--Brack between card above margin and "Users Registration Form" name -->
              <label><h5>Users Registration Form</h5></label>

                <div class="row">
                    <form name="signupForm" method="POST" ng-submit="signup()">
                        
                            <div class="row col s12 l6">
                                 <div class="input-field">
                                <i class="material-icons prefix">person</i>
                                <input name="fname" ng-model="fname" id="first_name" type="text" class="validate" pattern="[a-zA-Z]*" required>
                                <label for="first_name">First Name</label>
                                <span class="red-text" ng-show="signupForm.fname.$touched && signupForm.fname.$error.required">The First Name is required.</span>
                                <span class="red-text" ng-show="signupForm.fname.$touched && signupForm.fname.$error.pattern">Use Letters.</span>
                                
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input name="lname" ng-model="lname" id="last_name" type="text" class="validate" pattern="[a-zA-Z]*" required>
                                    <label for="last_name">Last Name</label>
                                    <span class="red-text" ng-show="signupForm.lname.$touched && signupForm.lname.$error.required">The Last Name is required.</span>
                                    <span class="red-text" ng-show="signupForm.lname.$touched && signupForm.lname.$error.pattern">Use Letters.</span>
                                </div>
                            </div>

                            <div class="row col s12 l12">
                                <div class="input-field ">
                                    <i class="material-icons prefix">email</i>
                                    <input name="email" ng-model="email" id="email" type="email" class="validate" required>
                                    <label for="email" data-error="wrong" >Email</label>
                                    <span class="red-text" ng-show="signupForm.email.$touched && signupForm.email.$invalid">The Email is required.</span>
                                    <span class="red-text">{{emailError}}</span>
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="telephone" ng-model="telephone" id="telephone" type="text" class="validate" pattern="[0-9]{10}" required>
                                    <label for="telephone">Contact Number</label>
                                    <span class="red-text" ng-show="signupForm.telephone.$touched && signupForm.telephone.$error.required">The Contact Number is required.</span>
                                    <span class="red-text" ng-show="signupForm.telephone.$touched && signupForm.telephone.$error.pattern">Insert 10 Numbers.</span>
                                </div>
                            </div>
                            <div class="row col s12 l6">
                                <div class="input-field col s12"> 
                                    <select ng-model="usertype" id="usertype">
                                      <option >Viewer</option>
                                      <option >Scientific Observer</option>
                                      <option >Admin</option>
                                    </select>
                                    <label>User Type</label>
                                </div>
                            </div>
                            
                        <div>

                          <button class="right btn waves-effect waves-light" type="submit" name="action">Submit</button>

                        </div>
                        <span class="green-text">{{success}}</span>
                        <span class="red-text">{{fail}}</span>
                    </form>
                    
                </div>
             </div>
            
</div>
</div>
</div>
