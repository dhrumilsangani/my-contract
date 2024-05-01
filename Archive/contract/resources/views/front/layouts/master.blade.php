<!DOCTYPE html>
<html class="no-js" lang="zxx">
    @include('front.layouts.header')
<body>
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    @include('front.layouts.sidebar')
    @yield('content')
    
        @include('front.layouts.footer')
        @include('sweetalert::alert')
        @yield('page_level_css')
       

</body>

</html>
