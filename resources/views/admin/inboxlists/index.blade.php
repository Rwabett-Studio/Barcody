@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Inboxlist</h4>

            @if(Auth::user()->create_role === 1)

            <a href="{{ route('inboxlists.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add Inboxlist</span>
            </a>

            @endif

        </div>
        <div class="col-12 position-relative pt-1">
            <div class="table-tools">
            </div>
            <table id="contactTable" class=" w-100 mt-3">
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
                        <th style="width:15%">Name</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>message</th>
                        <th style="width:17%">actions</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach($inboxlists as $inboxlist)
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
                        <td>{{ $inboxlist->name }}</td>
                        <td>{{ $inboxlist->email }}</td>
                        <td>{{ $inboxlist->phone }}</td>
                        <td>{{ $inboxlist->message }}</td>
                        <td>
                            <div class="d-flex align-items-center actions">

                                @if(Auth::user()->delete_role === 1)

                                <form action="{{ route('inboxlists.destroy', $inboxlist->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger">Delete</button>
                                </form>
                                @endif

                                @if(Auth::user()->edit_role === 1)

                                <a href="{{ route('inboxlists.edit', $inboxlist->id) }}" class="btn btn-link">
                                    <span>Edit</span>
                                </a>
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
