<div class="border-bottom ">
    <div class="bg-light py-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-center text-md-start"><span> Super Value Deals - Save more with
                        coupons</span>
                </div>
                <div class="col-6 text-end d-none d-md-block">
                    <a href="">
                        {{-- <a href="{{ Route('dashboard') }}"> --}}
                        {{-- <i class="fa-solid fa-exclamation"></i> --}}
                        <i class="fa-solid fa-heart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="py-4 pt-lg-3 pb-lg-0">
        <div class="container">
            <div class="row w-100 align-items-center gx-lg-2 gx-0">
                <div class="col-xxl-2 col-lg-3">
                    <a class="navbar-brand d-none d-lg-block" href="{{ route('index') }}">
                        <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="eCommerce HTML Template">

                    </a>
                    <div class="d-flex justify-content-between w-100 d-lg-none">
                        <a class="navbar-brand" href="{{ route('index') }}">
                            <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="eCommerce HTML Template">

                        </a>

                        <div class="d-flex align-items-center dropdown dropdown-fullwidth lh-1">
                            <div class="list-inline me-4">
                                @if (Auth::check())
                                <div class="list-inline-item me-3">
                                    <a href="#!" class="text-muted dropdown-toggle user_dropdown position-relative" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
                                            <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/>
                                        </svg>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            <span class="fw-bold countFav" >
                                                {{isset($news)?count($news):0}}
                                            </span>
                                        </span>
                                    </a>
                                    <div class=" dropdown-menu shadow">
                                        <div class="list-group">
                                            @if (isset($news))
                                            @foreach ($news as $new)
                                            <a href="{{route($new->link,$new->attr)}}" class="list-group-item list-group-item-action">
                                                {{$new->title}}
                                            </a>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="list-inline-item me-3">
                                    <a href="{{ route('wishlist') }}" class="text-muted position-relative">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                            </path>
                                        </svg>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                            <span class="fw-bold countFav" >
                                                {{count(Auth::user()->Favourite)}}
                                            </span>
                                        </span>
                                    </a>
                                </div>
                                @endif
                                <div class="list-inline-item dropdown dropdown-fullwidth">
                                    @if (Auth::check()) 
                                        @if (Auth::user()->avatar)
                                        <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}"  width="28" height="28" class="img-fluid rounded-circle" >
                                        @else    
                                        <img src="{{asset('images/avatar/user.png')}}" width="28" height="28"  class="img-fluid rounded-circle" >
                                        @endif
                                        <a href="#!" class="text-muted dropdown-toggle user_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{Auth::user()->name}}
                                        </a>
                                        <div class=" dropdown-menu pb-0 ">
                                            <div class="list-group">
                                                
                                                <a href="{{route('accountorder')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-truck"></i> Order</a>
                                                <a href="{{route('accountsetting')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-gear"></i> Setting</a>
                                                <a href="{{route('accountaddress')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-location-pin"></i>Address</a>
                                                <a href="{{route('accountpayment')}}" class="list-group-item list-group-item-action"><i class="fa-regular fa-credit-card"></i>Payment Method</a>
                                                <a href="{{route('signout')}}" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-in-right" ></i> Sign out</a>
                                            </div>
                                        </div>
                                    @else
                                    <a href="#!" class="text-muted" data-bs-toggle="modal"
                                        data-bs-target="#userModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                    </a>
                                    @endif
                                </div>
                                <div class="list-inline-item">

                                    <a class="text-muted position-relative btn_showcart" href="#offcanvasExample" role="button" data-bs-target="#offcanvasRight" data-bs-toggle="offcanvas" 
                                    aria-controls="offcanvasRight">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        @if (Auth::check())
                                          <span class="fw-bold countCart" >
                                            {{count(Auth::user()->Cart->where('order_code','=',null))}}
                                          </span>
                                          @endif
                                          @if (Session::has("cart"))
                                          <span class="fw-bold countCart" >{{count(Session::get('cart'))}}
                                          </span>
                                          @endif
                                        @if (!Auth::check() && !Session::has("cart"))
                                        <span class="fw-bold countCart" >0</span>
                                        @endif
                                    </span>
                                 </a>
                                </div>

                            </div>
                            <!-- Button -->
                            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                    fill="currentColor" class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                                    <path
                                        d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg>
                            </button>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-5 d-none d-lg-block">
                    <form action="{{Route('product.findByName')}}" method="GET">
                        @csrf
                        <div class="input-group ">
                            @if (isset($name))
                            <input class="form-control rounded" name="name" placeholder="Search for products" value="{{$name}}" >
                                
                            @else
                            <input class="form-control rounded" name="name" placeholder="Search for products" >
                            @endif
                            <span class="input-group-append">
                                <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65">
                                        </line>
                                    </svg>
                                </button>
                            </span>
                        </div>

                    </form>
                </div>
                <div class="col-md-4 col-xxl-3 mx-auto text-end d-none d-lg-block dropdown dropdown-fullwidth">
                    <div class="d-flex flex-row justify-content-around w-75">
                        @if (Auth::check())
                            <div class=" me-3">
                                <a href="#!" class="text-muted dropdown-toggle user_dropdown position-relative" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="currentColor">
                                        <path d="M224 0c-17.7 0-32 14.3-32 32V49.9C119.5 61.4 64 124.2 64 200v33.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V200c0-75.8-55.5-138.6-128-150.1V32c0-17.7-14.3-32-32-32zm0 96h8c57.4 0 104 46.6 104 104v33.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V200c0-57.4 46.6-104 104-104h8zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z"/>
                                    </svg>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        <span class="fw-bold countFav" >
                                            {{isset($news)?count($news):0}}
                                        </span>
                                    </span>
                                </a>
                                <div class=" dropdown-menu shadow">
                                    <div class="list-group">
                                        @if (isset($news))
                                            @foreach ($news as $new)
                                            <a href="{{route($new->link,$new->attr)}}" class="list-group-item list-group-item-action">
                                                {{$new->title}}
                                            </a>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="me-3">
                                <a href="{{ route('wishlist') }}" class="text-muted position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                        <path
                                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                        </path>
                                    </svg>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        <span class="fw-bold countFav" >
                                            {{count(Auth::user()->Favourite)}}
                                        </span>
                                    </span>
                                </a>
                            </div>
                            
                            <div class="list-inline-item ">
                                @if (Auth::user()->avatar)
                                <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}"  width="28" height="28" class="img-fluid rounded-circle" >
                                @else    
                                <img src="{{asset('images/avatar/user.png')}}" width="28" height="28"  class="img-fluid rounded-circle" >
                                @endif
                                <a href="#!" class="text-muted dropdown-toggle user_dropdown ms-4" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                                    {{Auth::user()->name}}
                                </a>
                                <div class=" dropdown-menu pb-0 ">
                                    <div class="list-group">
                                        <a href="{{route('dashboard')}}" class="list-group-item list-group-item-action"> Dashboard</a>
                                        <a href="{{route('accountorder')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-truck"></i> Order</a>
                                        <a href="{{route('accountsetting')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-gear"></i> Setting</a>
                                        <a href="{{route('accountaddress')}}" class="list-group-item list-group-item-action"><i class="fa-solid fa-location-pin"></i>Address</a>
                                        <a href="{{route('accountpayment')}}" class="list-group-item list-group-item-action"><i class="fa-regular fa-credit-card"></i>Payment Method</a>
                                        <a href="{{route('signout')}}" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-in-right" ></i> Sign out</a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div>
                                <a href="#!" class="text-muted" data-bs-toggle="modal"
                                    data-bs-target="#userModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                            </div>  
                        @endif
                        <div >
                            <a class="text-muted position-relative btn_showcart" href="#offcanvasExample" role="button" data-bs-target="#offcanvasRight" data-bs-toggle="offcanvas" 
                                aria-controls="offcanvasRight">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-shopping-bag">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                    @if (Auth::check())
                                    <span class="fw-bold countCart" >
                                        {{count(Auth::user()->Cart->where('order_code','=',null))}}
                                    </span>
                                    @endif
                                    @if (Session::has("cart"))
                                      <span class="fw-bold countCart" >{{count(Session::get('cart'))}}
                                      </span>
                                    @endif
                                    @if (!Auth::check() && !Session::has("cart"))
                                    <span class="fw-bold countCart" >0</span>
                                    @endif
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 py-lg-4">
        <div class="container px-0 px-md-3">
            <div class="dropdown me-3 d-none d-lg-block">
                <button class="btn btn-primary px-6 " type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="me-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></span> Welcome to website
                </button>
            </div>
            <div class="offcanvas offcanvas-start p-4 p-lg-0" id="navbar-default">
                <div class="d-flex justify-content-between align-items-center mb-2 d-block d-lg-none">
                    <a href="{{ route('index') }}"><img src="{{ asset('images/logo/freshcart-logo.svg') }}"
                            alt="eCommerce HTML Template"></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="d-none d-lg-block">
                    <ul class="navbar-nav align-items-center ">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ Route('index') }}">
                                Home <i class="fa-solid fa-circle-chevron-down fa-xs"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ Route('user.pages.Products.index')}}">
                                Categories <i class="fa-solid fa-circle-chevron-down fa-xs"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Account <i class="fa-solid fa-circle-chevron-down fa-xs"></i>
                            </a>
                            <ul class="dropdown-menu">
                                {{-- <li><a class="dropdown-item" href="{{ route('accountorder') }}">Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('setting') }}">Settings</a></li>
                                <li><a class="dropdown-item" href="{{ route('address') }}">Address</a></li>
                                <li><a class="dropdown-item" href="{{ route('payment') }}">Payment Method</a>
                                </li> --}}
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign In</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('signin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="modal_email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="modal_email" placeholder="Enter Email address" required="">
                    </div>
                    <div class="mb-5">
                        <label for="modal_password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="modal_password" placeholder="Enter Password" required="">
                    </div>
                    <div> Forgot password? <a href="../pages/forgot-password.html">Reset It</a></div>
                    <button type="submit" class="btn btn-primary" id="modal_signin" disabled>Sign In</button>
                </form>
            </div>
            <div class="modal-footer border-0 justify-content-center">Don’t have an account? <a href="{{route('signup')}}"> Sign Up</a>
            </div>
        </div>
    </div>
</div>



<!-- Shop Cart -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <div class="text-start">
            <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Shop Cart</h5>
            <small>Location in 382480</small>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <div class="">
            <!-- alert -->
            <div class="alert alert-danger p-2" role="alert">
                You’ve got FREE delivery. Start <a href="#!" class="alert-link">checkout now!</a>
            </div>
            <ul class="list-group list-group-flush" id="listCart">
            </ul>
            <!-- btn -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{route('order')}}" class="btn btn-primary">Continue Shopping</a>
                <a href="#!" class="btn btn-dark">Update Cart</a>
            </div>

        </div>
    </div>
</div>

{{-- <!-- Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body p-6">
                <div class="d-flex justify-content-between align-items-start ">
                    <div>
                        <h5 class="mb-1" id="locationModalLabel">Choose your Delivery Location</h5>
                        <p class="mb-0 small">Enter your address and we will specify the offer you area. </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="my-5">
                    <input type="search" class="form-control" placeholder="Search your area">
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0">Select Location</h6>
                    <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>


                </div>
                <div>
                    <div data-simplebar style="height:300px;">
                        <div class="list-group list-group-flush">

                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">
                                <span>Alabama</span><span>Min:$20</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Alaska</span><span>Min:$30</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Arizona</span><span>Min:$50</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>California</span><span>Min:$29</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Colorado</span><span>Min:$80</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Florida</span><span>Min:$90</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Arizona</span><span>Min:$50</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>California</span><span>Min:$29</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Colorado</span><span>Min:$80</span></a>
                            <a href="#"
                                class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                                <span>Florida</span><span>Min:$90</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> --}}
