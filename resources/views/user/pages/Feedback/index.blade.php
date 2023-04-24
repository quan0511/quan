@extends('user.partials.master')
@section('content')
<main>
    <div class="mt-4">
      <div class="container">
        <div class="row ">
          <div class="col-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Feedback</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <section class="mt-8 mb-14">
      <div class="container">
        <div class="row">
            <h1>Feedback</h1>
            <i class="text-black-50 ms-3">Thank you for trust us. Tell us about our product</i>
            <i class="text-black-50 ms-5">Did they satisfied you?</i>
            <table class="table table-bordered mt-3">
                @if ($order == null)
                    <tr><td class="text-center"><h2>There are no Order</h2></td></tr>
                @else
                <thead>
                    <tr>
                        <th colspan="3" class="text-black-50">Order at: {{date_format($order->created_at,"F j, Y, g:i a")}}</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{route('feedback',$order->order_code)}}" method="post">
                    @csrf
                    @foreach ($order->Cart as $cart)
                        <tr>
                            <td class="w-25">
                                <img src="{{asset('images/products/'.$cart->Product->Library[0]->image)}}" class="img-fluid" alt="{{$cart->Product->name}}" style="height: 200px; object-fit: contain">    
                            </td>
                            <td class="w-25">
                                <p>Product: <b>{{$cart->Product->name}}</b></p>
                                <p>Amount: {{$cart->amount}} grams</p>
                            </td>   
                            <td class="w-50">
                                <div class="form-check form-check-inline mb-3">
                                    <input type="hidden" class="stop1">
                                    <input type="radio" name="rating_pro{{$cart->id_cart}}" class="btn-check" id="rating-{{$cart->id_cart}}-btn1" autocomplete="off" value="1" checked>
                                    <label class="btn-cus text-warning" for="rating-{{$cart->id_cart}}-btn1" >
                                        <i class="bi bi-star" style="font-size:1.3rem"></i>
                                    </label>
                                    <input type="radio" name="rating_pro{{$cart->id_cart}}" class="btn-check" id="rating-{{$cart->id_cart}}-btn2" autocomplete="off" value="2">
                                    <label class="btn-cus text-warning" for="rating-{{$cart->id_cart}}-btn2">
                                        <i class="bi bi-star" style="font-size:1.3rem"></i>
                                    </label>
                                    <input type="radio" name="rating_pro{{$cart->id_cart}}" class="btn-check" id="rating-{{$cart->id_cart}}-btn3" autocomplete="off" value="3">
                                    <label class="btn-cus text-warning" for="rating-{{$cart->id_cart}}-btn3">     
                                        <i class="bi bi-star" style="font-size:1.3rem"></i>                                    
                                    </label>
                                    <input type="radio" name="rating_pro{{$cart->id_cart}}" class="btn-check" id="rating-{{$cart->id_cart}}-btn4" autocomplete="off" value="4">
                                    <label class="btn-cus text-warning" for="rating-{{$cart->id_cart}}-btn4">
                                        <i class="bi bi-star" style="font-size:1.3rem"></i>
                                    </label>
                                    <input type="radio" name="rating_pro{{$cart->id_cart}}" class="btn-check" id="rating-{{$cart->id_cart}}-btn5" autocomplete="off" value="5">
                                    <label class="btn-cus text-warning" for="rating-{{$cart->id_cart}}-btn5">
                                        <i class="bi bi-star" style="font-size:1.3rem"></i>
                                    </label>
                                    <input type="hidden" class="stop2">
                                </div>
                                <div class="mb-3">
                                    <textarea name="content_fb{{$cart->id_cart}}" rows="6" class="form-control content_fb"></textarea>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td colspan="3" class="text-center">
                                <input type="submit" value="Post"id="post_fb" class="btn btn-primary fs-4" style="width: 130px">
                            </td>
                        </tr>
                    </form>
                </tbody>
            </table>
        </div>
      </div>
    </section>
  </main>  
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $("input[type='radio']").click(function(){
            $(this).prevUntil("input.stop1").next().children().removeClass('bi-star').addClass('bi-star-fill');
            $(this).next().children().removeClass('bi-star').addClass('bi-star-fill');
            $(this).nextUntil("input.stop2").next().children().removeClass('bi-star-fill').addClass('bi-star');
        });
    })
</script>
@endsection