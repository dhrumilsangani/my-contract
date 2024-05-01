@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Our Pricing</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Our Pricing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    @include('message_data')
    <!-- Start Pricing Table Area -->
    <section id="pricing" class="pricing-table style2 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">pricing</h3>
                        <?php $pricing_plans = getContent(PRICING_PLANS);?>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ !empty($pricing_plans->title) ? $pricing_plans->title : '' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"><?php if(!empty($pricing_plans->content)) echo htmlspecialchars_decode($pricing_plans->content); ?></p>                            
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($product))
                @foreach ($product as $products)
                <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                    <!-- Single Table -->
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">{{$products->title}}</h4>
                            <div class="price">
                                <h2 class="amount"><span class="currency">€</span>{{$products->price}}<span class="duration">/{{$products->type}}</span></h2>
                            </div>
                            {!! $products->price_features !!}
                        </div>
                        <!-- End Table Head -->
                        <div class="button">
                        <?php 
                            // $productId = enCodeVal($products->id); 
                            // $userId = enCodeVal($user->id); 

                            $productId = $products->id; 
                            $userId = enCodeVal($user->id); 
                        ?>
                            <input type="hidden" name="tem_user_id" id="tem_user_id" value="{{$userId}}">                        
                            <a href="javascript:" class="btn checkout-button"  product_id="{{$products->id}}">Pay Now <i class="lni lni-arrow-right"></i></a>
                        </div>
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
    @php
        $stripe_key = config('services.strip.key'); 
    @endphp
    @endsection    

    @section('js_section')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var key = "{{$stripe_key}}";
        var stripe = Stripe(key);
    </script>
@endsection