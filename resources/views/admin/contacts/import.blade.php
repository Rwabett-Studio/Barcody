@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Import Contact</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="file">Upload File</label>
                                    <input type="file" name="file" class="form-control" required>
                                </div>                 
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="event_id">Event</label>
                                    <select name="event_id" class="form-control" required>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                                </div>                 
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                                    <span><i class="fas fa-arrow-right border-0"></i></span>
                                    <span>Import</span>
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