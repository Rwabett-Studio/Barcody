@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit User</h4>
        </div>
        <div class="col-12 position-relative pt-1">
    
   
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
               
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                    <div class="row">

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>           
                            
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>                       <span>
       
                          </span>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>                  <span>
       
                          </span>
                        </div>
                      </div>


                      <div class="col-12">
                        <div class="position-relative">
                            <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                            <input type="password" class="form-control" id="password" name="password">                    <span>
       
                          </span>
                        </div>
                      </div>


                      <div class="col-12">
                        <div class="position-relative">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">                         <span>
       
                          </span>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="coordinator" {{ $user->role === 'coordinator' ? 'selected' : '' }}>coordinator</option>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                            </select>                         

                        </div>
                      </div>


                      <div class="col-12">
                        <div class="position-relative">
                          <label class="form-label">Manage Roles</label>
                          <div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-create" name="create_role" value="1" {{ $user->create_role ? 'checked' : '' }}>
                              <label class="form-check-label" for="role-create">Create</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-edit" name="edit_role" value="1" {{ $user->edit_role ? 'checked' : '' }}>
                              <label class="form-check-label" for="role-edit">Edit</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="role-delete" name="delete_role" value="1" {{ $user->delete_role ? 'checked' : '' }}>
                              <label class="form-check-label" for="role-delete">Delete</label>
                            </div>
                          </div>
                        </div>
                      </div>
              
              
                      <div class="col-12">
                        <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                          <span><i class="fas fa-arrow-right border-0"></i></span>
                          <span>update</span>
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
