@extends('admin.partials.master')
@section('admin-content')
    <main>
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Products</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="" class="btn btn-primary">Add Product</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <div class="px-6 py-6 ">
                            <div class="row justify-content-between">
                                <!-- form -->
                                <div class="col-lg-4 col-md-6 col-12 mb-2 mb-lg-0">
                                    <form class="d-flex" role="search">
                                        <input class="form-control" type="search" placeholder="Search Products"
                                            aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- card body -->
                        <div class="card-body p-0">
                            <!-- table -->
                            <div class="table-responsive">
                                <table
                                    class="table table-centered table-hover text-nowrap table-borderless mb-0 table-with-checkbox">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="checkAll">
                                                    <label class="form-check-label" for="checkAll">

                                                    </label>
                                                </div>
                                            </th>
                                            <th>Image</th>
                                            <th>Proudct Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Price</th>
                                            <th>Create at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prods as $item)
                                            <tr>
                                                <td>{{ $item->id_product }}</td>
                                                <td>
                                                    @foreach ($item->libraries as $library)
                                                        <img src="{{ asset('images/products/' . $library->image) }}"
                                                            alt="" style="width:70px; height:auto;">
                                                    @endforeach
                                                </td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->id_type }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            {{-- <i class="fa-solid fa-ellipsis-vertical fs-5"></i> --}}
                                                            <i class="fa-solid fa-ellipsis-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="bi bi-trash me-3"></i>Delete</a></li>
                                                            <li><a class="dropdown-item" href="#"><i
                                                                        class="bi bi-pencil-square me-3 "></i>Edit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $prods->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection
