@extends('front/layouts.master')
@section('content')
 <!-- Start Breadcrumbs -->
 <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Our Newsletter</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Our Newsletter</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    @include('message_data')
    <!-- Start Pricing Table Area -->
    <section class="team section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Newsletter</h3>
                        <p class="wow fadeInUp" data-wow-delay=".6s">There are many variations of passages of Lorem
                            Ipsum available, but the majority have suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($news))
                @foreach ($news as $team)
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
                            $image_url		=	asset(TEAM_IMAGE.$profilePic);
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
                                <h4>{{ $team->title }}
                                    <span><?php if(!empty($team->description)) echo htmlspecialchars_decode($team->description); ?></span>
                                </h4>
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



</div>
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


