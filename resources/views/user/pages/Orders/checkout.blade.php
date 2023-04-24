@extends('user.partials.master')
@section('content')
  <!-- section -->
  <section class="mb-lg-14 mb-8 mt-8">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div>
            <div class="mb-8">
              <h1 class="fw-bold mb-0">Checkout</h1>
              @if (!Auth::check())
              <p class="mb-0">Already have an account? Click here to <a href="#!" class="text-muted" data-bs-toggle="modal"
                data-bs-target="#userModal">Sign in</a>.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
      @php
          $shipment = 2;
      @endphp
      <div>
        <div class="row">
          @if (isset($cart) && count($cart)>0)
            <div class="col-lg-7 col-md-12">
              <form action="{{route('checkout')}}" method="post">
                @csrf
                <div class="accordion accordion-flush" id="accordionFlushExample">
                  <input type="hidden" name="shipment_fee" id="shipment_fee"value="2">
                  <div class="accordion-item py-4">
                    
                    @if (Auth::check())
                      <input type="hidden" name="code_coupon" value="{{$coupon? $coupon->code:''}}">
                      <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="fs-5 text-inherit collapsed h4"  data-bs-toggle="collapse"
                          data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                          <i class="feather-icon icon-map-pin me-2 text-muted"></i>Add delivery address
                        </a>
                        <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                          data-bs-target="#addAddressModal">Add a new address </a>
                      </div>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show"
                      data-bs-parent="#accordionFlushExample">
                      <div class="mt-5">
                        <div class="row" id="listAddress">
                          @if (count($address)>0)
                            @foreach ($address as $add)
                            <div class="col-lg-6 col-12 mb-4">
                              <div class="card card-body p-6 " style="height: 240px">
                                    <div class="form-check mb-4">
                                      <input class="form-check-input" type="radio" name="select_address" data-shipment="{{$add->shipment_fee}}" {{$add->default?'checked':''}} value="{{$add->id_address}}">
                                      <label class="form-check-label text-dark" >
                                        Reciver : {{$add->receiver}}
                                      </label>
                                    </div>
                                    <p class="text-muted">{{$add->email}}</p>
                                    <address style="height: 90px">
                                      {{$add->address}}<br>
                                      <abbr title="Phone">P: {{$add->phone}}</abbr></address>
                                    @if ($add->default)
                                    @php
                                        $shipment = $add->shipment_fee;
                                    @endphp
                                    <span class="text-danger">Default address </span>
                                    @endif
                                    <a href="javascript:void(0);" class="text-muted remove_add text-end" data-idadd="{{$add->id_address}}">Remove Address</a>
                                  </div>
                                </div>
                                @endforeach
                              @endif
                          </div>
                        </div>
                      </div>
                    @else

                    <div class="d-flex justify-content-between align-items-center">
                      <a href="#" class="fs-5 text-inherit collapsed h4"  data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                        <i class="feather-icon icon-map-pin me-2 text-muted"></i>Add delivery address
                      </a>
                    </div>
                    @if(\Session::has('error'))
                        <div class="alert alert-danger">{{ \Session::get('error') }}</div>
                        {{ \Session::forget('error') }}
                    @endif
                    @if(\Session::has('success'))
                        <div class="alert alert-success">{{ \Session::get('success') }}</div>
                        {{ \Session::forget('success') }}
                    @endif
                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                      
                      <div class="mt-5">
                        <div class="row g-3">
                          <!-- col -->
                          <div class="col-12">
                            <input type="text" class="form-control" name="receiver" placeholder="Reciever name"  required="">
                          </div>
                          <div class="col-6">
                            <input type="text" class="form-control" name="phone" placeholder="Phone number"  required="">
                          </div>
                          <div class="col-6">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                          </div>
                          <div class="col-12">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                          </div>
                          <div class="col-12">
                            <select class="form-select" name="province" id="province">
                            </select>
                          </div>
                          <div class="col-12">
                            <select class="form-select" name="district" id="district" disabled>
                            </select>
                          </div>
                          <div class="col-12">
                            <select class="form-select" name="ward" id="ward" disabled>
                            </select>
                          </div>
                        </div>
                      </div>
                   
                    </div>
                    @endif
                  </div>
                  
                  <div class="accordion-item py-4">
                    <a href="#" class="text-inherit h5"  data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>Delivery instructions
                    </a>
                    <div id="flush-collapseThree" class="accordion-collapse collapse "
                      data-bs-parent="#accordionFlushExample">

                      <div class="mt-5">
                        <label for="DeliveryInstructions" class="form-label sr-only">Delivery instructions</label>
                        <textarea class="form-control" id="DeliveryInstructions" rows="3"
                          placeholder="Write delivery instructions "></textarea>
                        <p class="form-text">Add instructions for how you want your order shopped and/or delivered</p>
                        <div class="mt-5 d-flex justify-content-end">
                          <a href="#" class="btn btn-outline-gray-400 text-muted"
                            data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                            aria-controls="flush-collapseTwo">Prev</a>
                          <a href="#" class="btn btn-primary ms-2"  data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                            aria-controls="flush-collapseFour">Next</a>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div><a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">thanh toán {{\Session::get('subtotal')}}$ bằng paypal</a></div>
                  <div class="accordion-item py-4">
                    <a href="#" class="text-inherit h5"  data-bs-toggle="collapse"
                      data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                      <i class="feather-icon icon-credit-card me-2 text-muted"></i>Payment Method
                    </a>
                    <div id="flush-collapseFour" class="accordion-collapse collapse "
                      data-bs-parent="#accordionFlushExample">
                      <div class="mt-5">
                        <div>
                          <div class="card card-bordered shadow-none mb-2">
                            <div class="card-body p-6">
                              <div class="d-flex">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="order_method" value="paypal" id="paypal" checked>
                                    <label class="form-check-label ms-2" for="paypal">
                                    </label>
                                </div>
                                
                                <div>
                                  <h5 class="mb-1 h6"> Payment with Paypal</h5>
                                  <p class="mb-0 small">You will be redirected to PayPal website to complete your purchase
                                    securely.</p>
                                   
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          <div class="card card-bordered shadow-none">
                            <div class="card-body p-6">
                              <div class="d-flex">
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="order_method" value="cod" id="cashonDelivery">
                                  <label class="form-check-label ms-2" for="cashonDelivery">
                                  </label>
                                </div>
                                <div>
                                  <h5 class="mb-1 h6"> Cash on Delivery</h5>
                                  <p class="mb-0 small">Pay with cash when your order is delivered.</p>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="mt-5 d-flex justify-content-end">
                            <a href="#" class="btn btn-outline-gray-400 text-muted"
                              data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                              aria-controls="flush-collapseThree">Prev</a>
                            <button type="submit" class="btn btn-primary ms-2" id="submit_order" >Finish Order</button>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                 

                </div>
              </form>
            </div>
          @else
          <div class="col-lg-7 col-md-12">
            <div class="row">
              <h4 class="text-muted col-12 mb-5">Look like you still add any Item to Cart to take an order.</h4>
              <a href="{{route('index')}}" class="btn btn-dark text-monospace col-4 mx-auto">Back to Homepage</a>
            </div>
          </div>
          @endif

          <div class="col-12 col-md-12 offset-lg-1 col-lg-4">
            <div class="mt-4 mt-lg-0">
              <div class="card shadow-sm">
                <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                <ul class="list-group list-group-flush">
                  @php
                      $subtotal = 0;
                  @endphp
                  @if (isset($cart))
                    @foreach ($cart as $item)
                      <li class="list-group-item px-4 py-3">
                        @if (Auth::check())
                        <div class="row align-items-center">
                          <div class="col-2 col-md-2">
                            <img src="{{asset('images/products/'.$item->Product->Library[0]->image)}}" alt="Ecommerce" class="img-fluid">    
                          </div>
                          <div class="col-5 col-md-5">
                            <h6 class="mb-0">{{$item->Product->name}}</h6>
                          </div>
                          <div class="col-2 col-md-2 text-center text-muted">
                            <span>{{$item->amount}}g</span>
                          </div>
                          <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                            @if ($item->Product->sale>0)
                            @php
                              $subtotal += ($item->Product->price * (1-$item->Product->sale/100))*($item->amount/1000);
                            @endphp
                                <span class="fw-bold">${{$item->Product->price * (1-$item->Product->sale/100)}}/kg</span>
                                <span class="text-decoration-line-through ms-2">{{$item->Product->price}}</span>
                            @else
                            @php
                              $subtotal += $item->Product->price*($item->amount/1000);
                            @endphp
                                <span class="fw-bold">${{$item->Product->price}}/1kg</span>
                            @endif
                          </div>
                        </div>
                        @else
                        <div class="row align-items-center">
                          <div class="col-2 col-md-2">
                            <img src="{{asset('images/products/'.$item['image'])}}" alt="Ecommerce" class="img-fluid">
                          </div>
                          <div class="col-5 col-md-5">
                            <h6 class="mb-0">{{$item['name']}}</h6>
                          </div>
                          <div class="col-2 col-md-2 text-center text-muted">
                            <span>{{number_format($item['amount'],0)}}g</span>
                          </div>
                          <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                            @if ($item['sale']>0)
                            @php
                              $subtotal += ($item['per_price'] * (1-$item['sale']/100))*($item['amount']/1000);
                            @endphp
                                <span class="fw-bold">${{$item['per_price'] * (1-$item['sale']/100)}}/kg</span>
                                <span class="text-decoration-line-through ms-2">{{$item['per_price']}}</span>
                            @else
                            @php
                              $subtotal += $item['per_price']*($item['amount']/1000);
                            @endphp
                                <span class="fw-bold">${{$item['per_price']}}/kg</span>
                            @endif
                          </div>
                        </div>
                        @endif
                      </li>
                    @endforeach
                  @else
                  <li class="list-group-item px-4 py-3">
                    <div class="text-center">
                        <h6 class="text-muted">There are no item in cart</h6>
                    </div>
                  </li>
                  @endif
                  <li class="list-group-item px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                      <div>
                        Item Subtotal
                      </div>
                      <div class="fw-bold">
                        ${{$subtotal}}
                      </div>

                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2 ">
                      <div>
                        Service Fee <i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip"
                          title="Shipment Fee"></i>
                      </div>
                      <div class="fw-bold" id="shippment_fee">
                        ${{number_format($shipment,2,'.',' ')}}
                      </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between d-none mb-2 " id="extra_ship">
                      <div>Extra Shipment fee<i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip" title="Shipment Fee"></i>
                      </div>
                      <div class="fw-bold text-danger" >
                        + $1
                      </div>
                    </div>
                    @if (Session::has('coupon'))
                    <div class="d-flex align-items-center justify-content-between mb-2 ">
                      <div>
                        Coupon {{$coupon->title}}<i class="feather-icon icon-info text-muted" data-bs-toggle="tooltip" title="Coupon"></i>
                      </div>
                      <div class="fw-bold" >
                        @if ($coupon->freeship)
                        <span class="text-danger"> - ${{number_format($coupon->discount,2,'.',' ')}}</span>
                        @else    
                        <span class="text-danger"> -{{$coupon->discount}}%</span>
                        @endif
                      </div>
                    </div>
                    @endif
                  </li>
                  <!-- list group item -->
                  <li class="list-group-item px-4 py-3">
                    <div class="d-flex align-items-center justify-content-between fw-bold">
                      <div>
                        Total
                      </div>
                      @php
                          $subtotal +=2;
                          if(Session::has('coupon') && $coupon->freeship){
                            $subtotal -= $coupon->discount;
                          }else if(Session::has('coupon')){
                            $subtotal *=(1- $coupon->discount/100);
                          }
                      @endphp
                      <div id="total" data-total="{{$subtotal}}">
                        ${{$subtotal }}
                      </div>
                    </div>
                  </li>
                </ul>
                
                <div id="paypal-button"></div>
                <input type="hidden" id="subtotal" value="{{$subtotal }}">
              </div>
            </div>
            @php
            \Session::put('subtotal',$subtotal);
            @endphp
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
  
