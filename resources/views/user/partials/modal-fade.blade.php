<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body p-8">
          <div class="position-absolute top-0 end-0 me-3 mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="slide_wrapper">
                <div class="slider_modalproduct product" id="productModal">
                </div>
              </div>
              <div class="product-tools">
                <div class="thumbnails slider_modalnav row g-3" id="productModalThumbnails">                  
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="ps-lg-8 mt-6 mt-lg-0">
                <p class="mb-4 d-block text-primary text-uppercase typeModal"></p>
                <h2 class="mb-1 h1 text-capitalize" id="productNameModal"></h2>
                <div class="mb-4 text-warning" id="ratingModal">
                  <a href="#" class="ms-2" id="soldModal"></a>
                </div>
                <h5 class="text-danger" id="priceAFSModal"></h5>
                <div class="hasSale">
                  <span class="text-decoration-line-through text-muted" id="priceModal"></span>
                  <span><small class="fs-6 ms-2 text-danger" id="saleModal"></small></span>
                </div>
                <hr class="my-6">
                <div class="mb-4">
                  <h5>Left: <span id="quantityModal" ></span></h5>
                  <button type="button" class="btn btn-outline-secondary" id="weigthModal">
                  </button> 
                </div>
                <form action="{{route('products-details')}}" method="post" class="row">
                  @csrf
                  <input type="hidden" name="id_pro">
                  <input type="hidden" name="max_quan" >
                <div>
                  <div class="input-group input-spinner ">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius: 10px 0 0 10px;"  data-field="quantity" id="btn_minus">
                      <i class="bi bi-dash-lg"></i>
                    </button>
                    <input type="text" name="quan" class="border border-secondary text-center pt-1 fs-4 text-secondary" style="width: 50px;" value="100"/>
                    <button type="button" class="btn btn-outline-secondary" style="border-radius: 0 10px 10px 0;" id="btn_plus" >
                      <i class="bi bi-plus-lg"></i>
                    </button>
                    <p class="ms-5 fw-bold align-self-end mb-1">g</p>
                  </div>
                </div>
                <div class="mt-3 row justify-content-start g-2 align-items-center">
  
                  <div class="col-lg-4 col-md-5 col-6 d-grid">
                    <button type="submit" class="btn btn-primary">
                      <i class="feather-icon icon-shopping-bag me-2"></i>Add to cart
                    </button>
                  </div>
                  <div class="col-md-4 col-5">
                    <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true" aria-label="Compare">
                      <i class="bi bi-arrow-left-right"></i>
                    </a>
                    <a class="btn btn-light {{Auth::check()? 'addFav':''}}" id="modal_Fav"
                    {{!Auth::check() ?'data-bs-toggle=modal data-bs-target=#userModal href=#!': "data-bs-toggle=tooltip data-bs-html=true title=Wishlist data-bs-idproduct="}}></a>
                  </div>
                </div>
                </form>
                <hr class="my-6">
                <div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td>Product Code:</td>
                        <td id="idModal">FBB00255</td>
                      </tr>
                      <tr>
                        <td>Availability:</td>
                        <td>In Stock</td>
                      </tr>
                      <tr>
                        <td>Type:</td>
                        <td class="typeModal">Fruits</td>
                      </tr>
                      <tr>
                        <td>Shipping:</td>
                        <td>
                          <small>01 day shipping.<span class="text-muted">( Free pickup today)</span></small>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="toast-container position-fixed h-100 p-3 top-100 start-50 translate-middle">
    <div role="alert"  id="toastAdd" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="true" data-bs-delay='1500'>
        <div class="toast-body" style=" padding:10px">
          <div class="row">
            <div class="col-2 mb-2 mx-auto">
              <i class="bi bi-bag-check" style="color: #2ec27e; font-size: 2.3rem"></i>
            </div>
            <h4 class="text-center text-uppercase" style="font-family: 'Quicksand', sans-serif;">Add to cart successully</h4>
          </div>
        </div>
    </div>
  </div>
    <div class="toast-container position-fixed h-100 p-3 top-100 start-50 translate-middle">
      <div role="alert"  id="toastCompare" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="true" data-bs-delay='1500'>
          <div class="toast-body" style="padding:10px">
            <div class="row">
              <div class="col-2 mb-2 mx-auto">
                <i class="bi bi-lightbulb " style="color: #f5c211; font-size: 1.3rem"></i>
              </div>
              <h4 class="text-center text-uppercase" style="font-family: 'Quicksand', sans-serif;" id="messCompare"></h4>
            </div>
          </div>
      </div>
    </div>  
  <div data-bs-toggle="tooltip"  title="Show Compare" class="position-fixed rounded-circle bottom-0 start-0 p-3 animate__animated animate__heartBeat animate__infinite {{!Session::has('compare')?'d-none':''}}" id="btn-compare">
    <button role="button" class="btn btn-primary shadow" id="show_compare" data-bs-toggle="modal" data-bs-target="#compareProduct">
      <i class="bi bi-arrow-left-right"></i>
    </button>
  </div>
  <div class="modal fade" id="compareProduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable ">
      <div class="modal-content">
        <div class="modal-header">
          <a class="btn btn-outline-danger" href="{{route('removeCmp')}}">
            <i class="bi bi-x-circle-fill text-danger"></i>
            Clean
          </a>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-8">
          <div class="row">
            <table class="table table-hover">
              <tbody id="compare_detail">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="toast-container position-fixed h-100 p-3 top-100 start-50 translate-middle">
    <div role="alert"  id="toastAdd" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="true" data-bs-delay='1500'>
        <div class="toast-body" style="height: 100px; padding:30px 0">
          <div class="row">
            <div class="col-2 mb-3 mx-auto">
              <i class="fa-solid fa-cart-circle-check" style="color: #2ec27e; font-size: 2.3rem"></i>
            </div>
            <h4 class="text-center text-uppercase" style="font-family: 'Quicksand', sans-serif;" id="messCompare">Add pet to cart successully</h4>
          </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="editOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
      <div class="modal-content" style="overflow: scroll">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Edit Order</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('user_editorder')}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 row mt-3">
                        <input type="hidden" name="id_orderedit" id="id_orderedit">
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-md-3 col-form-label" for="edit_cusname">Reciver Name</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="edit_cusname" id="edit_cusname" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class=" col-lg-4 col-md-3 col-form-label" for="edit_cusaddr">Address</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="edit_cusaddr" id="edit_cusaddr" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-lg-4 col-md-3 col-form-label" for="edit_cusphone">Phone</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="text" name="edit_cusphone" id="edit_cusphone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class=" col-lg-4 col-md-3 col-form-label" for="edit_cusemail">Email</label>
                            <div class="col-lg-8 col-md-9">
                                <input type="email" name="edit_email" id="edit_cusemail" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="edit_coupon" class="col-form-label col-lg-4 col-md-3">Coupon</label>
                            <div class="col-lg-8 col-md-9">
                                <p id="name_coupon"></p>
                                <input type="text" class="form-control" name="edit_coupon" id="edit_coupon" disabled >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="submit_order" class="btn btn-primary" disabled>Change</button>
            </div>
        </form>
      </div>
    </div>
