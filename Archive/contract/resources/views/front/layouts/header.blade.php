<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Contract') }}</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/images/favicon.svg') }}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('front/css/LineIcons.3.0.css') }}"/>
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/glightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/css/coustom.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/contract.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/sweetalert.css') }}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <?php 
    if (isset($headerCss) && count($headerCss) > 0) {
      foreach ($headerCss as $css) { ?>
        <link href="{{ asset($css) }}" rel="stylesheet" type="text/css" />
        <?php } } ?>


    @yield("css_section")
</head>