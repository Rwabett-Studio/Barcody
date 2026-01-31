@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">List of Companies</h4>
            <button class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add company</span>
            </button>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="table-tools">
                <div class="d-flex align-items-center">
                   
                    <button class="btn mainBtn2 light-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.0249 12.2921C18.0249 13.0337 17.8166 13.7338 17.4499 14.3338C16.7666 15.4838 15.5083 16.2504 14.0666 16.2504C12.6249 16.2504 11.3666 15.4754 10.6833 14.3338C10.3166 13.7421 10.1083 13.0337 10.1083 12.2921C10.1083 10.1087 11.8833 8.33374 14.0666 8.33374C16.2499 8.33374 18.0249 10.1087 18.0249 12.2921Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.55 12.2754H12.5917" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.0667 10.8335V13.7918" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.2416 3.35034V5.20032C17.2416 5.87532 16.8166 6.717 16.4 7.142L14.9333 8.43365C14.6583 8.36699 14.3666 8.33366 14.0666 8.33366C11.8833 8.33366 10.1083 10.1087 10.1083 12.292C10.1083 13.0337 10.3166 13.7337 10.6833 14.3337C10.9916 14.8503 11.4166 15.292 11.9333 15.6086V15.892C11.9333 16.4003 11.6 17.0753 11.175 17.3253L9.99997 18.0837C8.9083 18.7587 7.39163 18.0003 7.39163 16.6503V12.192C7.39163 11.6003 7.04997 10.842 6.71663 10.4253L3.51663 7.05863C3.09997 6.63363 2.7583 5.87534 2.7583 5.37534V3.43365C2.7583 2.42532 3.51663 1.66699 4.44163 1.66699H15.5583C16.4833 1.66699 17.2416 2.42534 17.2416 3.35034Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                
                        <span>Filter</span>                                
                    </button>
                    <button class="btn mainBtn2 light-primary mx-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.16663 13.3332L6.66663 15.8332M6.66663 15.8332L4.16663 13.3332M6.66663 15.8332V4.1665M10.8333 6.6665L13.3333 4.1665M13.3333 4.1665L15.8333 6.6665M13.3333 4.1665V15.8332" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                            
                        <span>Sort</span>                                
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
            <table id="contactTable" class=" w-100 mt-3 companyTable">
                <thead>
                    <tr>
                        <th>
                            <div class="checkboxes__row">
                                <div class="checkboxes__item">
                                    <label class="checkbox style-b">
                                        <input type="checkbox" id="checkAll"/>
                                        <div class="checkbox__checkmark"></div>
                                    </label>
                                </div>
                            </div>
                        </th>
                        <th style="width:15%">Company Name</th>
                        <th>Company Owner</th>
                        <th>phone</th>
                        <th>Industry</th>
                        <th>Country / City</th>
                        <th>status</th>
                        <th style="width:17%">actions</th>
                    </tr>
                </thead>
                <tbody>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">
                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="graySpan border">
                            <i class="fas fa-circle fa-fw"></i>  Pending
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="inActive border">
                            <i class="fas fa-times"></i>  inActive
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
                    
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
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
                            <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_branding.png" alt="">

                                <div class="ms-3">
                                    <h6>company</h6>
                                    <h5>company@info.com</h5>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" fill="white"/>
                                <rect x="0.5" y="0.5" width="35" height="35" rx="17.5" stroke="#D9E1E7"/>
                                <path d="M18.0999 18.65C18.0416 18.6416 17.9666 18.6416 17.8999 18.65C16.4333 18.6 15.2666 17.4 15.2666 15.925C15.2666 14.4167 16.4833 13.1917 17.9999 13.1917C19.5083 13.1917 20.7333 14.4167 20.7333 15.925C20.7249 17.4 19.5666 18.6 18.0999 18.65Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M23.6166 24.15C22.1333 25.5084 20.1666 26.3334 18 26.3334C15.8333 26.3334 13.8666 25.5084 12.3833 24.15C12.4666 23.3667 12.9666 22.6 13.8583 22C16.1416 20.4834 19.875 20.4834 22.1416 22C23.0333 22.6 23.5333 23.3667 23.6166 24.15Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18 26.3334C22.6024 26.3334 26.3333 22.6025 26.3333 18.0001C26.3333 13.3977 22.6024 9.66675 18 9.66675C13.3976 9.66675 9.66666 13.3977 9.66666 18.0001C9.66666 22.6025 13.3976 26.3334 18 26.3334Z" stroke="#17181A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <div class="ms-3">
                                    <h6>label</h6>
                                    <h5>@username</h5>
                                </div>
                            </div>
                        </td>
                        <td>+2 011 24244939</td>
                        <td>syntax company</td>
                        <td>
                             <div class="compImgDv d-flex align-items-center">
                                <img src="img/icon_country.png" alt="">
                                <div class="ms-3">
                                    <h6>Australia</h6>
                                    <h5>Perth</h5>
                                </div>
                            </div>
                        </td>
                        <td><span class="greenSpan border">
                            <i class="fa-solid fa-check me-2"></i>  Active
                        </span></td>
                        <td>
                            <div class="d-flex align-items-center actions">
                                <a href="">delete</a>
                                <a href="">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.99996 7.33322V4.13322C3.99996 3.38648 3.99996 3.01284 4.14528 2.72762C4.27311 2.47674 4.47694 2.27291 4.72782 2.14508C5.01304 1.99976 5.38669 1.99976 6.13342 1.99976H9.11643C9.19815 1.99976 9.26963 1.99976 9.33329 2.00034M13.3327 5.99976C13.3333 6.06349 13.3333 6.13506 13.3333 6.21688V11.8688C13.3333 12.6141 13.3333 12.9867 13.1881 13.2717C13.0603 13.5226 12.8559 13.7267 12.605 13.8546C12.3201 13.9998 11.9473 13.9998 11.202 13.9998L8.66663 13.9998M13.3327 5.99976C13.3309 5.80943 13.3238 5.68893 13.2962 5.57397C13.2635 5.43793 13.2094 5.30785 13.1363 5.18855C13.0539 5.054 12.9392 4.93901 12.7086 4.70841L10.625 2.62476C10.3945 2.3943 10.279 2.2788 10.1445 2.19637C10.0252 2.12327 9.89524 2.06926 9.75919 2.0366C9.64418 2.00899 9.52372 2.00207 9.33329 2.00034M13.3327 5.99976H13.3334M13.3327 5.99976H11.4646C10.7193 5.99976 10.3461 5.99976 10.0612 5.85457C9.81027 5.72674 9.60645 5.52237 9.47862 5.27148C9.33329 4.98627 9.33329 4.61316 9.33329 3.86642V2.00034M5.99996 9.33309L7.33329 10.6664M2.66663 13.9998V12.3331L7.66663 7.33309L9.33329 8.99976L4.33329 13.9998H2.66663Z" stroke="#99B2C6" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>edit</span></a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
                
            </table>
        </div>
    </div>
    
    </div>
    

@include('admin.layouts.footer')
