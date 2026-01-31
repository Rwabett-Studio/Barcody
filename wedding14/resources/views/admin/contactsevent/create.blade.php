@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Add New Contact</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('event.contacts.store', $event->id) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <!-- Gender -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="mr">MR</option>
                                        <option value="mrs">MRS</option>
                                    </select>
                                </div>                 
                            </div>

                            <!-- Phone -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>                 
                            </div>

                            <!-- Hidden Event ID -->
                            <input type="hidden" name="event_id" value="{{ $event->id }}">

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
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