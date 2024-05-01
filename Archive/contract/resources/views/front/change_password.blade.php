@extends('front/layouts.master')

@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Profile</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Profile</li>
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
                <div class="col-md-12 col-lg-8 mx-auto">
                <!-- Alert messages code start here -->	
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                <!-- Alert messages code end here -->
                <form class="card login-form inner-content" novalidate id="change_password" name="change_password" action="{{ route('client-update-password') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Change Password</h3>
                            </div>
                            <div class="input-head">
                                <div class="form-group input-group">
                                    <label></label>
                                    <input name="old_password" type="password" maxlength="25" class="form-control nolink @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old password">
                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="form-group input-group">
                                    <label></label>
                                    <input name="new_password" type="password" maxlength="25" class="form-control nolink @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>

                                <div class="form-group input-group">
                                    <label></label>
                                    <input name="new_password_confirmation" maxlength="25" type="password" class="form-control nolink" id="confirmNewPasswordInput"
                                    placeholder="Confirm new password">
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Signup Area -->

   

@endsection
