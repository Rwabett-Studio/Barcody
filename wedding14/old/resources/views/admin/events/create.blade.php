@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Add New Event</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="thumbnail_image">Thumbnail Image</label>
                                    <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control">
                                    @error('thumbnail_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Date -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Time -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="time">Time</label>
                                    <input type="time" name="time" id="time" class="form-control" required>
                                    @error('time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Location -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" id="location" class="form-control" required>
                                    @error('location')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Maps -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="maps">Maps</label>
                                    <textarea name="maps" id="maps" class="form-control" required></textarea>
                                    @error('maps')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Category -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Status -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="draft">Draft</option>
                                        <option value="published">Published</option>
                                    </select>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>                 
                            </div>

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