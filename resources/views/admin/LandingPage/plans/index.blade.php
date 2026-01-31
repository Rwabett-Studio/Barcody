@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Plans</h4>
            <a href="{{ route('plans.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add Plan</span>
            </a>
        </div>
        <div class="col-12 position-relative pt-1">
            <table id="plansTable" class="w-100 mt-3">
                <thead>
                    <tr>
                        <th>
                            <div class="checkboxes__row">
                                <div class="checkboxes__item">
                                    <label class="checkbox style-b">
                                        <input type="checkbox"/>
                                        <div class="checkbox__checkmark"></div>
                                    </label>
                                </div>
                            </div>
                        </th>
                        <th>Title</th>
                        <th>Price</th>
                        <th style="width:17%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                    <tr>
                        
                    <td>
                            <div class="checkboxes__row">
                                <div class="checkboxes__item">
                                    <label class="checkbox style-b">
                                        <input type="checkbox"/>
                                        <div class="checkbox__checkmark"></div>
                                    </label>
                                </div>
                            </div>
                        </td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <h6>{{ $plan->title }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>{{ $plan->price }}</td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                @if(Auth::user()->edit_role === 1)
                                <a href="{{ route('plans.edit', $plan->id) }}">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.layouts.footer')