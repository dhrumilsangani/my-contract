@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{!empty($page_details->page_title)?ucwords(strip_tags($page_details->page_title)):""}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>{{!empty($page_details->page_title)?ucwords(strip_tags($page_details->page_title)):""}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Blog Singel Area -->
    <section class="section blog-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="single-inner">
                        <div class="post-details">
                            <div class="main-content-head">
                                <div class="meta-information">
                                    <h2 class="post-title">
                                        {{!empty($page_details->page_title)?ucwords(strip_tags($page_details->page_title)):""}}
                                    </h2>
                                </div>
                                <div class="detail-inner">
                                <?php 
                                    if(!empty($page_details->page_content)) echo htmlspecialchars_decode($page_details->page_content); 
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Singel Area -->
    @endsection    