@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">View contract</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{url('/front/dashboard')}}">Home</a></li>
                        <li>View contract</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    @include('message_data')
    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://interoperability.blob.core.windows.net/files/MS-DOCX/%5bMS-DOCX%5d-210216.docx' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
                <iframe id="compilePreview" src="{{$doc_url}}" width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->
    <script>
        $( document ).ready(function() {
            document.getElementById('compilePreview').contentWindow.location.reload(true);
        });
        
        </script>
    @endsection    

