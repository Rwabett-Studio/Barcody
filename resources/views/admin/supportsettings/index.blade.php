@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Support setting</h4>

            @if(Auth::user()->create_role === 1)

            <a href="{{ route('supportsettings.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add Support Setting</span>
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
                        <th>whatsapp</th>
                        <th>facebook</th>
                        <th>youtube</th>
                        <th style="width:17%">actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($supportsettings as $setting)
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
                        <td>{{ $setting->name }}</td>
                        <td>{{ $setting->email }}</td>
                        <td>{{ $setting->phone }}</td>
                        <td>{{ $setting->whatsapp }}</td>
                        <td>{{ $setting->facebook }}</td>
                        <td>{{ $setting->youtube }}</td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                @if(Auth::user()->edit_role === 1)

                                <a href="{{ route('supportsettings.edit', $setting->id) }}" class="btn btn-link">
                                    <span>Edit</span>
                                </a>

                                @endif


                                @if(Auth::user()->delete_role === 1)

                                <form action="{{ route('supportsettings.destroy', $setting->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger">Delete</button>
                                </form>

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
