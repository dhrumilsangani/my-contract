<header class="header navbar-area others-pages">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                        <?php if(isset(Auth::user()->role_id) && Auth::user()->role_id == 2){
                                $url = url('/front/dashboard');
                            }else{
                                $url = route('home');
                            }?>
                            <a class="navbar-brand" href="{{$url}}">
                                <img src="{{ asset('front/images/logo/Logo.png') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            @if(isset(Auth::user()->role_id) && Auth::user()->role_id == 2)
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed {{ request()->is('front/dashboard*') ? 'active' : '' }}" href="{{url('/front/dashboard')}}">Dashboard</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="dd-menu collapsed {{ request()->is('front/contract-list*') ? 'active' : '' }}" href="{{url('front/contract-list')}}">Contract</a>
                                    </li> -->
                                    <li class="nav-item">
                                        <a class="{{ request()->is('front/manage_document*') ? 'active' : '' }}" href="{{url('/front/manage_document')}}" aria-label="Toggle navigation">Manage document</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ request()->is('pricing*') ? 'active' : '' }}" href="{{url('/pricing')}}" aria-label="Toggle navigation">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="{{ request()->is('front/user_contract_list*') ? 'active' : '' }}" href="{{url('/front/user_contract_list')}}" aria-label="Toggle navigation">My contracts</a>
                                    </li>
                                </ul>
                                <div class="button">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed {{ request()->is('front/profile*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse"
                                            data-bs-target="#submenu-1-1" aria-controls="navbarSupportedContent"
                                            aria-expanded="false" aria-label="Toggle navigation">{{getUserInfo(Auth::user()->id)->email}}</a>
                                        <ul class="sub-menu collapse" id="submenu-1-1">
                                            <li class="nav-item"><a href="{{url('front/profile')}}">Profile</a></li>
                                            <li class="nav-item"><a href="{{ route('clientChangePassword') }}">Change Password</a></li>
                                            <li class="nav-item"><a href="{{url('front/logout')}}">Logout</a></li>
                                            <!-- <li class="nav-item"><a href="{{url('/front/profile/'.Auth::user()->id)}}">Profile</a></li> -->
                                            
                                            
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            </div> <!-- navbar collapse -->
                            
                            @else
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed {{ request()->is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dd-menu collapsed {{ request()->is('about-us*') ? 'active' : '' }}" href="{{url('/about-us')}}">About Us</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('/pricing')}}" class=" {{ request()->is('pricing*') ? 'active' : '' }}" aria-label="Toggle navigation">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('/contact-us')}}" class="{{ request()->is('contact-us*') ? 'active' : '' }}" aria-label="Toggle navigation">Contact</a>
                                    </li>
                                </ul>
                                <div class="button">
                                <a href="{{ route('loginPage') }}" class="signin">Sign In</a>
                                <a href="{{ route('frontSignup') }}" class="signup">Sign Up</a>
                            </div>
                            </div> <!-- navbar collapse -->
                           
                            @endif
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>