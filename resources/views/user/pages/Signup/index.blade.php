@extends('user.partials.master')
@section('content')
<main>
    @if ($site == "Signin")
    <section class="my-lg-14 my-8">
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
              <img src="{{asset('images/svg-graphics/signin.svg')}}" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
              <div class="mb-lg-9 mb-5">
                <h1 class="mb-1 h2 fw-bold">Sign in to FreshCart</h1>
                <p>Welcome back to FreshCart! Enter your email to get started.</p>
              </div>
              <form action="{{route('signin')}}" method="POST">
                @csrf
                <div class="row g-3">
                  <div class="col-12">
                    <input type="email" class="form-control" name="email" id="inputEmail4" placeholder="Email" required>
                  </div>
                  <div class="col-12">
                    <div class="password-field position-relative">
                      <input type="password" id="fakePassword" name="password" placeholder="Enter Password" class="form-control" required >
                      <span><i id="passwordToggler"class="bi bi-eye-slash"></i></span>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        Remember me
                      </label>
                    </div>
                    <div> Forgot password? <a href="../pages/forgot-password.html">Reset It</a></div>
                  </div>
                  <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Sign In</button>
                  </div>
                  <div>Don’t have an account? <a href="{{route('signup')}}"> Sign Up</a></div>
                </div>
              </form>
              <div class="mt-4 mb-2">
                <a class="h4 fw-normal text-decoration-none text-center" href="{{route('google-auth')}}" style="vertical-align: middle;font-family: 'Montserrat', sans-serif;">
                  <svg xmlns="http://www.w3.org/2000/svg" class="me-1" height="30" viewBox="0 0 24 24" width="30">
                      <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/><path d="M1 1h22v22H1z" fill="none"/>
                  </svg>
                  Sign in with Google
              </a>
              </div>
            </div>
          </div>
        </div>
      </section>
    @else
    <section class="my-lg-14 my-8">
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
              <img src="{{asset('images/svg-graphics/signup.svg')}}" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
              <div class="mb-lg-9 mb-5">
                <h1 class="mb-1 h2 fw-bold">Get Start Shopping</h1>
                <p>Welcome to FreshCart! Enter your email to get started.</p>
              </div>
              <form class="{{route('signup')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Full name" aria-label="Full name" name="register_name" required>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control" placeholder="Phone number" aria-label="Phone number" name="register_phone" required>
                    <span id="register_phone" class="text-danger"></span>
                  </div>
                  <div class="col-12">
                    <input type="email" class="form-control" id="inputEmail4" name="register_email" placeholder="Email" required>
                    <span id="register_email" class="text-danger"></span>
                  </div>
                  <div class="col-12">
                    <div class="password-field position-relative">
                      <input type="password" id="fakePassword" placeholder="Enter Password" class="form-control" name="register_password" required >
                      <span><i id="passwordToggler"class="bi bi-eye-slash"></i></span>
                    </div>
                    <span id="register_password" class="text-danger">
                    </span>
                  </div>
                  <div class="col-12">
                    <label for="register_avatar" class="form-label">Add Avatar</label>
                    <input type="file" class="form-control" name="register_avatar" id="register_avatar" >
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="accepted" id="accepted">
                    <label class="form-check-label" for="accepted">By continuing, you agree to our 
                      <a href="#!"> Terms of Service</a> & 
                      <a href="#!">Privacy Policy</a></label>
                  </div>
                  <div class="col-12 d-grid"> 
                    <button type="submit" class="btn btn-primary" id="register_submit" disabled>Register</button>
                  </div>
                </div>
              </form>
              <div class="mt-4 mb-2">
                <a class="h4 fw-normal text-decoration-none text-center" href="{{route('google-auth')}}" style="vertical-align: middle;font-family: 'Montserrat', sans-serif;">
                  <svg xmlns="http://www.w3.org/2000/svg" class="me-1" height="30" viewBox="0 0 24 24" width="30">
                      <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/><path d="M1 1h22v22H1z" fill="none"/>
                  </svg>
                  Sign in with Google
              </a>
              </div>
            </div>
          </div>
        </div>
    
    
      </section>
    
    @endif

</main>

@endsection
@section('script')
<script>
  $(document).ready(function(){
    let valPass = /^(?=.*\d)(?=.*[a-z]).{8,}$/;
    let valiPhone = /^[0-9]{9,11}$/;
    let valiEmail = /^[a-z0-9](\.?[a-z0-9]){5,}@gmail\.com$/;
    if($('input[name=register_email]').val().length > 0 &&!valiEmail.test($('input[name=register_email]').val())){
      $('#register_email').text("Invaild Email. Try again");
      $('#register_submit').attr('disabled','disabled');
      if($('input[name=register_email]').hasClass('is-valid')){
        $('input[name=register_email]').removeClass('is-valid');
      }
      $('input[name=register_email]').addClass('is-invalid');      
    }else{
      $.get(window.location.origin + '/public/index.php/ajax/check-email/'+$('input[name=register_email]').val(), function(data){
        if(data == "existed"){
          $('input[name=register_email]').addClass('is-invalid');
          $('#register_email').text('This email has signed. Choose another one or signin');
        }else{
          if($('input[name=register_email]').hasClass('is-invalid')){
            $('input[name=register_email]').removeClass('is-invalid');
          }
          $('input[name=register_email]').addClass('is-valid');
          $('#register_email').text('');
        }
      });
    };
    if($('input[name=register_phone]').val().length > 0 && !valiPhone.test($('input[name=register_phone]').val())){
        $('#register_phone').text("Invaild Phone. Try again");
        $('#register_submit').attr('disabled','disabled');
        if($('input[name=register_phone]').hasClass('is-valid')){
          $('input[name=register_phone]').removeClass('is-valid');
        }
        $('input[name=register_phone]').addClass('is-invalid');      
    }else{
        if($('input[name=register_phone]').hasClass("is-invalid")){
          $('input[name=register_phone]').removeClass('is-invalid');
        }
        $('input[name=register_phone]').addClass('is-valid');
        $('#register_phone').text('');
    };
    if($('input[name=register_password]').val().length > 0 && !valPass.test($('input[name=register_password]').val())){
        $('#register_password').text("Password is invalid. >= 8 characters, at least 1 normal, at least 1 number)");
        $('#register_submit').attr('disabled','disabled');
    }else{
        $('#register_password').text('');
    };
  })
</script>
@endsection