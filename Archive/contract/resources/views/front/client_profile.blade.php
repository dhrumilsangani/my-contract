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
                    @include('message_data')	
                <!-- Alert messages code end here -->
                <form id="edit_profile" name="edit_profile" class="card login-form inner-content" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>Profile</h3><br>
                                <h5>Current Package: <span style="color: #07689f">
                                    @if($currentSub->type)
                                        @if($currentSub->type == 'Yearly')
                                        Premium
                                        @elseif($currentSub->type == 'month')
                                        Exclusive
                                        @elseif($currentSub->type == 'One-Off')
                                        Starter
                                        @endif
                                    @else
                                    N/A
                                    @endif
                                    
                                </span></h5>
                            </div>
                            <div class="input-head">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group input-group">
                                            <label><i class="lni lni-user"></i></label>
                                            <input class="form-control" name="name" type="text" maxlength="25" placeholder="Your name" value="{{ !empty($user['name']) ? $user['name'] : '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group input-group">
                                            <label><i class="lni lni-envelope"></i></label>
                                            <input class="form-control" name="email" type="email" placeholder="Your email" value="{{ !empty($user['email']) ? $user['email'] : '' }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group input-group">
                                    <label></label>
                                    <input class="form-control nolink" name="company_name" type="text" maxlength="25" placeholder="Company name" value="{{ !empty($user['company_name']) ? $user['company_name'] : '' }}" required>
                                </div>

                                <div class="form-group input-group">
                                    <label></label>
                                    <input class="form-control nolink" name="address" maxlength="150" type="Address" placeholder="Address" value="{{ !empty($user['address']) ? $user['address'] : '' }}">
                                </div>

                                <div class="form-group input-group">
                                    <label></label>
                                    <input class="form-control onlynum" name="phone" type="number" placeholder="Phone"  minlength="10" maxlength="15" value="{{ !empty($user['phone']) ? $user['phone'] : '' }}">
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
