@extends('user.partials.master')
@section('content')
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3 " type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>
                    @include('user.partials.About.nav-left')
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-6 p-lg-10">
                            <div class="mb-6">
                                <h2 class="mb-0">Account Setting</h2>
                            </div>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif
                            @if (Session::has('message'))
                                <div class="alert alert-success">{{Session::get('message')}}</div>
                            @endif
                            <div>
                                <h5 class="mb-4">Account details</h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            @if (Auth::user()->avatar)
                                            <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}" alt="" class="img-thumbnail w-50">
                                                
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </div>
                                        <form method="POST" enctype="multipart/form-data" action="{{route('edit_profie')}}">
                                            @csrf
                                            <div class="mb-3">
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" name="changeImg" id="changeImg">
                                                    <label for="changeImg">Change user image</label>
                                                </div>
                                                <input type="file" class="form-control mb-4" name="profie_image" id="profie_image" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="new_name">Name</label>
                                                <input type="text" class="form-control" name="new_name" id="new_name" value="{{Auth::user()->name}}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="new_email">Email</label>
                                                <input type="email" class="form-control" name="new_email" id="new_email" value="{{Auth::user()->email}}">
                                                <span class="text-danger" id="invalidEmail"></span>
                                            </div>
                                            <div class="mb-5">
                                                <label class="form-label" for="new_phone">Phone</label>
                                                <input type="text" class="form-control" name="new_phone" id="new_phone" value="{{Auth::user()->phone}}">
                                                <span id="invalidPhone" class="text-danger"></span>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit" id="changeProfie" disabled>Save Details</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-10">
                            <div class="pe-lg-14">
                                <h5 class="mb-4">Password</h5>
                                <form action="{{route('change_password')}}" class=" row " method="POST">
                                    @csrf
                                    <div class="mb-3 col-12">
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" name="changePass" id="changePass">
                                            <label for="changePass">Change Password</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-5 mx-auto">
                                        <label class="form-label" for="new_password">New Password</label>
                                        <input type="password" class="form-control" name="new_password" id="new_password" placeholder="**********" disabled>
                                        <span id="invalidPass"></span>
                                    </div>
                                    <div class="mb-3 col-5 mx-auto">
                                        <label class="form-label" for="current_password">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" id="current_password" placeholder="**********" disabled>
                                        <span id="checkPass"></span>
                                    </div>
                                    <div class="col-12">
                                        <p class="mb-4">
                                            Can’t remember your current password?<a href="#"> Reset yourpassword.</a></p>
                                        <button type="submit" class="btn btn-primary" id="changePassword" disabled>Save Password</a>
                                    </div>
                                </form>
                            </div>
                            <hr class="my-10">
                            <div>
                                <h5 class="mb-4">Delete Account</h5>
                                <p class="mb-2">Would you like to delete your account?</p>
                                <p class="mb-5">This account contain 12 orders, Deleting your account will remove all the order details associated with it.</p>
                                <a href="#" class="btn btn-outline-danger">I want to delete my account</a>
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
            let valPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
            let valiEmail = /^[a-zA-Z0-9]{4,}@gmail\.com$/;
            let valiPhone = /^[0-9]{9,11}$/;
            if($('input[name=changePass]').is(':checked')){
                $('input[name=new_password]').removeAttr('disabled');
                $('input[name=current_password]').removeAttr('disabled');
            }else{
                $('input[name=new_password]').attr('disabled','disabled');
                $('input[name=current_password]').attr('disabled','disabled');
            }
            $('input[name=changePass]').click(function(){
                if($('input[name=changePass]').is(':checked')){
                    $('input[name=new_password]').removeAttr('disabled');
                    $('input[name=current_password]').removeAttr('disabled');
                }else{
                    $('input[name=new_password]').attr('disabled','disabled');
                    $('input[name=current_password]').attr('disabled','disabled');
                }
            });
            $('input[name="current_password"]').change(function(){
                $.ajax({
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: window.location.origin+'/public/index.php/account/ajax/check-password',
                    data: {'current_password':$(this).val()},
                    success: function (data) {
                        if(data == "Accept"){
                            if($('input[name="current_password"]').hasClass('is-invalid')){
                                $('input[name="current_password"]').removeClass("is-invalid");
                            }
                            $('input[name="current_password"]').addClass('is-valid');
                            if($('#checkPass').hasClass('text-danger')){
                                $('#checkPass').removeClass('text-danger');
                            }
                            $('#checkPass').addClass('text-success');
                            $('#changePassword').removeAttr('disabled');
                        }else{
                            if($('input[name="current_password"]').hasClass('is-valid')){
                                $('input[name="current_password"]').removeClass("is-valid");
                            }
                            $('input[name="current_password"]').addClass('is-invalid');
                            if($('#checkPass').hasClass('text-success')){
                                $('#checkPass').removeClass('text-success');
                            }
                            $('#checkPass').addClass('text-danger');
                            $('#changePassword').attr('disabled','disabled');
                        };
                        $('#checkPass').html(data);
                    }
                });
            })
            $('input[name=new_password]').change(function(){
                if(valPass.test($(this).val().trim())){
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass('is-invalid');
                    };
                    $('#invalidPass').html('');
                    $('#changePassword').removeAttr('disabled');
                }else{
                    $(this).addClass('is-invalid');
                    $('#invalidPass').html('Password must contains at least 1 capital letter, 1 number and min length 8 characters').addClass('text-danger');
                    $('#changePassword').attr('disabled','disabled');
                };
            });
            if($('input[name=changeImg]').is(':checked')){
                $('input[name=profie_image]').removeAttr('disabled');
            }else{
                $('input[name=profie_image]').attr('disabled','disabled');
            }
            $('input[name=changeImg]').click(function(){
                if($('input[name=changeImg]').is(':checked')){
                    $('input[name=profie_image]').removeAttr('disabled');
                }else{
                    $('input[name=profie_image]').attr('disabled','disabled');
                };   
            });
            $('#profie_image').change(function(){
                $('#changeProfie').removeAttr('disabled');
            })
            
            $('#new_name').change(function(){
                if($(this).val().trim().length >0){
                    $('#changeProfie').removeAttr('disabled');
                }else{
                    $(this).val("{{Auth::user()->name}}");
                    $('#changeProfie').attr('disabled','disabled');
                }
            });
            $('#new_phone').change(function(){
                if(valiPhone.test($(this).val().trim())){
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass('is-invalid');
                    }
                    $('#invalidPhone').html('');
                    $('#changeProfie').removeAttr('disabled');
                }else if($(this).val().trim().length ==0){
                    $(this).val("{{Auth::user()->phone}}");
                    $('#changeProfie').attr('disabled','disabled');
                }else{
                    $('#invalidPhone').html('Invalid Phone number');
                    $(this).addClass('is-invalid');
                    $('#changeProfie').attr('disabled','disabled');
                }
            });
            $('#new_email').change(function(){
                if(valiEmail.test($(this).val().trim())){
                    if($(this).hasClass('is-invalid')){
                        $(this).removeClass('is-invalid');
                    };
                    $('#invalidEmail').html('');
                    $('#changeProfie').removeAttr('disabled');
                }else if($(this).val().trim().length ==0){
                    $(this).val("{{Auth::user()->email}}");
                    $('#changeProfie').attr('disabled','disabled');
                    $('#invalidEmail').html('');
                }else{
                    $('#invalidEmail').html('Invalid Email');
                    $('#changeProfie').attr('disabled','disabled');
                    $(this).addClass('is-invalid');
                }
            });
        })
    </script>
@endsection
