@extends('user.partials.master')
@section('content')
    <main>
        @include('user.partials.breadcrumb')
        <section class="mt-8">
            <div class="container">
                <div class="row">
                    <div class="col-5 ">
                        <div class="slide_wrapper">
                            <div class="slider_product product" >
                                @foreach ($product->Library as $lib)
                                <div class="zoom slider_item" onmousemove="zoom(event)" style="background-image: url({{ asset('images/products/' . $lib->image) }}">
                                    <img src="{{ asset('images/products/'.$lib->image) }}" class="img-fluid">
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="product-tools ">
                            <div class="thumbnails slider_nav row g-3" id="productThumbnails">
                                @foreach ($product->Library as $lib)
                                    <div class="col-3">
                                        <div class="thumbnails-img">
                                            <img src="{{ asset('images/products/' . $lib->image) }}" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6 mx-auto">
                        <div class="ps-lg-10 mt-6 mt-md-0">
                            <a href="#!" class="mb-4 d-block">{{ $product->TypeProduct->type}}</a>
                            <h1 class="mb-1">{{ $product->name }}</h1>
                            <div class="mb-4">
                                <small class="text-warning"> 
                                    @php
                                        $rating = 0;
                                        if(count($product->Comment->where('rating','!=',null))>0){
                                            foreach ($product->Comment->where('rating','!=',null) as $cmt) {
                                                $rating+=$cmt->rating;
                                            }
                                            $rating /=count($product->Comment->where('rating','!=',null));
                                        }
                                    @endphp
                                    @for ($i = 0; $i < floor($rating); $i++)
                                    <i class="bi bi-star-fill fs-4 text-warning"></i>
                                    @endfor
                                    @if (is_float($rating))
                                    <i class="bi bi-star-half fs-4 text-warning"></i>
                                    @endif
                                    @for ($i = 0; $i < 5-ceil($rating); $i++)
                                    <i class="bi bi-star fs-4 text-warning"></i>
                                    @endfor
                                </small>
                                <a href="#" class="ms-2">({{count($product->Comment->where('rating','!=',null))}} reviews)</a>
                            </div>
                            <div class="fs-4">
                                @if ($product->sale >0)
                                    <span class="fw-bold text-dark">${{ number_format($product->price*(1 - $product->sale/100),2,'.',' ') }}</span> 
                                    <span class="text-decoration-line-through text-muted">${{ $product->price }}</span>
                                    <span>
                                        <small class="fs-6 ms-2 text-danger">{{ $product->sale }}% Off</small>
                                    </span>
                                @else
                                <span class="fw-bold text-dark">${{ number_format($product->price,2,'.',' ') }}</span> 
                                @endif
                            </div>
                            <hr class="my-6">
                            <div class="mb-5"><button type="button" class="btn btn-outline-secondary">100g</button>
                            </div>
                            <form action="{{route('products-details',[$product->id_product])}}" method="post" >
                                @csrf
                                  <div class="d-flex flex-row  ">
                                      <input type="hidden" name="max_quan" value="{{$product->quantity}}">
                                      <input type="hidden" name="id_pro" value="{{$product->id_product}}">
                                      <button type="button" class="btn btn-outline-secondary" style="border-radius: 10px 0 0 10px;" id="btn_minus">
                                        <i class="bi bi-dash-lg"></i>
                                      </button>
                                      <input type="text" name="quan" class="border border-secondary text-center pt-1 fs-4 text-secondary" style="width: 50px;" value="100"/>
                                      <button type="button" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;" id="btn_plus" >
                                        <i class="bi bi-plus-lg"></i>
                                      </button>
                                  </div>
                                  <div class="mt-3 row justify-content-start g-2 align-items-center ">
                                      <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid ">
                                          <button type="submit" class="btn btn-primary">
                                              <i class="feather-icon icon-shopping-bag me-2"></i>Add to cart
                                          </button>
                                      </div>
                                      <div class="col-md-4 col-4 mx-auto">
                                        <a class="btn btn-light compare_product" data-bs-toggle="tooltip" data-bs-html="true" title="Compare" data-bs-product="{{$product->id_product}}">
                                            <i class="bi bi-arrow-left-right"></i>
                                        </a>  
                                        <a class="btn btn-light {{Auth::check()? 'addFav':''}}"  {{!Auth::check() ?'data-bs-toggle=modal data-bs-target=#userModal href=#!': "data-bs-toggle='tooltip' data-bs-html='true' title='Wishlist' data-bs-idproduct=$product->id_product"}} >
                                            <i class="bi {{Auth::check() ? (count(Auth::user()->Favourite->where('id_product','=',$product->id_product))>0 ? 'bi-heart-fill text-danger' : 'bi-heart'): 'bi-heart'}}"></i>
                                        </a>
                                        {{-- <a class="btn btn-light " href="#" data-bs-toggle="tooltip" data-bs-html="true"
                                              aria-label="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                          <a class="btn btn-light " href="{{ Route('wishlist') }}" data-bs-toggle="tooltip"
                                              data-bs-html="true" aria-label="Wishlist"><i class="fa-regular fa-heart"></i></a> --}}
                                      </div>
                                  </div>
                              </form>
                            <hr class="my-6">
                            <div>
                                <table class="table table-borderless mb-0">
    
                                    <tbody>
                                        <tr>
                                            <td>Product Code:</td>
                                            <td>{{ $product->id_product }}</td>
    
                                        </tr>
                                        <tr>
                                            <td>Availability:</td>
                                            <td>
                                                @if ($product->quantity > 0)
                                                    {{ number_format($product->quantity, 0) }}
                                                @else
                                                    Disabled
                                                @endif
    
                                            </td>
    
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>{{ $product->typeproduct->type }}</td>
    
                                        </tr>
                                        <tr>
                                            <td>Shipping:</td>
                                            <td><small>01 day shipping.
                                                <span class="text-muted">( Free pickup today)</span></small>
                                            </td>
                                        </tr>
    
    
                                    </tbody>
                                </table>
    
                            </div>
                            <div class="mt-8">
                                <!-- dropdown -->
                                <div class="dropdown">
                                    <a class="btn btn-outline-secondary" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Share <i class="fa-solid fa-chevron-right"></i>
                                    </a>
    
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="bi bi-facebook me-2"></i>Facebook</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="bi bi-twitter me-2"></i>Twitter</a></li>
                                        <li><a class="dropdown-item" href="#"><i
                                                    class="bi bi-instagram me-2"></i>Instagram</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-lg-14 mt-8 ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                    data-bs-target="#product-tab-pane" type="button" role="tab"
                                    aria-controls="product-tab-pane" aria-selected="true">Product Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                    data-bs-target="#details-tab-pane" type="button" role="tab"
                                    aria-controls="details-tab-pane" aria-selected="false">Information</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                                aria-labelledby="product-tab" tabindex="0">
                                <div class="my-8">
                                    <div class="mb-5">
                                        {{ $product->description }}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="details-tab-pane" role="tabpanel"
                                aria-labelledby="details-tab" tabindex="0">
                                <div class="my-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="mb-4">Details</h4>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Ingredient Type</th>
                                                        <td>{{$product->TypeProduct->type!='meat'?'Vegetarian':"Meat"}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <td>{{$product->quantity}} Gram</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <table class="table table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>Best Sellers Rank</th>
                                                        <td>#2 in Fruits</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date First Available</th>
                                                        <td>{{$product->created_at}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="my-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="me-lg-12 mb-6 mb-md-0">
                                                <div class="mb-5">
                                                    <h4 class="mb-3">Customer reviews</h4>
                                                    <span>
                                                        <small class="text-warning"> 
                                                            @php
                                                                $rating2 = 0;
                                                                if(count($product->Comment->where('rating','<>',null))>0){
                                                                    foreach($product->Comment->where('rating','<>',null) as $comt){
                                                                        $rating2 += $comt->rating;
                                                                    }    
                                                                    $rating2 /= count($product->Comment->where('rating','<>',null));
                                                                }
                                                            @endphp
                                                            @for ($i = 0; $i < floor($rating2); $i++)
                                                            <i class="bi bi-star-fill"></i>
                                                            @endfor
                                                            @if (is_float($rating2))
                                                            <i class="bi bi-star-half"></i>
                                                            @endif
                                                            @for ($i = 0; $i < 5- ceil($rating2); $i++)
                                                            <i class="bi bi-star"></i>
                                                            @endfor
                                                        </small>
                                                        <span class="ms-3">{{number_format($rating2, 2,'.',' ')}} out of 5</span><small class="ms-3">{{count($product->Comment->where('rating','<>',null))}} customer ratings</small>
                                                    </span>
                                                </div>
                                                <div class="mb-8">
                                                    @if (count($product->Comment->where('rating','<>',null))>0)
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">5</span>
                                                                    <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{count($product->Comment->where('rating','=',5))/count($product->Comment->where('rating','!=',null))*100 }}%;" aria-valuenow="{{count($product->Comment->where('rating','=',5))/count($product->Comment->where('rating','!=',null))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">{{count($product->Comment->where('rating','=',5))/count($product->Comment->where('rating','!=',null))*100}}%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">4</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{count($product->Comment->where('rating','=',4))/count($product->Comment->where('rating','<>',null))*100}}%;" aria-valuenow="{{count($product->Comment->where('rating','=',4))/count($product->Comment->where('rating','<>',null))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">{{count($product->Comment->where('rating','=',4))/count($product->Comment->where('rating','<>',null))*100}}%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">3</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{count($product->Comment->where('rating','=',3))/count($product->Comment->where('rating','<>',null))*100}}%;" aria-valuenow="{{count($product->Comment->where('rating','=',3))/count($product->Comment->where('rating','<>',null))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">{{count($product->Comment->where('rating','=',3))/count($product->Comment->where('rating','<>',null))*100}}%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">2</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{count($product->Comment->where('rating','=',2))/count($product->Comment->where('rating','<>',null))*100}}%;" aria-valuenow="{{count($product->Comment->where('rating','=',2))/count($product->Comment->where('rating','<>',null))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">{{count($product->Comment->where('rating','=',2))/count($product->Comment->where('rating','<>',null))*100}}%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">1</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{count($product->Comment->where('rating','=',1))/count($product->Comment->where('rating','<>',null))*100}}%;" aria-valuenow="{{count($product->Comment->where('rating','=',1))/count($product->Comment->where('rating','<>',null))*100}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">{{count($product->Comment->where('rating','=',1))/count($product->Comment->where('rating','<>',null))*100}}%</span>
                                                        </div>
                                                    @else
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">5</span>
                                                                    <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <span class="text-muted ms-3">0%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">4</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">0%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">3</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">0%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">2</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">0%</span>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-2">
                                                            <div class="text-nowrap me-3 text-muted">
                                                                <span class="d-inline-block align-middle text-muted">1</span>
                                                                <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                            </div>
                                                            <div class="w-100">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div><span class="text-muted ms-3">0%</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="mb-10">
                                                <div class="d-flex justify-content-between align-items-center mb-8">
                                                    <div>
                                                        <h4>Reviews</h4>
                                                    </div>
                                                    <div>
                                                        <select class="form-select">
                                                            <option selected>Top Review</option>
                                                            <option value="1">One</option>
                                                            <option value="2">Two</option>
                                                            <option value="3">Three</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                @if (Auth::check())
                                                <div class="row mb-3 w-100">
                                                    <div class="col-md-2 col-lg-1">
                                                        <img src="images/avatar/{{Auth::user()->image ?Auth::user()->image : 'user.png'}}" alt="" class="rounded-circle" width="48px" height="48px" style="object-fit: cover">
                                                    </div>
                                                    <div class="col-lg-11 col-md-10 d-flex flex-column ">
                                                        <form action="{{route('addComment')}}" method="post">
                                                        @csrf
                                                            <input type="hidden" name="id_product" value="{{$product->id_product}}">
                                                            <div id="printf"></div>
                                                            <div class="mb-3">
                                                                <textarea name="comment" id="input_comment"rows="2" class="form-control">Add Comment</textarea>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between">
                                                                <span class="text-black-50 count-word"></span>
                                                                <input type="submit" value="Post" id="submit_comment" class="btn btn-primary" disabled>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                @endif
                                                @if (count($comments) == 0)
                                                <div class=" text-center pb-6 mb-6">
                                                    <h4 class="text-muted">There are no Comment in this Product</h4>
                                                </div>
                                                @else
                                                    @foreach ($comments as $cmt)
                                                        <div class="row border-bottom pb-6 mb-6">
                                                            @if ($cmt->User->avatar)
                                                            <img src="{{ asset('images/avatar/'.$cmt->User->avatar)}}"  class="rounded-circle avatar-lg col-2 p-0">
                                                            @else
                                                            <img src="{{ asset('images/avatar/user.png')}}"  class="rounded-circle avatar-lg col-2 p-0">
                                                            @endif
                                                            <div class="ms-5 col-8 mx-auto">
                                                                <h6 class="mb-1">
                                                                    {{$cmt->id_user? $cmt->User->name: $cmt->name}}
                                                                </h6>
                                                                <p class="small"> <span class="text-muted">{{date_format($cmt->created_at,"j F Y")}}</span>
                                                                @if ($cmt->verified)
                                                                    <span class="text-primary ms-3 fw-bold">Verified Purchase</span>
                                                                @else    
                                                                    <span class="text-danger ms-3 fw-bold">Unverified Purchase</span>
                                                                @endif
                                                                </p>
                                                                
                                                                @if ($cmt->rating)
                                                                    <div class=" mb-2 current_rating">
                                                                        @for ($i = 0; $i < $cmt->rating; $i++)
                                                                        <i class="bi bi-star-fill text-warning"></i>
                                                                        @endfor
                                                                        @for ($i = 0; $i < 5 - $cmt->rating; $i++)
                                                                        <i class="bi bi-star text-warning"></i>
                                                                        @endfor
                                                                    </div>    
                                                                @endif
                                                                <p class="current_cmt">{{$cmt->context}}</p>
                                                                @if (Auth::check()&&$cmt->id_user != Auth::user()->id_user)
                                                                    <div class="d-flex justify-content-end mt-4">
                                                                        <a href="#" class="text-muted">
                                                                            <i class="bi bi-hand-thumbs-up me-2"></i>Like</a>
                                                                        <a href="#" class="text-muted ms-4">
                                                                            <i class="bi bi-flag me-2"></i>Report abuse</a>
                                                                    </div>
                                                                @endif
                                                                <div class="collapse" id="collapseEdit{{$cmt->id_comment}}">
                                                                    <form action="{{route('edit_cmt',$cmt->id_comment)}}" method="post">
                                                                      @csrf
                                                                      @if ($cmt->rating!=null && $cmt->verified)
                                                                        <div class="form-check form-check-inline mb-3">
                                                                            <input type="hidden" class="stop1">
                                                                            <input type="radio" name="rating_cmt" class="btn-check" id="rating{{$cmt->id_comment}}-btn1" autocomplete="off" value="1" {{$cmt->rating == 1 ? "checked":''}}>
                                                                            <label class="btn-cus text-warning" for="rating{{$cmt->id_comment}}-btn1" >
                                                                                <i class="bi {{ $cmt->rating >=1 ? 'bi-star-fill':'bi-star'}}" ></i>
                                                                            </label>
                                                                            <input type="radio" name="rating_cmt" class="btn-check" id="rating{{$cmt->id_comment}}-btn2" autocomplete="off" value="2" {{$cmt->rating == 2 ? "checked":''}}>
                                                                            <label class="btn-cus text-warning" for="rating{{$cmt->id_comment}}-btn2">
                                                                                <i class="bi {{ $cmt->rating >=2 ? 'bi-star-fill':'bi-star'}}" ></i>
                                                                            </label>
                                                                            <input type="radio" name="rating_cmt" class="btn-check" id="rating{{$cmt->id_comment}}-btn3" autocomplete="off" value="3" {{$cmt->rating == 3 ? "checked":''}}>
                                                                            <label class="btn-cus text-warning" for="rating{{$cmt->id_comment}}-btn3">     
                                                                                <i class="bi {{ $cmt->rating >=3 ? 'bi-star-fill':'bi-star'}}"></i>                                    
                                                                            </label>
                                                                            <input type="radio" name="rating_cmt" class="btn-check" id="rating{{$cmt->id_comment}}-btn4" autocomplete="off" value="4" {{$cmt->rating == 4 ? "checked":''}}>
                                                                            <label class="btn-cus text-warning" for="rating{{$cmt->id_comment}}-btn4">
                                                                                <i class="bi {{ $cmt->rating >=4 ? 'bi-star-fill':'bi-star'}}"></i>
                                                                            </label>
                                                                            <input type="radio" name="rating_cmt" class="btn-check" id="rating{{$cmt->id_comment}}-btn5" autocomplete="off" value="5" {{$cmt->rating == 5 ? "checked":''}}>
                                                                            <label class="btn-cus text-warning" for="rating{{$cmt->id_comment}}-btn5">
                                                                                <i class="bi {{ $cmt->rating >=5 ? 'bi-star-fill':'bi-star'}}"></i>
                                                                            </label>
                                                                            <input type="hidden" class="stop2">
                                                                        </div>    
                                                                      @endif
                                                                      <div class="mb-3">
                                                                          <textarea name="content_cmt" rows="3" class="form-control content_fb">{{$cmt->context}}</textarea>
                                                                      </div>
                                                                      <div class="mb-3 row">
                                                                          <button type="button" class="btn btn-secondary col-4 btn-cancel" data-bs-target="#collapseEdit{{$cmt->id_comment}}" data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseEdit{{$cmt->id_comment}}">Cancel</button>
                                                                          <div class="col-1"></div>
                                                                          <button class="btn btn-primary col-4 btn_submit_edit " type="submit" disabled>Save Change</button>
                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                            </div>
                                                            <div class="col-1 dropdown ">
                                                                <a class="dropdown-toggle commt-edit user_dropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                  <i class="fa-solid fa-ellipsis fa-xl"></i>
                                                                </a>
                                                                @if (Auth::check()&&$cmt->id_user == Auth::user()->id_user)
                                                                <ul class="dropdown-menu">
                                                                  <li><a class="dropdown-item edit_btn" href="#collapseEdit{{$cmt->id_comment}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseEdit{{$cmt->id_comment}}">Edit</a></li>
                                                                  <li><a class="dropdown-item" href="{{route('delete_cmt',$cmt->id_comment)}}" onclick="return confirm('Do you want delete this comment?')">Delete</a></li>
                                                                </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sellerInfo-tab-pane" role="tabpanel"
                                aria-labelledby="sellerInfo-tab" tabindex="0">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-lg-14 my-14">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3>Related Items</h3>
                    </div>
                </div>
                <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
                    @foreach ($related_products as $re_product)
                        <div class="col">
                            <div class="card card-product">
                                <div class="card-body">
                                    <div class="text-center position-relative ">
                                        <div class=" position-absolute top-0 start-0">
                                            @if ($re_product->sale>0)
                                            <span class="badge bg-danger">{{ number_format($re_product->sale,0 )}}%</span>
                                            @endif
                                        </div>
                                        <a href="#!">
                                            <img src="{{ asset('images/products/' . $re_product->Library[0]->image) }}" alt="{{ $product->name }}" class="mb-3 img-fluid">
                                        </a>
                                        <div class="card-product-action">
                                            <a class="btn-action btn_modal" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product="{{$re_product->id_product}}">
                                                <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="Quick View"></i>
                                            </a>
                                            <a class="btn-action {{Auth::check()? 'addFav':''}}" data-bs-toggle="tooltip"
                                            {{!Auth::check() ?'data-bs-toggle=modal data-bs-target=#userModal href=#!': "data-bs-toggle='tooltip' data-bs-html='true' title='Wishlist' data-bs-idproduct=$re_product->id_product"}} ><i class="bi {{Auth::check() ? (count(Auth::user()->Favourite->where('id_product','=',$re_product->id_product))>0 ? 'bi-heart-fill text-danger' : 'bi-heart'): 'bi-heart'}}"></i></a>
                                            <a class="btn-action compare_product" data-bs-toggle="tooltip" data-bs-html="true" title="Compare" data-bs-product="{{$re_product->id_product}}">
                                                <i class="bi bi-arrow-left-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-small mb-1"><a href="#!"
                                            class="text-decoration-none text-muted"><small>{{ $re_product->TypeProduct->type }}</small></a>
                                    </div>
                                    <h2 class="fs-6">
                                        <a href="{{ route('products-details', $re_product->id_product) }}" class="text-inherit text-decoration-none">{{ $re_product->name }}</a>
                                    </h2>
                                    <div>
                                        <small class="text-warning"> 
                                            @php
                                                $rating3 = 0;
                                                if(count($re_product->Comment->where('rating','<>', null))>0){
                                                    foreach ($re_product->Comment->where('rating','<>', null) as $re_cmt) {
                                                        $rating3 += $re_cmt->rating;
                                                    }
                                                    $rating3 /= count($re_product->Comment->where('rating','<>', null));
                                                }
                                            @endphp
                                            @for ($i = 0; $i < floor($rating3); $i++)
                                            <i class="bi bi-star-fill"></i>
                                            @endfor
                                            @if (is_float($rating3))
                                            <i class="bi bi-star-half"></i>     
                                            @endif
                                            @for ($i = 0; $i < 5-ceil($rating3); $i++)
                                            <i class="bi bi-star"></i>
                                            @endfor
                                        </small>
                                        <span class="text-muted small">{{number_format($rating3,1,'.',' ')}}({{count($re_product->Comment->where('rating','<>', null))}})</span>
                                    </div>
                                    <!-- price -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            @if ($re_product->sale>0)
                                                <span class="text-dark">${{ number_format($re_product->price*(1- $re_product->sale/100),2,'.',' ')}}</span> 
                                                <span class="text-decoration-line-through text-muted">${{ number_format(($re_product->price),2,'.',' ')}}</span>
                                            @else
                                            <span class="text-dark">${{ number_format($re_product->price,2,'.',' ')}}</span> 
                                            @endif
                                        </div>
                                        <div>
                                            <button data-bs-id="{{$re_product->id_product}}" type="button" class="btn btn-primary btn addToCart">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19">
                                                    </line>
                                                    <line x1="5" y1="12" x2="19" y2="12">
                                                    </line>
                                                </svg> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')
<script>
    let slider = tns({
        container: '.slider_product',
        items: 1,
        speed: 500,
        autoplay: true,
        axis: "horizontal",
        autoplayButtonOutput:0,
        controls: 0,
        navContainer: '.slider_nav',
        navAsThumbnails:true
    })
  $(document).ready(function(){
    $('#btn_minus').click(function(e){
          e.preventDefault();
          let current = parseInt($('input[name=quan]').val());
          if(current>0){
              $.get(window.location.pathname,function(){
                  current--;
                  $('input[name=quan]').val(current);
              });
          }else{
              alert("Can choose less than 0");
          }
      });
      $('#btn_plus').click(function(e){
          e.preventDefault();
          let max = parseInt($('input[name=max_quan]').val());
          let current = parseInt($('input[name=quan]').val());
          if(max > current){
              $.get(window.location.pathname,function(){
                  current++;
                  $('input[name=quan]').val(current);
              });
          }else{
              alert("You can't choose more than quantity of product");
          }
      });
      $('input[name=quan]').on('focusout',function(e){
          e.preventDefault();
          let validateNum =/^\d{1,10}$/;
          let currentVl = $(this).val();
          // if(!validateNum.test(currentVl)){
          //     $(this).val(1);
          // }
          $(this).val(validateNum.test(currentVl)?currentVl:1);
      });
      // $('#count-word').text($('#comment').value.length+ " /1000 characters");
      $('#comment').focusout(function(e){
          e.preventDefault();
          let num = $(this).val().length;
          $.get(window.location.href,function(data){
              $('.count-word').text(num + " /1000 characters");
              if(num>1000){
                  $('.count-word').removeClass('text-black-50').addClass('text-danger');
              }
          });
      });
      $("input[name='rating_cmt']").click(function(){
          $(this).prevUntil("input.stop1").next().children().removeClass('bi-star').addClass('bi-star-fill');
          $(this).next().children().removeClass('bi-star').addClass('bi-star-fill');
          $(this).nextUntil("input.stop2").next().children().removeClass('bi-star-fill').addClass('bi-star');
      });
      $('#input_comment').change(function(){
        if($(this).val().length>0){
            $('#submit_comment').removeAttr('disabled');
        }else{
            $('#submit_comment').attr('disabled','disabled');
        }
      })
      $('.edit_btn').click(function(){
        // console.log($(this).parent().children('.current_cmt'));
        $(this).parents('.dropdown').prev().children('.current_rating').hide();
        $(this).parents('.dropdown').prev().children('.current_cmt').hide();
      });
      $('.btn-cancel').click(function(){
        $('.current_rating, .current_cmt').show();
      });
      $('.content_fb').change(function(){
        $('.btn_submit_edit').removeAttr('disabled');
      });
      $('input[name=rating_cmt]').change(function(){
        $('.btn_submit_edit').removeAttr('disabled');
      })
  })
</script>
@endsection
