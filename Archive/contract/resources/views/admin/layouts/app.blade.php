<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{{ asset('admin/images/favicon.png') }}}}">
    <title>{{ config('app.name', 'Contract') }}</title>
    @yield("css_section")
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }} ">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/dataTables.bootstrap4.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/coustom.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
    <link rel="stylesheet" href="{{ asset('front/css/sweetalert.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <?php 
    if (isset($headerCss) && count($headerCss) > 0) {
      foreach ($headerCss as $css) { ?>
        <link href="{{ asset($css) }}" rel="stylesheet" type="text/css" />
        <?php } } ?>
  @stack('style') 
  </head>

<body class="vertical  light">
    <div class="wrapper">

    <!--header--->
    @include('admin.include.header')
    <!--end--header-->

    <!--header--->
    @include('admin.include.sidebar')
    <!--end--header-->
    <!-- help panel end -->
    <!-- Content Wrapper. Contains page content -->
    <main role="main" class="main-content">
            @yield('content')
    </main>
</div>

<!-- ./wrapper -->
<script src="{{ asset('admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }} "></script>
<script src="{{ asset('admin/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/simplebar.min.js') }} "></script>
<script src="{{ asset('admin/js/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/js/jquery.stickOnScroll.js') }}"></script>
<script src="{{ asset('admin/js/tinycolor-min.js') }}"></script>
<script src="{{ asset('admin/js/config.js') }}"></script>
<script src="{{ asset('admin/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script src="{{ asset('front/js/sweetalert.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script src="{{ asset('front/js/my-custom.js') }}"></script>
<script type="text/javascript">
        var baseurl = <?php echo "'".url('/')."';"; ?>;
        var csrf_token = <?php echo "'".csrf_token()."';"; ?>
</script>
<?php
/*
  @Author : Ritesh Rana
  @Desc   : Used for the custom js initilization just pass array of the scripts with links
  @Input  :
  @Output :
  @Date   : 15/05/2021
 */
if (isset($footerJs) && count($footerJs) > 0) {
foreach ($footerJs as $js) { ?>
<script src="{{ asset($js) }}" ></script>
<?php }} ?>
<script>
  var backendUrl = "{{url('/')}}"
      /* $('#dataTable-1').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [16, 32, 64, -1],
          [16, 32, 64, "All"]
        ]
      }); */
    </script>
    <script src="{{ asset('admin/js/apps.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
     @include('sweetalert::alert')
@stack('script')
@yield("js_section")
</body>

</html>
