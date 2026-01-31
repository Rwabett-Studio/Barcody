@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Create Information Section</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('information-sections.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" required></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="icon1">Icon 1</label>
                                    <input type="file" name="icon1" id="icon1" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title1">Title 1</label>
                                    <input type="text" name="title1" id="title1" class="form-control">
                                </div>
                            </div>
                            
                             <div class="col-12">
                                <div class="position-relative">
                                    <label for="icon2">Icon 2</label>
                                    <input type="file" name="icon2" id="icon2" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title2">Title 2</label>
                                    <input type="text" name="title2" id="title2" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="icon3">Icon 3</label>
                                    <input type="file" name="icon3" id="icon3" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title3">Title 3</label>
                                    <input type="text" name="title3" id="title3" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="icon4">Icon 4</label>
                                    <input type="file" name="icon4" id="icon4" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title4">Title 4</label>
                                    <input type="text" name="title4" id="title4" class="form-control">
                                </div>
                            </div>

                            <!-- Repeat for icon2, title2, icon3, title3, icon4, title4 -->

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="image_app1">App Image 1</label>
                                    <input type="file" name="image_app1" id="image_app1" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="image_app2">App Image 2</label>
                                    <input type="file" name="image_app2" id="image_app2" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" name="main_image" id="main_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                                    <span><i class="fas fa-arrow-right border-0"></i></span>
                                    <span>Create</span>
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