@extends('user.partials.master')
@section('content')
    <main>
        <section class="mt-8 mb-14">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-8">
                            <h1 class="mb-1">My Wishlist</h1>
                            <p>There are {{count($favourites)}} products in this wishlist.</p>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <form action="{{route('wishlist')}}" method="post">
                                    @csrf
                                <table class="table text-nowrap table-with-checkbox">
                                    <thead class="table-light">
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll" name="checkAll">
                                                    <label class="form-check-label" for="checkAll">
                                                    </label>
                                                </div>
                                            </th>
                                            <th></th>
                                            <th>Product</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($favourites)==0)
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">There are no Item in favourite</td>
                                            </tr>
                                        @endif
                                        @foreach ($favourites as $fav)
                                            <tr>
                                                <td class="align-middle">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="{{$fav->id_fa}}" id="checkFav" name="checkFav[]">
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{route('products-details',$fav->Product->id_product)}}"> <img src="{{ asset('images/products/'.$fav->Product->Library[0]->image) }}" class="icon-shape icon-xxl" alt=""></a>
                                                </td>
                                                <td class="align-middle">
                                                    <div>
                                                        <h5 class="fs-6 mb-0"><a href="{{route('products-details',$fav->Product->id_product)}}" class="text-inherit">{{$fav->Product->name}}</a></h5>
                                                        <small>unit: gram</small>
                                                    </div>
                                                </td>
                                                <td class="align-middle">${{number_format($fav->Product->sale>0?$fav->Product->price*(1-$fav->Product->sale/100) : $fav->Product->price,2,'.',' ')}}<span class='text-muted text-decoration-line-through ms-3'>{{$fav->Product->sale>0?$fav->Product->price:''}}</span>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($fav->Product->quantity == 0)
                                                        <span class="badge bg-danger">Out of Stock</span>
                                                    @else
                                                        <span class="badge bg-success">In Stock</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle ">
                                                    @if ($fav->Product->quantity>0)
                                                        <div class="btn btn-primary btn-sm"><a  class="addToCart " style="color: #ffffff" data-bs-id="{{$fav->id_product}}" >Add to Cart</a></div>
                                                    @else
                                                        <div class="btn btn-dark btn-sm"><a>Contact us</a></div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <td colspan="5">
                                          <input type="submit" class="btn btn-outline-danger" name="removeFav" value="Remove Selected Pets">
                                        </td>
                                        <td colspan="1">
                                          <input type="submit" class="btn btn-primary" name="addToCart" value="Buy now" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Caution: You need select which Pet you want before go to order side ">
                                        </td>
                                      </tr>
                                    </tfoot>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