@endsection
@section('script')

{{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'demo_sandbox_client_id',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'large',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: {{$subtotal}},
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      });
    }
  }, '#paypal-button');

</script> --}}

 

    <script>
      // Lắng nghe sự kiện "change" cho tất cả các input
document.querySelectorAll('input').forEach(input => {
  input.addEventListener('change', event => {
    // Lấy giá trị của input và lưu vào Local Storage
    localStorage.setItem(input.name, input.value);
  });
});

// Lấy giá trị đã lưu trong Local Storage và hiển thị lại trên các input
document.querySelectorAll('input').forEach(input => {
  input.value = localStorage.getItem(input.name) || '';
});

      $(document).ready(function(){
            // $('#sendAddress').click(function(){
            //   $.ajax({
            //     method: "POST",
            //     headers: {'X-CSRF-TOKEN':  '{{csrf_token()}}' },
            //     url: window.location.origin+'/public/index.php/ajax/add_address',
            //     data: {
            //       'name':$('input[name=nameReciever]').val(),
            //       'email':$('input[name=emailReciever]').val(),
            //       'phone':$('input[name=phoneReciever]').val(),
            //       'address':$('input[name=addressReciever]').val()+ ", " + $('#ward option:selected').val()+', '+$('#district option:selected').val()+", "+$('#province option:selected').val(),
            //       'shipment_fee': $('#province option:selected').val() != "Thành phố Hồ Chí Minh" ? 3:2,
            //     },
            //     success: function (data) {
            //       $("#listAddress").html(data);
            //       $('.remove_add').click(function(){
            //         $.get(window.location.origin+"/public/index.php/ajax/remove_address/"+$(this).data('idadd'),function(data){
            //           $("#listAddress").html(data);
            //           $('input[name="select_address"]').change(function(){
            //             console.log($('input[name="select_address"]:checked').data('shipment'));
            //             console.log($('input[name="select_address"]:checked').val());
            //           //   if(parseFloat($(this).data('shipment'))>2){
            //           //     $('#extra_ship').removeClass('d-none');
            //           //       $('#shipment_fee').val(3);
            //           //       let totall = parseFloat($("#total").data('total'))+1;
            //           //       $('#total').html("$"+totall);
            //           //   }else{
            //           //     if(!$('#extra_ship').hasClass('d-none')){
            //           //       $('#extra_ship').addClass('d-none');
            //           //     }
            //           //       $('#shipment_fee').val(2);
            //           //       $('#total').html('$'+$("#total").data('total'));
            //           //   }
            //           })
            //       });
            //       })
            //     }
            //   });
            // });
            $('.remove_add').click(function(){
              window.location.assign(window.location.origin+'/public/index.php/remove_address/'+$(this).data('idadd'));
            });
            $('input[name="select_address"]').change(function(){
              if(parseFloat($('input[name="select_address"]:checked').data('shipment'))>2){
                $('#extra_ship').removeClass('d-none');
                  $('#shipment_fee').val(3);
                  let totall = parseFloat($("#total").data('total'))+1;
                  $('#total').html("$"+totall);
              }else{
                if(!$('#extra_ship').hasClass('d-none')){
                  $('#extra_ship').addClass('d-none');
                }
                  $('#shipment_fee').val(2);
                  $('#total').html('$'+$("#total").data('total'));
              }
            })
        })
    </script>
@endsection
