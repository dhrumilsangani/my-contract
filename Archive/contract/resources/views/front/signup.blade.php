@extends('front/layouts.master')
@section('content')
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Sign Up</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Sign Up</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Account Signup Area -->
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
			<!-- Alert messages code end here -->
                    <form name="sign_up_frm" id="sign_up_frm" class="card login-form inner-content" method="POST" action="{{ route('saveUserData') }}">
                    @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Sign Up Now</h3>
                                <p>Use the form below to create your account.</p>
                            </div>
                            <div class="input-head">
                            <div class="form-group input-group">
                                    <label><i class="lni lni-envelope"></i></label>
                                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
                                </div>
                                <div class="form-group input-group">
                                    <label><i class="lni lni-lock-alt"></i></label>
                                    <input id="password" type="password" placeholder="Password" class="form-control" name="password" required autocomplete="new-password">
                                </div>
                                <div class="form-group input-group">
                                    <label><i class="lni lni-lock-alt"></i></label>
                                    <input id="confirm_password" type="password" placeholder="Confirm password" class="form-control" name="confirm_password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Create Account</button>
                                <a class="btn alt" href="{{ route('loginPage') }}">Sign In Now</a>
                            </div>
                            <!-- <ul class="alt-option">
                                <li><span>Or Signup with</span></li>
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
    <!-- End Account Signup Area -->
    @endsection
