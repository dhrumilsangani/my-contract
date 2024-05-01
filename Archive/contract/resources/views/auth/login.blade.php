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
                        <li><a href="index.html">Home</a></li>
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
                    <form class="card login-form inner-content" method="POST" action="{{ route('front/login') }}">
                        <div class="card-body">
                            <div class="title">
                                <h3>Sign In Now</h3>
                                <p>Sign in by entering the information below.</p>
                            </div>
                            <div class="input-head">
                                <div class="form-group input-group">
                                    <label><i class="lni lni-envelope"></i></label>
                                    <input class="form-control" type="email" id="reg-email"
                                        placeholder="Enter your email" required>
                                </div>
                                <div class="form-group input-group">
                                    <label><i class="lni lni-lock-alt"></i></label>
                                    <input class="form-control" type="password" id="reg-pass"
                                        placeholder="Enter your password" required>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                <a class="lost-pass" href="reset-password.html">Forgot password?</a>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Sign In</button>
                                <a class="btn alt" href="signup.html">Create Account</a>
                            </div>
                            <ul class="alt-option">
                                <li><span>Or Sign In with</span></li>
                                <li><a href="javascript:void(0)">Facebook</a></li>
                                <li><a href="javascript:void(0)">Twitter</a></li>
                                <li><a href="javascript:void(0)">Google</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Sign In Area -->
@endsection
