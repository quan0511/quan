@extends('user.partials.master')
@section('content')
    <main>
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card py-1 border-0 mb-8">
                            <div>
                                <h1 class="fw-bold">Shop Cart</h1>
                                {{-- <p class="mb-0">Shopping in 382480</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        @if ($errors->has('cart_quant'))
                            <div class="alert alert-danger">{{$errors->first('cart_quant')}}</div>
                        @endif
                        <div class="py-3">
                            <div class="alert alert-danger p-2" role="alert">
                                You’ve got FREE delivery. Start <a href="#!" class="alert-link">checkout now!</a>
                            </div>
                            <ul class="list-group list-group-flush">
                                @php
                                    $sum =0;
                                @endphp
                                @if (isset($carts) && count($carts)>0)
                                    @if (Auth::check())
                                        @foreach ($carts as $cart)
                                            <li class="list-group-item py-3 py-lg-0 px-0 border-top">
                                                <div class="row align-items-center">
                                                    <div class="col-3 col-md-2">
                                                        <img src="{{ asset('images/products/'.$cart->Product->Library[0]->image) }}" alt="Ecommerce" class="img-fluid">
                                                    </div>
                                                    <div class="col-3 col-md-3">
                                                        <a href="shop-single.html" class="text-inherit">
                                                            <h6 class="mb-0">{{$cart->Product->name}}</h6>
                                                        </a>
                                                        <span><small class="text-muted">unit: gram</small></span>
                                                        <div class="mt-2 small lh-1"> 
                                                            <a href="{{route('removeId',$cart->id_cart)}}" class="text-decoration-none text-inherit"> 
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10"
                                                                            y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14"
                                                                            y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-2 mx-auto">
                                                        <form method='POST' action="{{route('cartadd',$cart->id_cart)}}" >
                                                            @csrf
                                                            <div class="input-group input-spinner flex-nowrap w-100">
                                                                <a href='{{route('minus',[$cart->id_cart])}}' class='text-decoration-none btn btn-sm'>
                                                                    <i class="bi bi-dash-lg"></i>
                                                                </a>
                                                                <input type="text" value="{{$cart->amount}}" name="cart_quant" class="quantity-field form-control form-input ">
                                                                <a href='{{route('addmore',[$cart->id_cart])}}' class='text-decoration-none btn btn-sm' >
                                                                    <i class='bi bi-plus-lg'></i>
                                                                </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                        <span class="fw-bold">${{$cart->Product->sale>0 ? $cart->Product->price *(1-$cart->Product->sale/100):$cart->Product->price}} /kg</span>
                                                    </div>
                                                </div>
                                                @php
                                                    $price = $cart->Product->sale>0 ? $cart->Product->price *(1-$cart->Product->sale/100):$cart->Product->price;
                                                    $sum += $price *$cart->amount/1000;
                                                @endphp
                                            </li>
                                        @endforeach
                                    @else
                                        @foreach ($carts as $key=> $cart)
                                            <li class="list-group-item py-3 py-lg-0 px-0 border-top">
                                                <div class="row align-items-center">
                                                    <div class="col-3 col-md-2">
                                                        @if (isset($cart->Product))
                                                            <a href="{{ route('products-details',$cart->Product->id_product)}}">
                                                                <img src="{{ asset('images/products/'.$cart['image']) }}" alt="Ecommerce" class="img-fluid">
                                                            </a>
                                                        @else
                                                            <a href="{{ route('products-details',$cart['id_product'])}}">
                                                                <img src="{{ asset('images/products/'.$cart['image']) }}" alt="Ecommerce" class="img-fluid">
                                                            </a>
                                                        @endif
                                                    </div>
                                                    <div class="col-3 col-md-3">
                                                        @if (isset($cart->Product))
                                                            <a href="{{ route('products-details',$cart->Product->id_product)}}" class="text-inherit">
                                                                <h6 class="mb-0">{{$cart['name']}}</h6>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('products-details',$cart['id_product'])}}" class="text-inherit">
                                                                <h6 class="mb-0">{{$cart['name']}}</h6>
                                                            </a>
                                                        @endif
                                                        <span><small class="text-muted">unit: gram</small></span>
                                                        <div class="mt-2 small lh-1"> 
                                                            <a href="{{route('removeId',$key)}}" class="text-decoration-none text-inherit"> 
                                                                <span class="me-1 align-text-bottom">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                        height="14" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"
                                                                        class="feather feather-trash-2 text-success">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                        <line x1="10" y1="11" x2="10"
                                                                            y2="17"></line>
                                                                        <line x1="14" y1="11" x2="14"
                                                                            y2="17"></line>
                                                                    </svg>
                                                                </span>
                                                                <span class="text-muted">Remove</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-3 col-lg-2 mx-auto">
                                                        <form method='POST' action="{{route('cartadd',$key)}}" >
                                                            @csrf
                                                            <div class="input-group input-spinner flex-nowrap w-100">
                                                                <a href="{{route('minus',$key)}}" class='text-decoration-none btn btn-sm'>
                                                                    <i class="bi bi-dash-lg"></i>
                                                                </a>
                                                                <input type="text" value="{{$cart['amount']}}" name="cart_quant" class="quantity-field form-control form-input ">
                                                                <a href="{{route('addmore',$key)}}" class='text-decoration-none btn btn-sm' >
                                                                    <i class='bi bi-plus-lg'></i>
                                                                </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <!-- price -->
                                                    <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                                        <span class="fw-bold">${{$cart['sale']>0?$cart['per_price'] *(1- $cart['sale']/100): $cart['per_price']}} /kg</span>
                                                    </div>
                                                </div>
                                            </li>
                                            @php
                                                $price = $cart['sale']>0 ? $cart['per_price'] *(1-$cart['sale']/100):$cart['per_price'];
                                                $sum += $price *$cart['amount']/1000;
                                            @endphp
                                        @endforeach
                                    @endif
                                    
                                @else
                                <li class="list-group-item py-3 py-lg-0 px-0 border-top">
                                    <div class="row ">
                                        <h4 class="text-muted col-12 mb-5">There are no Item in Cart</h4>
                                        <a href="{{route('index')}}" class="btn btn-dark col-4 mx-auto">Back to Homepage</a>
                                    </div>
                                </li>
                                @endif
                            </ul>
                            <!-- btn -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{route('index')}}" class="btn btn-primary">Continue Shopping</a>
                                <a href="{{route('checkout')}}" class="btn btn-dark">Buy Now</a>
                            </div>

                        </div>
                    </div>

                    <!-- sidebar -->
                    <div class="col-12 col-lg-4 col-md-5">
                        <div class="mb-5 card mt-6">
                            <div class="card-body p-6">
                                <h2 class="h5 mb-4">Summary</h2>
                                <div class="card mb-2">
                                    <ul class="list-group list-group-flush" id="summary">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Item Subtotal</div>
                                            </div>
                                            <span>${{number_format($sum,2,',',' ')}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div>Service Fee</div>
                                            </div>
                                            <span>$2.00</span>
                                        </li>
                                        <li id="added_coupon" class="list-group-item d-flex justify-content-between align-items-start {{$coupon?'':'d-none'}}">
                                            <div class="me-2">
                                                <div>Coupon</div>
                                            </div>
                                            <div id="coupon_title">{{$coupon?$coupon->title:''}}</div>
                                            <div class="ms-auto text-danger" >
                                                <span id="discount">{{$coupon?($coupon->freeship? '- $'.number_format($coupon->discount,2,'.',' '): '- '.$coupon->discount."%"):""}}</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="me-auto">
                                                <div class="fw-bold">Total</div>
                                            </div>
                                            <span class="fw-bold" id="total_items" data-total="{{$sum+2}}">${{$coupon == null? number_format($sum+2,2,',',' ') : ($coupon->freeship? number_format($sum-$coupon->discount,2,'.',' '): number_format($sum*(1-$coupon->discount/100),2,'.',' '))}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-grid mb-1 mt-4">
                                    <a href="{{route('checkout')}}" class="btn btn-primary btn-lg d-flex justify-content-between align-items-center">Go to Checkout <span class="fw-bold" id="total_cart">${{$coupon == null? number_format($sum+2,2,',',' ') : ($coupon->freeship? number_format($sum-$coupon->discount,2,'.',' '): number_format($sum*(1-$coupon->discount/100),2,'.',' '))}}</span></a>
                                </div>
                                <p><small>By placing your order, you agree to be bound by the Freshcart <a
                                            href="#!">Terms of Service</a>
                                        and <a href="#!">Privacy Policy.</a> </small>
                                </p>
                                <div class="mt-8">
                                    <h2 class="h5 mb-3">Add Promo or Gift Card</h2>
                                    <div class="mb-1">
                                        <input type="text" class="form-control" id="giftcard" placeholder="{{Auth::check()?'Promo or Gift Card':'Sign In to Add Promo'}}" value="{{$coupon?$coupon->code:''}}" {{Auth::check()?'':'disabled'}}>
                                    </div>
                                    <div class='d-none text-danger text-center' id="wrong_code"></div>
                                    <div class="d-grid mt-2">
                                        <button type="button" id="checkCoupon" class="btn btn-outline-dark mb-1" {{Auth::check()?"":"disabled"}}>Redeem</button>
                                    </div>
                                    <p class="text-muted mb-0"> <small>Terms &amp; Conditions apply</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#checkCoupon').click(function(){
                if($('#giftcard').val().length>0){
                    $.get(window.location.origin+"/public/index.php/ajax/add-coupon/"+$('#giftcard').val(),function(data){
                        // console.log(data);
                        let dataJson = jQuery.parseJSON(data);
                        let total = parseFloat($('#total_items').data('total')); 
                        if(!dataJson['error']){
                            $('#added_coupon').removeClass('d-none');
                            $('#wrong_code').addClass('d-none');
                            $('#giftcard').removeClass('is-invalid')
                            $('#giftcard').addClass('is-valid');
                            $('#coupon_title').html(dataJson['title']);
                            if(dataJson['code'].includes('FREESHIP')){
                                $('#discount').html('- $'+dataJson['discount'].toFixed(2));
                                total -= parseFloat(dataJson['discount']);
                            }else{
                                $('#discount').html('- '+dataJson['discount']+'%');
                                total *=(1-parseFloat(dataJson['discount'])/100); 
                            };
                            $('#total_items').html('$'+total.toFixed(2));
                            $('#total_cart').html('$'+total.toFixed(2));
                        }else{
                            $('#total_items').html('$'+total.toFixed(2));
                            $('#added_coupon').addClass('d-none');
                            $('#giftcard').removeClass('is-valid');
                            $('#giftcard').addClass('is-invalid');
                            $('#wrong_code').removeClass('d-none').html(dataJson['error']);
                        }
                        
                    })
                }
            })
        })
    </script>
@endsection