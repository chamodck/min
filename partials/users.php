<div class="row ">
      <div class="col s12 m3 blue lighten-4" style="height:541px">
        <div class="col s12 "><h5>Add a New User</h5></div>
        <a class="waves-effect waves-light btn modal-trigger" href="#modalNewUser">New User</a>

        <!-- Modal Structure -->
            <div id="modalNewUser" class="modal ">
              <div class="modal-content">
                <h4>New User</h4>
                
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

                        <span class="green-text">{{success}}</span>
                        <span class="red-text">{{fail}}</span>
                        <div class="modal-footer">
                          <button class=" modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="action">Submit</button>
                          <a class=" modal-action modal-close waves-effect waves-red btn-flat">Cancel</a>
                        </div>
                    </form>

              </div>
              
            </div><!--new user modal end-->


        <div class="input-field">   
          <i class="material-icons prefix">search</i>                     
          <input name="search" ng-model="search" id="search" type="text">
          <label for="search">Search</label>
        </div>  


      </div><!--small container end-->
      <div class="col s12 m9">
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
            <tr ng-repeat="user in users | filter:paginate| filter:search">
              <td>{{user.fname}}</td>
              <td>{{user.lname}}</td>
              <td>{{user.email}}</td>
              <td>{{user.type}}</td>
              <td>{{user.contact_no}}</td>
              <td>
                <a class="btn-floating waves-effect waves-light" title="Edit" ng-click="editModal(user.id)"><i class="material-icons">mode_edit</i></a>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="col s12 l6 offset-l3">
          <pagination total-items="totalItems" ng-model="currentPage"  
                 max-size="5" boundary-links="true"  
                 items-per-page="numPerPage" class="pagination-sm">  
           </pagination>  
        </div>

        <div id="userEditModal" class="modal ">
              <div class="modal-content">
                <h4>Edit User</h4>
                    <form name="editForm" method="POST" ng-submit="updateUser()">
                            <div class="row col s12 l6">
                                 <div class="input-field">
                                <i class="material-icons prefix">person</i>
                                <input name="fname" placeholder="First Name" ng-model="editfname" type="text" class="validate" pattern="[a-zA-Z]*" required>
                                
                                <span class="red-text" ng-show="signupForm.editfname.$touched && signupForm.editfname.$error.required">The First Name is required.</span>
                                <span class="red-text" ng-show="signupForm.editfname.$touched && signupForm.editfname.$error.pattern">Use Letters.</span>
                                
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input name="lname" placeholder="Last Name" ng-model="editlname" type="text" class="validate" pattern="[a-zA-Z]*" required>
                                    <span class="red-text" ng-show="signupForm.editlname.$touched && signupForm.editlname.$error.required">The Last Name is required.</span>
                                    <span class="red-text" ng-show="signupForm.editlname.$touched && signupForm.editlname.$error.pattern">Use Letters.</span>
                                </div>
                            </div>

                            <div class="row col s12 l12">
                                <div class="input-field ">
                                    <i class="material-icons prefix">email</i>
                                    <input name="email" placeholder="Email" ng-model="editemail" type="email" class="validate" disabled  required>
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input name="telephone" placeholder="Contact Number" ng-model="editcontact"  type="text" class="validate" pattern="[0-9]{10}" required>
                                    
                                    <span class="red-text" ng-show="signupForm.editcontact.$touched && signupForm.editcontact.$error.required">The Contact Number is required.</span>
                                    <span class="red-text" ng-show="signupForm.editcontact.$touched && signupForm.editcontact.$error.pattern">Insert 10 Numbers.</span>
                                </div>
                            </div>
                              
                            <div class="row col s12 l6">
                                <div class="input-field col s12"> 
                                    <select id="editusertype">
                                      <option value="Viewer">Viewer</option>
                                      <option value="Scientific Observer">Scientific Observer</option>
                                      <option value="Admin">Admin</option>
                                    </select>
                                    <label>User Type</label>
                                </div>
                            </div>
                            <input type="hidden" ng-model="hiddenid">
                        <span class="green-text">{{success1}}</span>
                        <span class="red-text">{{fail1}}</span>
                        <div class="modal-footer">
                          <button class=" modal-action modal-close waves-effect waves-green btn-flat" type="submit" name="action">Submit</button>
                          <a class=" modal-action modal-close waves-effect waves-red btn-flat">Cancel</a>
                        </div>
                    </form>
              </div>
            </div><!--modal end-->
      </div><!--big grid end-->
</div>
