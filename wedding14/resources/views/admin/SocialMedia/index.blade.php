@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">SocialMedia</h4>
            {{-- <a href="{{ route('SocialMedia.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add SocialMedia</span>
            </a> --}}
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="table-tools">
                <div class="d-flex align-items-center">
                    <button class="btn mainBtn2 light-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 6.66667V13.3333M6.66667 10H13.3333M6.5 17.5H13.5C14.9001 17.5 15.6002 17.5 16.135 17.2275C16.6054 16.9878 16.9878 16.6054 17.2275 16.135C17.5 15.6002 17.5 14.9001 17.5 13.5V6.5C17.5 5.09987 17.5 4.3998 17.2275 3.86502C16.9878 3.39462 16.6054 3.01217 16.135 2.77248C15.6002 2.5 14.9001 2.5 13.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5Z" stroke="#809FB8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        <span>Assign</span>                                
                    </button>
                    <button class="btn mainBtn2 light-primary mx-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.0249 12.2921C18.0249 13.0337 17.8166 13.7338 17.4499 14.3338C16.7666 15.4838 15.5083 16.2504 14.0666 16.2504C12.6249 16.2504 11.3666 15.4754 10.6833 14.3338C10.3166 13.7421 10.1083 13.0337 10.1083 12.2921C10.1083 10.1087 11.8833 8.33374 14.0666 8.33374C16.2499 8.33374 18.0249 10.1087 18.0249 12.2921Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.55 12.2754H12.5917" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.0667 10.8335V13.7918" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.2416 3.35034V5.20032C17.2416 5.87532 16.8166 6.717 16.4 7.142L14.9333 8.43365C14.6583 8.36699 14.3666 8.33366 14.0666 8.33366C11.8833 8.33366 10.1083 10.1087 10.1083 12.292C10.1083 13.0337 10.3166 13.7337 10.6833 14.3337C10.9916 14.8503 11.4166 15.292 11.9333 15.6086V15.892C11.9333 16.4003 11.6 17.0753 11.175 17.3253L9.99997 18.0837C8.9083 18.7587 7.39163 18.0003 7.39163 16.6503V12.192C7.39163 11.6003 7.04997 10.842 6.71663 10.4253L3.51663 7.05863C3.09997 6.63363 2.7583 5.87534 2.7583 5.37534V3.43365C2.7583 2.42532 3.51663 1.66699 4.44163 1.66699H15.5583C16.4833 1.66699 17.2416 2.42534 17.2416 3.35034Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                
                        <span>Filter</span>                                
                    </button>
                    <button class="btn mainBtn2 light-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.7 7.4165C16.7 7.67484 17.925 9.2165 17.925 12.5915V12.6998C17.925 16.4248 16.4333 17.9165 12.7083 17.9165H7.28332C3.55832 17.9165 2.06665 16.4248 2.06665 12.6998V12.5915C2.06665 9.2415 3.27498 7.69984 6.22498 7.42484" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 1.6665V12.3998" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.7917 10.5417L10 13.3334L7.20837 10.5417" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            
                            
                        <span>Export</span>                                
                    </button>
                </div>
            </div>
            <div class="col-12 position-relative pt-1">
                <table id="contactTable" class="w-100 mt-3">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>WhatsApp</th>
                            <th>Facebook</th>
                            <th>YouTube</th>
                            <th>Twitter</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socialMedias as $socialMedia)
                        <tr>
                            <td>{{ $socialMedia->email }}</td>
                            <td>{{ $socialMedia->phone }}</td>
                            <td>{{ $socialMedia->whatsapp }}</td>
                            <td>{{ $socialMedia->facebook }}</td>
                            <td>{{ $socialMedia->youtube }}</td>
                            <td>{{ $socialMedia->twitter }}</td>
                            <td>

                                @if(Auth::user()->edit_role === 1)

                                <a href="{{ route('SocialMedia.edit', $socialMedia->id) }}" class="btn btn-sm btn-primary">Edit</a>
                             
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    
    </div>
    
@include('admin.layouts.footer')
