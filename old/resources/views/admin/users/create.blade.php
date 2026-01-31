@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Add New user</h4>
        </div>
        <div class="col-12 position-relative pt-1">
    
   
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
               
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="position-relative">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>                         <span>
                     
                          </span>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="position-relative">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                
                          </span>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                
                          </span>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                
                          </span>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                
                          </span>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin">Admin</option>
                                <option value="coordinator">coordinator</option>
                                <option value="user">User</option>
                            </select>
                
                          </span>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label class="form-label">Manage Roles</label>
                          <div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-create" name="roles[]" value="create">
                              <label class="form-check-label" for="role-create">Create</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-edit" name="roles[]" value="edit">
                              <label class="form-check-label" for="role-edit">Edit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-delete" name="roles[]" value="delete">
                              <label class="form-check-label" for="role-delete">Delete</label>
                            </div>
                          </div>
                        </div>
                      </div>
              
                      <div class="col-12">
                        <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                          <span><i class="fas fa-arrow-right border-0"></i></span>
                          <span>Add</span>
                        </button>
                      </div>
                    </div>
        
                  </form>
                </div>
            </div>


        </div>
    </div>
    
    </div>
    

@include('admin.layouts.footer')
