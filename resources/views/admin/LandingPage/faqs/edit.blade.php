@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit FAQ</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $faq->id }}">

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="question">Question</label>
                                    <input type="text" name="question" id="question" class="form-control" value="{{ $faq->question }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="answer">Answer</label>
                                    <textarea name="answer" id="answer" class="form-control" required>{{ $faq->answer }}</textarea>
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