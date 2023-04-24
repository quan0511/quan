<!-- section-->
<div class="mt-4">
    <div class="container">
        <!-- row -->
        <div class="row ">
            <!-- col -->
            <div class="col-12">
                <!-- breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#!">@yield('topic')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('page')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
