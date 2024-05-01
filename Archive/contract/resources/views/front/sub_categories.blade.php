@extends('front/layouts.master')
@section('content')
<!-- Start Hero Area -->
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Contracts</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{url('/front/dashboard')}}">Dashboard</a></li>
                        <li>Contracts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
      <!-- Start Pricing Table Area -->
         <!-- Start Head Area -->
    <section class="header-area">
        <div class="container">
            <h3 class="text-center">{{$ContractCategories->categories_name}}</h3>
            <div class="list-items col-lg-10 mx-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-list">
                            <div class="list-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="54" viewBox="0 0 60 54">
                                    <g id="monitor" transform="translate(0 -25)">
                                        <path id="Path_1" data-name="Path 1" d="M56.484,25H3.516A3.515,3.515,0,0,0,0,28.506V63.338a3.515,3.515,0,0,0,3.516,3.506H20.742v8.649H11.25a1.753,1.753,0,1,0,0,3.506h37.5a1.753,1.753,0,1,0,0-3.506H39.258V66.844H56.484A3.515,3.515,0,0,0,60,63.338V28.506A3.515,3.515,0,0,0,56.484,25ZM35.742,75.494H24.258V66.844H35.742ZM56.484,63.338H3.516V28.506H56.484C56.487,64.094,56.5,63.338,56.484,63.338Z" fill="#07689f"/>
                                    </g>
                                </svg>                                  
                            </div>
                            <h4>Answer a few simple questions</h4>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-list">
                            <div class="list-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="41.414" height="54" viewBox="0 0 41.414 54">
                                    <g id="document" transform="translate(-59.667)">
                                      <path id="Path_2" data-name="Path 2" d="M91.56,0H59.667V54h41.414V9.467Zm-.608,3.857,6.091,6.057H90.952Zm6.965,46.979H62.831V3.164H87.788v9.914H97.917V50.836Z" transform="translate(0)" fill="#07689f"/>
                                      <path id="Path_4" data-name="Path 4" d="M145.7,297h23.265v3.164H145.7Z" transform="translate(-76.963 -263.324)" fill="#07689f"/>
                                      <path id="Path_5" data-name="Path 5" d="M145.7,218h23.265v3.164H145.7Z" transform="translate(-76.963 -192.656)" fill="#07689f"/>
                                      <path id="Path_6" data-name="Path 6" d="M145.7,139h11.633v3.164H145.7Z" transform="translate(-76.963 -121.988)" fill="#07689f"/>
                                    </g>
                                </svg>                                                                  
                            </div>
                            <h4>Print and download instantly</h4>
                        </div> 
                    </div>

                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="single-list">
                            <div class="list-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53">
                                    <g id="_45-gauge_-dashboard_-meter_-pressure_-speed_-speedometer_-traffic" data-name="45-gauge,-dashboard,-meter,-pressure,-speed,-speedometer,-traffic" transform="translate(-5 -5)">
                                      <path id="Shape" d="M31.5,5A26.5,26.5,0,1,1,5,31.5,26.5,26.5,0,0,1,31.5,5Zm0,2.789A23.711,23.711,0,1,0,55.211,31.5,23.711,23.711,0,0,0,31.5,7.789Zm14.934,8.777a1.388,1.388,0,0,1,0,1.972L36.306,28.666a5.577,5.577,0,1,1-1.972-1.972L44.461,16.566a1.4,1.4,0,0,1,1.972,0ZM31.5,28.711A2.789,2.789,0,1,0,34.289,31.5,2.789,2.789,0,0,0,31.5,28.711Zm16.482-4.775A18.068,18.068,0,0,1,49.632,31.5a1.395,1.395,0,1,1-2.789,0,15.279,15.279,0,0,0-1.394-6.4,1.395,1.395,0,0,1,2.535-1.165ZM31.5,13.368a18.067,18.067,0,0,1,7.63,1.679,1.395,1.395,0,1,1-1.175,2.53A15.35,15.35,0,0,0,16.158,31.5a1.395,1.395,0,1,1-2.789,0A18.132,18.132,0,0,1,31.5,13.368Z" transform="translate(0 0)" fill="#07689f"/>
                                    </g>
                                </svg>                                                                    
                            </div>
                            <h4>It takes just 5 minutes</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Head Area -->

    <!-- Start Document Area -->
    <section class="documents-area">
        <div class="container">
            <!-- <div class="main-title">
                <h3>{{$ContractCategories->categories_name}}</h3>
            </div> -->
            <div class="col-12 mb-5 box-item">
            @if(!empty($subCategories))
                <div class="row g-0">    
                    <?php $i = 1;?>
                @foreach ($subCategories as $subCategorie)        
                    <a href="{{ route('contract.type', $subCategorie->id) }}" class="subCat">
                        <label class="btn btn-outline-secondary form-check-label <?php if($i==1){echo "active";}?>">
                            {{$subCategorie->sub_categories_name}}
                        </label>
                    </a>
                    <?php $i++;?>
                    @endforeach
                </div>
            @else
                <div class="activity-list-item shadow-sm">						
                    <p class="font-weight-bold mb-1 text-center">No record found.</p>
                </div>
            @endif   
            </div>

            
        </div>
    </section>
    <!-- End Document Area -->
    <!--/ End Pricing Table Area -->
@endsection    