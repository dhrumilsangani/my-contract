@extends('front/layouts.master')
@section('content')
<!-- Start Hero Area -->
<section class="hero-area style2">
        <div class="main__circle"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 col-12">
                <div class="hero-content">
                        <?php $banner = getContent(BANNER_CONTENT);?>
                        <h1><span class="wow fadeInUp" data-wow-delay=".4s">{{ !empty($banner->title) ? $banner->title : '' }}</span>
                        </h1>
                        <p><?php if(!empty($banner->content)) echo htmlspecialchars_decode($banner->content); ?></p>
                        <div class="button">
                            <a href="{{url('/pricing')}}" class="btn ">Get started</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <div class="hero-image">
                        <img src="{{ asset('front/images/placeholder.svg') }}" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Services Area -->
    <section class="services style2 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="section-title">
                    <?php $contract_library = getContent(OUR_CONTRACT_LIBRARY);?>

                        <h3 class="wow zoomIn" data-wow-delay=".2s">Services</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ !empty($contract_library->title) ? $contract_library->title : '' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"><?php if(!empty($contract_library->content)) echo htmlspecialchars_decode($contract_library->content); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                 @if(!empty($categories))
                 @foreach ($categories as $categorie)
                 <div class="col-lg-4 col-md-6 col-12  wow fadeInUp" data-wow-delay=".4s">
                 <a href="{{ route('contract.subCategorieTypeData', $categorie->id) }}" class="subCat">
                    <div class="single-service">
                    <div class="service-info">
                    <?php
                        $image = $categorie->image;
                        if(empty($image)){
                            $doc = "";
                        }
                        else
                        {
                            $imagePath = public_path(CATEGORIE_IMAGE.$image);
                            $image_url		=	asset(CATEGORIE_IMAGE.$image);
                            if (file_exists($imagePath)) {
                                $doc = $image_url;
                            }else{
                                $doc = "";
                            }
                        }
                    ?>
                    <div class="service-icon">
                        <img src="{{ $doc }}" alt="..." class="img-fluid">
                    </div>
                        <h3>{{$categorie->categories_name}}</h3>
                    </div>
                        <!-- @if($categorie['subCategories'])
                            @foreach ($categorie['subCategories'] as $subCategorie)
                                <p><a href="{{ route('contract.type', $subCategorie->id) }}" class="subCat">{{$subCategorie->sub_categories_name}}</a></p>
                            @endforeach   
                        @endif -->
                    </div>
                    </a>
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
    <!-- /End Services Area -->

 


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
                            <a href="{{ route('frontSignup') }}" class="btn">Pay now <i
                                    class="lni lni-arrow-right"></i></a>
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

    <!-- Start Team Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Team</h3>
                        <?php $team = getContent(MEET_OUR_TEAM);?>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ !empty($team->title) ? $team->title : '' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"><?php if(!empty($team->content)) echo htmlspecialchars_decode($team->content); ?></p>                            
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($teamData))
                @foreach ($teamData as $team)
                    <div class="col-lg-4 col-md-6 col-12 wow fadeInUp" data-wow-delay=".4s">
                        <!-- Start Single Team -->
                        <?php
                        $profilePic = $team->image;
                        if(empty($profilePic)){
                            $profileImg = "";
                        }
                        else
                        {
                            //$imagePath = TEAM_IMAGE.$profilePic;
                            $imagePath = public_path(TEAM_IMAGE.$profilePic);
                            $image_url = asset(TEAM_IMAGE.$profilePic);
                            if (file_exists($imagePath)) {
                                $profileImg = $image_url;
                            }
                            else
                            {
                                $profileImg = '';
                            }
                        }
                        ?>
                        <div class="single-team">
                            <div class="team-image">
                                <img src="{{ $profileImg }}" alt="#">
                            </div>
                            <div class="content">
                                <h4>{{ $team->name }}
                                    <span>{{ $team->positions }}</span>
                                </h4>
                                <ul class="social">
                                    <li><a target="_blank" href="{{ $team->facebook }}"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a target="_blank" href="{{ $team->twitter }}"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a target="_blank" href="{{ $team->linkedin }}"><i class="lni lni-linkedin-original"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Team -->
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
    <!--/ End Team Area -->

    <!-- Start Testimonials Area -->
    <section class="testimonials style2 section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Customer Reviews</h3>
                        <?php $testimonial = getContent(OUR_TESTIMONIALS);?>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">{{ !empty($testimonial->title) ? $testimonial->title : '' }}</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s"><?php if(!empty($testimonial->content)) echo htmlspecialchars_decode($testimonial->content); ?></p>                            
                    </div>
                </div>
            </div>
            <div class="row testimonial-slider">
            @if($testimonials)
            @foreach ($testimonials as $testimonial)
                <div class="col-lg-6 col-12 ">
                    <!-- Start Single Testimonial -->
                    <div class="single-testimonial">
                        <img class="shape1" src="{{ asset('front/images/testimonial/shape-1.svg') }}" alt="#">
                        <img class="shape2" src="{{ asset('front/images/testimonial/shape-2.svg') }}" alt="#">
                        <div class="inner-content">
                            <div class="qote-icon">
                                <i class="lni lni-quotation"></i>
                            </div>
                            <div class="text">
                                <h4>{{ $testimonial->title }}</h4>
                            </div>
                            <?php
				$image = $testimonial->image;
                if(empty($image)){
                            $doc = "";
                        }
                        else
                        {
                //$imagePath = TESTIMONIAL_IMAGE.$image;
                $imagePath = public_path(TESTIMONIAL_IMAGE.$image);
                $image_url		=	asset(TESTIMONIAL_IMAGE.$image);
                if (file_exists($imagePath)) {
                    $doc = $image_url;
                            }
                            else
                            {
                    $doc = "";
                            }
                        }
        ?>
                            <div class="author">
                                <img src="{{ $doc }}" alt="#">
                                <h4 class="name">{{ $testimonial->name }}
                                    <!-- <span class="deg">{{ $testimonial->positions }}</span> -->
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial -->
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
    <!-- End Testimonial Area -->


    <!-- Start Call Action Area -->
    <section class="call-action style2">
        <div class="container">
            <div class="inner-content">
                <img class="bg-shape" src="{{ asset('front/images/call-action/bg-shape.svg') }}" alt="#">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-7 col-12">
                    <?php $ready_to_dive = getContent(READY_TO_DIVE);?>
                        <div class="text">
                            <h2>{{ !empty($ready_to_dive->title) ? $ready_to_dive->title : '' }}
                                <br> <?php if(!empty($ready_to_dive->content)) echo htmlspecialchars_decode($ready_to_dive->content); ?>
                            </h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-12">
                        <div class="button">
                            <a href="{{url('/pricing')}}" class="btn">Get started
                            </a>
                            <!-- <a href="{{url('/front/dashboard')}}" class="btn btn-alt">Learn More
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Area -->

    <div class="container">
    <div class="cookie-popup cookie-popup--short cookie-popup--dark">
    
    <div>
    We'll use cookies to improve and customize your experience if continue to browse. Is it OK if we also use cookies to show you personalized ads?
    </div>
    <div class="cookie-popup-actions">
      <a href="{{url('/cookies-policy')}}">Learn more and manage you cookies</a>
      <button>Yes,Accept cookies</button>
    </div>
  </div>
</div>

@endsection    
@section('css_section')
    <link rel="stylesheet" href="{{ asset('front/css/coustom.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@800&family=Montserrat&display=swap" rel="stylesheet">
@endsection
@section('js_section')
<script src="{{ asset('front/customJs/home_pages.js') }}"></script>
@endsection