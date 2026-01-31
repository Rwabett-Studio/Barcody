@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Create Plan</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('plans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="item1">Item 1</label>
                                    <input type="text" name="item1" id="item1" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="item2">Item 2</label>
                                    <input type="text" name="item2" id="item2" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="item3">Item 3</label>
                                    <input type="text" name="item3" id="item3" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="item4">Item 4</label>
                                    <input type="text" name="item4" id="item4" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="item5">Item 5</label>
                                    <input type="text" name="item5" id="item5" class="form-control">
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