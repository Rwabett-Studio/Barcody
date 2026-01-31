@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Information Section</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
            <form action="{{ route('information-sections.update', $information->id) }}" method="POST" enctype="multipart/form-data">



                      <form action="{{ route('information-sections.update', ['information_section' => $information->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

                        <div class="row">
                            <input type="hidden" name="id" value="{{ $information->id }}">

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $information->name }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ $information->title }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" required>{{ $information->description }}</textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control">
                                    @if ($information->logo)
                                        <img src="https://linkatt.com/staging/WeddingAppDashboard/storage/app/public/{{ $information->logo }}" alt="Logo" style="max-width: 50px;">
                                    @endif
                                </div>
                            </div>

                            <!-- Repeat for other fields with their current values -->

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" name="main_image" id="main_image" class="form-control">
                                    @if ($information->main_image)
                                        <img src="https://linkatt.com/staging/WeddingAppDashboard/storage/app/public/{{ $information->main_image }}" alt="Main Image" style="max-width: 50px;">
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                                    <span><i class="fas fa-arrow-right border-0"></i></span>
                                    <span>Update</span>
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