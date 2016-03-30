<div class = "container"><!--all page center-->
    <div class="row">
    <div class= "col s12 l8 offset-l2 card-panel">
        <div class="col s12 l10 offset-l1">
            <div class="row"></div><!--Brack between card above margin and "Users Registration Form" name -->
              <label><h5>Users Registration Form</h5></label>

                <div class="row">
                    <form >
                        
                            <div class="row col s12 l6">
                                 <div class="input-field">
                                <i class="material-icons prefix">person</i>
                                <input  id="first_name" type="text" class="validate" >
                                <label for="first_name">First Name</label>
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">person</i>
                                    <input id="last_name" type="text" class="validate">
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>

                            <div class="row col s12 l12">
                                <div class="input-field ">
                                    <i class="material-icons prefix">email</i>
                                    <input id="email" type="email" class="validate">
                                    <label for="email" data-error="wrong" >Email</label>
                                </div>
                            </div>

                            <div class="row col s12 l6">
                                <div class="input-field">
                                    <i class="material-icons prefix">phone</i>
                                    <input id="icon_telephone" type="tel" class="validate" max-length="10">
                                    <label for="icon_telephone">Telephone</label>
                                </div>
                            </div>
                            <div class="row col s12 l6">
                                <div class="input-field col s12"> 
                                    <select>
                                      <option value="2">Viewer1</option>
                                      <option value="3">Viewer2</option>
                                      <option value="1">Admin</option>
                                    </select>
                                    <label>User Type</label>
                                </div>
                            </div>

                            

                        <div>

                          <button class="right btn waves-effect waves-light" type="submit" name="action">Submit</button>

                        </div>

                        {{message}}
                        
                    </form>
                </div>
             </div>
            
</div>
</div>
</div>
