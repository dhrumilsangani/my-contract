@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Sign In</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Sign In</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Account Sign In Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <!-- Alert messages code start here -->		
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4 alertmsg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
                            <i data-feather="alert-circle"></i> <strong>Error! </strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->get('success'))          
                        <div class="alert alert-success mb-4 alertmsg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
                            <i data-feather="check"></i> <strong>Success! </strong> {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->get('error'))            
                        <div class="alert alert-danger mb-4 alertmsg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
                            <i data-feather="alert-circle"></i> <strong>Error! </strong>{{ session()->get('error') }}
                        </div>
                    @endif

                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
			<!-- Alert messages code end here -->
                    <form class="card login-form inner-content" name="signin_frm" id="signin_frm" method="POST" action="{{ route('front/login') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Sign In Now</h3>
                                <p>Sign in by entering the information below.</p>
                            </div>
                            <div class="input-head">
                                <div class="form-group input-group">
                                    <label><i class="lni lni-envelope"></i></label>
                                    <input id="email" type="email" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <label><i class="lni lni-lock-alt"></i></label>
                                        <input id="password" type="password" placeholder="Enter your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input class="form-check-input width-auto" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <!-- <a class="lost-pass" href="{{ route('password.request') }}"> -->
                                    <a class="lost-pass" href="{{ route('forget.password.get') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="button">
                                <button type="submit" class="btn">
                                    {{ __('Login') }}
                                </button>
                                <a class="btn alt" href="{{ route('frontSignup') }}">Create Account</a>
                            </div>
                            <!-- <ul class="alt-option">
                                <li><span>Or Sign In with</span></li>
                                <li><a href="javascript:void(0)">Facebook</a></li>
                                <li><a href="javascript:void(0)">Twitter</a></li>
                                <li><a href="javascript:void(0)">Google</a></li>
                            </ul> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Sign In Area -->
    @endsection    