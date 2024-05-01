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
      <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
      <!-- Alert messages code start here -->	
      @include('message_data')	
            <!-- Alert messages code end here -->        
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Contracts</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Contracts</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($contracts))
                @foreach ($contracts as $contract)
                    <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                        <!-- Single Table -->
                        <div class="single-table contract-detail priceTable">
                            <!-- Table Head -->
                            <div class="table-head custom-p">
                                <h4 class="title">{{ $contract->title }}</h4>
                                <?php 
                                    if(!empty($contract->contract_detail)){
                                        $contractDetail= htmlspecialchars_decode($contract->contract_detail); 
                                        echo str_limit($contractDetail);
                                    } 
                                ?>
                                
                            </div>
                            <!-- End Table Head -->
                            <div class="button">
                                <a href="{{ route('contract', $contract->id) }}" class="btn">Create my contract</a>
                            </div>
                            <!-- End Table Content -->
                        </div>
                        <!-- End Single Table-->
                    </div>
                @endforeach
            @else
                <div class="activity-list-item shadow-sm">						
                    <p class="font-weight-bold mb-1 text-center">No record found.</p>
                </div>
            @endif    
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->
@endsection    