</div>
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- modal body -->
      <div class="modal-body p-6">
          <div class="d-flex justify-content-between mb-5">
            <!-- heading -->
            <div>
              <h5 class="h6 mb-1" id="addAddressModalLabel">New Shipping Address</h5>
              <p class="small mb-0">Add new shipping address for your order delivery.</p>
            </div>
            <div>
              <!-- button -->
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          </div>
          <form action="{{route('post_address')}}" method="post">
            @csrf
            <div class="row g-3">
              <input type="hidden" name="shipment_fee" id="shipment_fee" value="2">
              <div class="col-12">
                <input type="text" class="form-control" name="nameReciever" placeholder="Reciever name"  required="">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" name="phoneReciever" placeholder="Phone number"  required="">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" name="emailReciever" placeholder="Email">
              </div>
              <div class="col-12">
                <input type="text" class="form-control" name="addressReciever" placeholder="Address">
              </div>
              <div class="col-12">
                <select class="form-select" id="province" name="province">
                </select>
              </div>
              <div class="col-12">
                <select class="form-select" id="district" name="district" disabled>
                </select>
              </div>
              <div class="col-12">
                <select class="form-select" id="ward" name="ward" disabled>
                </select>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="saveAddress" id="saveAddress"> 
                  <label class="form-check-label" for="saveAddress">
                    Set as Default
                  </label>
                </div>
              </div>
              <div class="col-12 text-end">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" id="sendAddress" disabled >Save Address</button>
              </div>
            </div>
          </form>
      </div>

    </div>
  </div>
</div>