<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.2.1/r-3.0.3/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}?v=20260602j">
    <!--<link rel="stylesheet" href="admin/css/style_ar.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .greenSpan {
          color: green;
          background-color: #e6f4ea; /* Light green background */
          padding: 5px 10px;
          border-radius: 5px;
      }

      .redSpan {
          color: red;
          background-color: #ffe6e6; /* Light red background */
          padding: 5px 10px;
          border-radius: 5px;
      }
    </style>
</head>
<body>
    
    <div id="mySidebar" class="sidebar col-lg-2">
      <div class="myLogo d-flex align-items-center">
          <img src="img/logo.png" alt="">
          <a href="javascript:void(0)" class="closebtn myBtn1" onclick="closeNav()">
              <i class="fa-solid fa-angle-left"></i>
          </a>
      </div>
      <div class="menuItms">
          <ul class="list-unstyled ps-0">
              <li class="mb-1">
                 <a href="{{ url('/')}}">
                  <button class="btn d-inline-flex align-items-center">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.02001 2.84016L3.63001 7.04016C2.73001 7.74016 2.00001 9.23016 2.00001 10.3602V17.7702C2.00001 20.0902 3.89001 21.9902 6.21001 21.9902H17.79C20.11 21.9902 22 20.0902 22 17.7802V10.5002C22 9.29016 21.19 7.74016 20.2 7.05016L14.02 2.72016C12.62 1.74016 10.37 1.79016 9.02001 2.84016Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 15.9999C13.6569 15.9999 15 14.6567 15 12.9999C15 11.343 13.6569 9.99988 12 9.99988C10.3431 9.99988 9 11.343 9 12.9999C9 14.6567 10.3431 15.9999 12 15.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        
                        <span>Dashboard</span>
                  </button>
                 </a>
              </li>
              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M18 15.8369C19.4559 16.5683 20.7041 17.742 21.6152 19.2096C21.7957 19.5003 21.8859 19.6456 21.9171 19.8468C21.9805 20.2558 21.7008 20.7585 21.3199 20.9204C21.1325 21 20.9217 21 20.5 21M16 11.5322C17.4817 10.7959 18.5 9.26686 18.5 7.5C18.5 5.73314 17.4817 4.20411 16 3.46776M14 7.5C14 9.98528 11.9853 12 9.5 12C7.01472 12 5 9.98528 5 7.5C5 5.01472 7.01472 3 9.5 3C11.9853 3 14 5.01472 14 7.5ZM2.55923 18.9383C4.15354 16.5446 6.66937 15 9.5 15C12.3306 15 14.8465 16.5446 16.4408 18.9383C16.79 19.4628 16.9647 19.725 16.9446 20.0599C16.9289 20.3207 16.758 20.64 16.5496 20.7976C16.2819 21 15.9138 21 15.1776 21H3.82236C3.08617 21 2.71808 21 2.45044 20.7976C2.24205 20.64 2.07109 20.3207 2.05543 20.0599C2.03533 19.725 2.20996 19.4628 2.55923 18.9383Z" stroke="#809FB8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Events</span>
                </button>
                <div class="collapse" id="home-collapse" >
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{url('categories')}}" class="link-dark d-inline-flex text-decoration-none rounded">Categories</a></li>
                    <li><a href="{{url('events')}}" class="link-dark d-inline-flex text-decoration-none rounded">Events</a></li>
                    <!--<li><a href="{{url('contacts')}}" class="link-dark d-inline-flex text-decoration-none rounded">-->
                    <!--      Contact List-->
                    <!-- </a></li>-->

                  </ul>
                </div>
              </li>
              
             <li class="mb-1">
                  <a  href="{{url('contacts')}}" class="btn d-inline-flex align-items-center">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.5098 19.802C8.83129 20.5641 10.3646 21.0002 11.9997 21.0002C16.9702 21.0002 21 16.9708 21 12.0002C21 7.02968 16.9706 3.00024 12 3.00024C7.02947 3.00024 3.00003 7.02968 3.00003 12.0002C3.00003 13.6354 3.43608 15.1686 4.19822 16.4901L4.20118 16.4952C4.27451 16.6224 4.31149 16.6865 4.32824 16.7471C4.34404 16.8043 4.34845 16.8556 4.34441 16.9148C4.34006 16.9784 4.31863 17.0443 4.27471 17.176L3.50589 19.4825L3.50492 19.4855C3.34271 19.9722 3.2616 20.2155 3.31942 20.3776C3.36983 20.519 3.48172 20.6305 3.62308 20.681C3.78485 20.7386 4.02708 20.6579 4.51158 20.4964L4.51761 20.4942L6.82408 19.7253C6.95541 19.6816 7.02217 19.6594 7.08562 19.655C7.14478 19.651 7.19581 19.6563 7.25296 19.6721C7.31372 19.6889 7.37787 19.7259 7.50567 19.7996L7.5098 19.802Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>                            
                      <span>All Contact</span>
                  </a>
              </li>

              {{-- <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.00999 11.2203V15.7103C3.00999 20.2003 4.80999 22.0003 9.29999 22.0003H14.69C19.18 22.0003 20.98 20.2003 20.98 15.7103V11.2203" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12 11.9999C13.83 11.9999 15.18 10.5099 15 8.67988L14.34 1.99988H9.66998L8.99998 8.67988C8.81998 10.5099 10.17 11.9999 12 11.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.31 11.9999C20.33 11.9999 21.81 10.3599 21.61 8.34988L21.33 5.59988C20.97 2.99988 19.97 1.99988 17.35 1.99988H14.3L15 9.00988C15.17 10.6599 16.66 11.9999 18.31 11.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M5.64001 11.9999C7.29001 11.9999 8.78001 10.6599 8.94001 9.00988L9.16001 6.79988L9.64001 1.99988H6.59001C3.97001 1.99988 2.97001 2.99988 2.61001 5.59988L2.34001 8.34988C2.14001 10.3599 3.62001 11.9999 5.64001 11.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M12 16.9999C10.33 16.9999 9.49997 17.8299 9.49997 19.4999V21.9999H14.5V19.4999C14.5 17.8299 13.67 16.9999 12 16.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Companies</span> <span class="countSpan">11</span>
                </button>
                <div class="collapse" id="dashboard-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="companies.html" class="link-dark d-inline-flex text-decoration-none rounded">Overview</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Weekly</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Monthly</a></li>
                    <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Annually</a></li>
                  </ul>
                </div>
              </li> --}}

              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.00002 16.9998H15M9.00002 13.9998H15M13.0004 3.00063C12.9049 2.99976 12.7974 2.99976 12.6747 2.99976H8.20021C7.08011 2.99976 6.51964 2.99976 6.09182 3.21774C5.71549 3.40949 5.40975 3.71523 5.21801 4.09155C5.00002 4.51938 5.00002 5.07985 5.00002 6.19995V17.7999C5.00002 18.9201 5.00002 19.4798 5.21801 19.9076C5.40975 20.284 5.71549 20.5902 6.09182 20.782C6.51922 20.9998 7.07902 20.9998 8.19696 20.9998L15.8031 20.9998C16.921 20.9998 17.48 20.9998 17.9074 20.782C18.2837 20.5902 18.5905 20.284 18.7822 19.9076C19 19.4802 19 18.9212 19 17.8033V9.32544C19 9.20278 18.9999 9.09529 18.999 8.99976M13.0004 3.00063C13.2859 3.00323 13.4657 3.01382 13.6382 3.05523C13.8423 3.10422 14.0379 3.18502 14.2168 3.29468C14.4186 3.41832 14.5918 3.59157 14.9375 3.93726L18.063 7.06274C18.4089 7.40864 18.5809 7.58112 18.7046 7.78295C18.8142 7.96189 18.8954 8.15701 18.9444 8.36108C18.9858 8.53354 18.9964 8.7143 18.999 8.99976M13.0004 3.00063L13 5.79996C13 6.92007 13 7.47991 13.218 7.90773C13.4098 8.28405 13.7155 8.59024 14.0918 8.78198C14.5192 8.99976 15.079 8.99976 16.1969 8.99976H18.999" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Setting</span>
                </button>
                <div class="collapse" id="orders-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ url('settings')}}" class="link-dark d-inline-flex text-decoration-none rounded">Setting</a></li>
                    <li><a href="{{ url('SocialMedia')}}" class="link-dark d-inline-flex text-decoration-none rounded">Social-Media</a></li>
                    {{-- <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Shipped</a></li> --}}
                    {{-- <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Returned</a></li> --}}
                  </ul>
                </div>
              </li>





              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21.2104 15.8899C20.5742 17.3944 19.5792 18.7202 18.3123 19.7512C17.0454 20.7823 15.5452 21.4874 13.9428 21.8047C12.3405 22.1221 10.6848 22.0421 9.12055 21.5717C7.55627 21.1014 6.13103 20.255 4.96942 19.1066C3.80782 17.9582 2.94522 16.5427 2.45704 14.9839C1.96886 13.4251 1.86996 11.7704 2.169 10.1646C2.46804 8.55873 3.1559 7.05058 4.17245 5.77198C5.189 4.49338 6.50329 3.48327 8.0004 2.82995M21.2392 8.17311C21.6395 9.13958 21.8851 10.1613 21.9684 11.2008C21.989 11.4576 21.9993 11.586 21.9483 11.7017C21.9057 11.7983 21.8213 11.8897 21.7284 11.9399C21.6172 11.9999 21.4783 11.9999 21.2004 11.9999H12.8004C12.5204 11.9999 12.3804 11.9999 12.2734 11.9455C12.1793 11.8975 12.1028 11.821 12.0549 11.7269C12.0004 11.62 12.0004 11.48 12.0004 11.1999V2.79995C12.0004 2.52208 12.0004 2.38315 12.0605 2.27193C12.1107 2.17903 12.2021 2.09464 12.2987 2.05204C12.4144 2.00105 12.5428 2.01134 12.7996 2.03193C13.839 2.11527 14.8608 2.36083 15.8272 2.76115C17.0405 3.2637 18.1429 4.00029 19.0715 4.92888C20.0001 5.85747 20.7367 6.95986 21.2392 8.17311Z" stroke="#809FB8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Support</span>
                </button>
                <div class="collapse" id="account-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="{{ url('inboxlists')}}" class="link-dark d-inline-flex text-decoration-none rounded">inboxlist</a></li>
                    <li><a href="{{ url('supportsettings')}}" class="link-dark d-inline-flex text-decoration-none rounded">Settings</a></li>
                  </ul>
                </div>
              </li>

              <li class="mb-1">
                  <a  href="{{url('users')}}" class="btn d-inline-flex align-items-center">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M7.5098 19.802C8.83129 20.5641 10.3646 21.0002 11.9997 21.0002C16.9702 21.0002 21 16.9708 21 12.0002C21 7.02968 16.9706 3.00024 12 3.00024C7.02947 3.00024 3.00003 7.02968 3.00003 12.0002C3.00003 13.6354 3.43608 15.1686 4.19822 16.4901L4.20118 16.4952C4.27451 16.6224 4.31149 16.6865 4.32824 16.7471C4.34404 16.8043 4.34845 16.8556 4.34441 16.9148C4.34006 16.9784 4.31863 17.0443 4.27471 17.176L3.50589 19.4825L3.50492 19.4855C3.34271 19.9722 3.2616 20.2155 3.31942 20.3776C3.36983 20.519 3.48172 20.6305 3.62308 20.681C3.78485 20.7386 4.02708 20.6579 4.51158 20.4964L4.51761 20.4942L6.82408 19.7253C6.95541 19.6816 7.02217 19.6594 7.08562 19.655C7.14478 19.651 7.19581 19.6563 7.25296 19.6721C7.31372 19.6889 7.37787 19.7259 7.50567 19.7996L7.5098 19.802Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>                            
                      <span>users</span>
                  </a>
              </li>
              
                            <li class="mb-1">
                  <a href="{{ url('coupons') }}" class="btn d-inline-flex align-items-center">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M9 14.5L14.5 9M10 9.5C10 9.77614 9.77614 10 9.5 10C9.22386 10 9 9.77614 9 9.5C9 9.22386 9.22386 9 9.5 9C9.77614 9 10 9.22386 10 9.5ZM15 14.5C15 14.7761 14.7761 15 14.5 15C14.2239 15 14 14.7761 14 14.5C14 14.2239 14.2239 14 14.5 14C14.7761 14 15 14.2239 15 14.5ZM3 9C3 7.34315 4.34315 6 6 6H18C19.6569 6 21 7.34315 21 9V15C21 16.6569 19.6569 18 18 18H6C4.34315 18 3 16.6569 3 15V9Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Coupons</span>
                  </a>
              </li>

              <li class="mb-1">
                  <a href="{{ url('subscriptions') }}" class="btn d-inline-flex align-items-center">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3 10H21M7 15H8M12 15H13M6 19H18C19.6569 19 21 17.6569 21 16V8C21 6.34315 19.6569 5 18 5H6C4.34315 5 3 6.34315 3 8V16C3 17.6569 4.34315 19 6 19Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Subscriptions</span>
                  </a>
              </li>

              <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#Landingpage-collapse" aria-expanded="false">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M21.2104 15.8899C20.5742 17.3944 19.5792 18.7202 18.3123 19.7512C17.0454 20.7823 15.5452 21.4874 13.9428 21.8047C12.3405 22.1221 10.6848 22.0421 9.12055 21.5717C7.55627 21.1014 6.13103 20.255 4.96942 19.1066C3.80782 17.9582 2.94522 16.5427 2.45704 14.9839C1.96886 13.4251 1.86996 11.7704 2.169 10.1646C2.46804 8.55873 3.1559 7.05058 4.17245 5.77198C5.189 4.49338 6.50329 3.48327 8.0004 2.82995M21.2392 8.17311C21.6395 9.13958 21.8851 10.1613 21.9684 11.2008C21.989 11.4576 21.9993 11.586 21.9483 11.7017C21.9057 11.7983 21.8213 11.8897 21.7284 11.9399C21.6172 11.9999 21.4783 11.9999 21.2004 11.9999H12.8004C12.5204 11.9999 12.3804 11.9999 12.2734 11.9455C12.1793 11.8975 12.1028 11.821 12.0549 11.7269C12.0004 11.62 12.0004 11.48 12.0004 11.1999V2.79995C12.0004 2.52208 12.0004 2.38315 12.0605 2.27193C12.1107 2.17903 12.2021 2.09464 12.2987 2.05204C12.4144 2.00105 12.5428 2.01134 12.7996 2.03193C13.839 2.11527 14.8608 2.36083 15.8272 2.76115C17.0405 3.2637 18.1429 4.00029 19.0715 4.92888C20.0001 5.85747 20.7367 6.95986 21.2392 8.17311Z" stroke="#809FB8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                      <span>Landing page</span>
                </button>
                <div class="collapse" id="Landingpage-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="{{ route('hero-sections.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Hero Section</a></li>
                        <li><a href="{{ route('how-use-barcodies.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">How To use</a></li>
                        <li><a href="{{ route('invitation-categories.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Invitation Categories</a></li>
                        <li><a href="{{ route('plans.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Plans</a></li>
                        <li><a href="{{ route('faqs.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Faqs</a></li>
                        <li><a href="{{ route('information-sections.index') }}" class="link-dark d-inline-flex text-decoration-none rounded">Information Section</a></li>
                    </ul>
                </div>
              </li>


 
{{-- 
              <li class="mb-1">
                  <button class="btn d-inline-flex align-items-center">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M8.99998 21.9999H15C20 21.9999 22 19.9999 22 14.9999V8.99988C22 3.99988 20 1.99988 15 1.99988H8.99998C3.99998 1.99988 1.99998 3.99988 1.99998 8.99988V14.9999C1.99998 19.9999 3.99998 21.9999 8.99998 21.9999Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M1.99998 13.0002H5.75998C6.51998 13.0002 7.20998 13.4302 7.54998 14.1102L8.43998 15.9002C8.99998 17.0002 9.99998 17.0002 10.24 17.0002H13.77C14.53 17.0002 15.22 16.5702 15.56 15.8902L16.45 14.1002C16.79 13.4202 17.48 12.9902 18.24 12.9902H21.98" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M10.34 7H13.67" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M9.49994 9.99988H14.4999" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          </svg>
                          <span>Statement</span>
                    </button>
              </li> --}}
              
            </ul>
      </div>
      
    </div>
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
    <!-- header  -->
    <div class="offset-lg-2 header d-flex align-items-center justify-content-between">
        <button class="myBtn1" id="openbtn" onclick="openNav()"><i class="fa-solid fa-angle-right"></i></button> 
        <div class="TopSerchDv">
          <form action="">
            <div>
              <i class="fas fa-search"></i>
              <input type="text"placeholder="search something">
              <button type="submit"><svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="0.5" width="26" height="26" rx="6" fill="#F9FBFC"/>
                <path d="M11.25 15.25V17C11.25 17.9665 10.4665 18.75 9.5 18.75C8.5335 18.75 7.75 17.9665 7.75 17C7.75 16.0335 8.5335 15.25 9.5 15.25H11.25ZM11.25 15.25H14.75M11.25 15.25V11.75M14.75 15.25V17C14.75 17.9665 15.5335 18.75 16.5 18.75C17.4665 18.75 18.25 17.9665 18.25 17C18.25 16.0335 17.4665 15.25 16.5 15.25H14.75ZM14.75 15.25V11.75M14.75 11.75H11.25M14.75 11.75V10C14.75 9.0335 15.5335 8.25 16.5 8.25C17.4665 8.25 18.25 9.0335 18.25 10C18.25 10.9665 17.4665 11.75 16.5 11.75H14.75ZM11.25 11.75V10C11.25 9.0335 10.4665 8.25 9.5 8.25C8.5335 8.25 7.75 9.0335 7.75 10C7.75 10.9665 8.5335 11.75 9.5 11.75H11.25Z" stroke="#17181A" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                </button>
            </div>
          </form>
        </div>
        <div class="header-tools d-flex align-items-center">
          {{-- <button class="mainBtn d-flex align-items-center me-3">
            <i class="fas fa-plus"></i> <span>add new</span>
          </button> --}}
          <!-- notifications -->
          {{-- <div class="dropdown notification w-fit mx-1">
            <button class="p-0 d-flex btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="far fa-bell"></i> <span></span>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div> --}}
          <!-- profile  -->
          <form action="{{ route('logout') }}" method="POST" class="logoutTopbarForm">
            @csrf
            <button type="submit" class="btn logoutTopbarCard d-flex align-items-center gap-2">
              <div class="position-relative me-1">
                <img src="admin/img/user.png" alt=""><span></span>
              </div>
              <span class="logoutTopbarText">Logout</span>
              <i class="fa-solid fa-right-from-bracket logoutTopbarIcon ms-auto"></i>
            </button>
          </form>
        </div>
    </div>
