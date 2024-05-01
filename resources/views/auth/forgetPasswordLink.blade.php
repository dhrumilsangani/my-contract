@extends('front/layouts.master')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Reset Password</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Reset Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Account Sign In Area -->
    <div class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form name="reset_frm" id="reset_frm" class="card login-form inner-content" method="POST" action="{{ route('reset.password.post') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="card-body">
                            <div class="title">
                                <h3>{{ __('Reset Password') }}</h3>
                            </div>
                            <div class="contact-form">
                                <div class="form-group input-group mt-4">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group input-group mt-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="button">
                                <button type="submit" class="btn">{{ __('Reset Password') }}</button>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js_section')
<script>
$(document).ready(function(){
    $("#reset_frm").validate({
    ignore: [],
      rules: {
        email: {
          required: true,
          minlength: 8,
          email: true
        },
        password: {
					required: true,
					minlength : 8,
				},
				password_confirmation: {
					required: true,
					minlength : 8,
					equalTo : '#password'
				}      
    },
      messages: {
       password: {
        required:	"Please enter password.",
        minlength:	"password minimum legnth should be 8 character.",
      },
      password_confirmation: {
        required:	"Please enter confirm password.",
        minlength:	"confirm password minimum legnth should be 8 character.",
        equalTo: "Your password and confirm password does not match."
      },

       email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
       },
      },
    
    });
  });
</script>
@endsection
