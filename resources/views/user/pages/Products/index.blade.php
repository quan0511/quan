@extends('user.partials.master')
@section('content')
<style>
    .filterDiv {
    
      display: none;
    }
    
    .show {
      display: block;
    }
    .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rating-value{
            display: none;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:rgba(0, 0, 0, 0.302);
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc107;    
        }
        
        
        

        .rateComment {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rateComment:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rateComment:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:rgba(0, 0, 0, 0.302);
        }
        .rateComment:not(:checked) > label:before {
            content: '★ ';
        }
        .rateComment > input:checked ~ label {
            color: #ffc107;    
        }
        .rateComment > input:checked + label:hover,
        .rateComment > input:checked + label:hover ~ label,
        .rateComment > input:checked ~ label:hover,
        .rateComment > input:checked ~ label:hover ~ label,
        .rateComment > label:hover ~ input:checked ~ label {
            color: #ffc107;
        }
    
    </style>
    <main>
        
        <!-- breadcrumb -->
        @include('user.partials.breadcrumb')
        <!-- end breadcrumb -->

        <!-- section -->
        <div class=" mt-8 mb-lg-14 mb-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row gx-10">
                    <!--- navCategory --->
                    <!-- col -->
                    @include('user.partials.Products.navCategory')
                    <!--- end navCategory --->

                    {{-- main --}}
                    <section class="col-lg-9 col-md-12">
                        <!-- card -->
                        <div class="card mb-4 bg-light border-0">
                            <!-- card body -->
                            <div class=" card-body p-9">
                                @if (isset($name))
                                <h2 class="mb-0 fs-1">Search for: {{$name}}</h2>
                                    
                                @else
                                <h2 class="mb-0 fs-1">Snacks & Munchies</h2>
                                    
                                @endif
                            </div>
                        </div>
                        <!-- list icon -->
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <div class="mb-3 mb-lg-0">
                                <p class="mb-0"> <span class="text-dark">24 </span> Products found </p>
                            </div>

                            <!-- icon -->
                            <div class="d-md-flex justify-content-between align-items-center">
                                {{-- <div class="d-flex align-items-center justify-content-between">
                                    <div>

                                        <a href="shop-list.html" class="text-muted me-3"><i class="bi bi-list-ul"></i></a>
                                        <a href="shop-grid.html" class=" me-3 active"><i class="bi bi-grid"></i></a>
                                        <a href="shop-grid-3-column.html" class="me-3 text-muted"><i
                                                class="bi bi-grid-3x3-gap"></i></a>
                                    </div>
                                    <div class="ms-2 d-lg-none">
                                        <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas"
                                            href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-filter me-2">
                                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                            </svg> Filters</a>
                                    </div>
                                </div> --}}

                                <div class="d-flex mt-2 mt-lg-0">
                                    <div class="me-2 flex-grow-1">
                                        <!-- select option -->
                                        <select class="form-select">
                                            <option selected>Show: 50</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <!-- select option -->
                                        <select class="form-select" id="sort" onchange="sortProductsByPrice()">
                                            <option value="">Sort by: Featured</option>
                                            <option value="desc">Price: Low to High</option>
                                            <option value="asc">Price: High to Low</option>
                                        </select>

                                    </div>

                                </div>

                            </div>
                        </div>
                        
                        
                        <!-- row -->
                        <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2"> 
                                @foreach($prods as $item)
                            <!-- col -->
                                <div class=" filterDiv {{$item->id_type}} col" data-price="{{$item->price}}" >
                                    
                                    <!-- card -->
                                    <div class="card card-product" >
                                        <div class="card-body">
    
                                            <!-- badge -->
                                            <div class="text-center position-relative ">
                                                <div class=" position-absolute top-0 start-0">
                                                    <span class="badge bg-danger">Sale</span>
                                                </div>
                                                <a href="{{ route('products-details') }}">

                                                    <!-- img --><img
                                                    @if (!empty($item->Library) && count($item->Library) > 0)
                                                        src="{{asset('images/products/'.$item->Library[0]->image)}}"
                                                        alt="Grocery Ecommerce Template" class="mb-3 img-fluid">
                                                        @endif
                                                </a>
                                                <!-- action btn -->
                                                <div class="card-product-action">
                                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                                        data-bs-target="#quickViewModal"><i class="bi bi-eye"
                                                            data-bs-toggle="tooltip" data-bs-html="true"
                                                            title="Quick View"></i></a>
                                                    <a href="{{ Route('wishlist') }}" class="btn-action"
                                                        data-bs-toggle="tooltip" data-bs-html="true" title="Wishlist"><i
                                                            class="bi bi-heart"></i></a>
                                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip"
                                                        data-bs-html="true" title="Compare"><i
                                                            class="bi bi-arrow-left-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- heading -->
                                            <div class="text-small mb-1"><a href="#!"
                                                    class="text-decoration-none text-muted"><small>{{ $item->name }}
                                                        </small></a></div>
                                            <h2 class="fs-6"><a href="{{ route('products-details') }}"
                                                    class="text-inherit text-decoration-none">{{ $item->name }}</a></h2>
                                            <div>
                                                <!-- rating -->
                                                <div class=" rate"> 
                                                    <input type="radio" />
                                                    <label  title="text"></label>
                                                    <input type="radio" />
                                                    <label  title="text"></label>
                                                    <input type="radio" />
                                                    <label  title="text"></label>
                                                    <input type="radio"  />
                                                    <label  title="text"></label>
                                                    <input type="radio" />
                                                    <label  title="text"></label>
                                                </div> 
                                                    <span class="text-muted small">4.5(149)</span>
                                            </div>
                                            @php
                                            $totalRating = 0;
                                            if(count($item->Comment)>0){
                                            foreach($item->Comment as $comment) {
                                                $totalRating += $comment->rating;
                                            }
                                            $averageRating = $totalRating / count($item->Comment);
                                            }
                                            @endphp

                                            <input type="hidden" class="rating-value" value="{{ceil($averageRating)}}" />
                                            <!-- price -->
                                            <div class="d-flex justify-content-between align-items-center mt-3">
                                                <div><span class="text-dark">${{ $item->price }}</span> <span
                                                        class="text-decoration-line-through text-muted">${{ $item->price }}</span>
                                                </div>
                                                <!-- btn -->
                                                <div><button data-bs-id="{{$item->id_product}}" type="button" class="btn btn-primary btn addToCart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-plus">
                                                            <line x1="12" y1="5" x2="12"
                                                                y2="19"></line>
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12"></line>
                                                        </svg> Add</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- {{$prods->links('pagination::bootstrap-5') }} --}}
                    </section>
                    {{-- end main --}}

                </div>
            </div>
        </div>
    </main>

    <script>
        //hiển thị số sao từng sản phẩm
        const ratingValues = document.querySelectorAll(".rating-value");
        ratingValues.forEach(function(ratingValue) {
        const ratingInputs = ratingValue.parentNode.querySelectorAll(".rate input");
        const value = Number(ratingValue.value);
        if (value <= 5 && value >= 1) {
            ratingInputs[ratingInputs.length - value].checked = true;
        }

        ratingValue.addEventListener(" input", function() {
            const value = Number(ratingValue.value);
            if (value <= 5 && value >= 1) {
            ratingInputs[ratingInputs.length - value].checked = true;
            }
        });
        });

        //sắp xếp theo giá
        function sortProductsByPrice() {
        const productDivs = document.querySelectorAll('.filterDiv');
        const selectedOption = document.getElementById('sort').value;

        // Tạo một mảng chứa các sản phẩm và giá của chúng
        let products = [];
        for (let i = 0; i < productDivs.length; i++) {
            const productDiv = productDivs[i];
            const price = parseFloat(productDiv.getAttribute('data-price'));
            products.push({ div: productDiv, price: price });
        }

  // Sắp xếp sản phẩm theo giá
  if (selectedOption === 'asc') {
    products.sort(function(a, b) {
      return a.price - b.price;
    });
  } else if (selectedOption === 'desc') {
    products.sort(function(a, b) {
      return b.price - a.price;
    });
  }

  // lọc sản phẩm theo type
        for (let i = 0; i < products.length; i++) {
            const productDiv = products[i].div;
            const productList = productDiv.parentNode;
            productList.insertBefore(productDiv, productList.firstChild);
            }
        }
        filterSelection("all")
        function filterSelection(c) {
          var x, i;
          x = document.getElementsByClassName("filterDiv");
          if (c == "all") c = "";
          for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
          }
        }
        
        function w3AddClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
          }
        }
        
        function w3RemoveClass(element, name) {
          var i, arr1, arr2;
          arr1 = element.className.split(" ");
          arr2 = name.split(" ");
          for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
              arr1.splice(arr1.indexOf(arr2[i]), 1);     
            }
          }
          element.className = arr1.join(" ");
        }
//fiter rate
document.addEventListener("DOMContentLoaded", function(){
    var selectedValues = []; // biến lưu trữ danh sách các giá trị được chọn từ các checkbox

    document.querySelectorAll(".rating-checkbox").forEach(function(checkbox) {
        checkbox.addEventListener("change", function(){
            selectedValues = [];
            document.querySelectorAll(".rating-checkbox:checked").forEach(function(checkedCheckbox){
                selectedValues.push(checkedCheckbox.value);
            });
            filterData();
        });
    });

    function filterData() {
        if (selectedValues.length === 0) {
            document.querySelectorAll(".col").forEach(function(col){
                col.style.display = "block";
            });
        } else {
            document.querySelectorAll(".col").forEach(function(col){
                if (selectedValues.indexOf(col.querySelector(".rating-value").value) !== -1) {
                    col.style.display = "block";
                } else {
                    col.style.display = "none";
                }
            });
        }
     
    }
});

    </script>
@endsection
