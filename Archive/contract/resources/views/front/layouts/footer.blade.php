  <!-- Start Footer Area -->
  <footer class="footer section">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-about">
                                <div class="logo">
                                <?php if(isset(Auth::user()->role_id) && Auth::user()->role_id == 2){
                                    $url = url('/front/dashboard');
                                }else{
                                    $url = route('home');
                                }?>
                                <a href="{{$url}}">
                                    <img src="{{ asset('front/images/logo/Logo.png') }}" alt="#">
                                </a>
                                </div>
                                <!-- <p> Terms of Use, Privacy Policy, Cookies Policy and Acceptable Use Policy.</p> -->
                                <p class="copyright-text">Create My Contract is not a law firm and cannot provide legal advice.</p>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Solutions</h3>
                                
                                <ul>
                                <?php 
                                $cms = cmsInfo();  
                                ?>
                                @if(!empty($cms))
                                    @foreach ($cms as $cmsVal)
                                    @if($cmsVal->page_slug != "contact-us")
                                    <li><a href="{{url('/'.$cmsVal->page_slug)}}">{{ $cmsVal->page_title }}</a></li>
                                        <!-- <li><a href="{{url('/terms-conditions')}}">Terms and conditions</a></li>
                                        <li><a href="{{url('/privacy-policy')}}">Privacy policy</a></li>
                                        <li><a href="{{url('/acceptable-use-policy')}}">Acceptable use policy</a></li> -->
                                        @endif 
                                    @endforeach
                                @endif    
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-2 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer f-link">
                                <h3>Support</h3>
                                <ul>
                                    <!-- <li><a href="{{url('/pricing')}}">Pricing</a></li> -->
                                    @if(!empty($cms))
                                    @foreach ($cms as $cmsVal)
                                    @if($cmsVal->page_slug == "contact-us")
                                    <li><a href="{{url('/'.$cmsVal->page_slug)}}">{{ $cmsVal->page_title }}</a></li>
                                        <!-- <li><a href="{{url('/terms-conditions')}}">Terms and conditions</a></li>
                                        <li><a href="{{url('/privacy-policy')}}">Privacy policy</a></li>
                                        <li><a href="{{url('/acceptable-use-policy')}}">Acceptable use policy</a></li> -->
                                        @endif 
                                    @endforeach
                                @endif 
                                    <!-- <li><a href="javascript:void(0)">Documentation</a></li> -->
                                    <!-- <li><a href="{{url('/contact-us')}}">Contact us</a></li> -->
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget -->
                            <div class="single-footer newsletter">
                                <h3>Subscribe</h3>
                                <p>Subscribe to our newsletter for the latest updates</p>
                                @if(session()->get('success_data'))          
                                    <div class="alert alert-success mb-4 alertmsg" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <i data-feather="x" class="close"></i></button>
                                        <i data-feather="check"></i> <strong>Success! </strong> {{ session()->get('success_data') }}
                                    </div>
                                @endif
                                <form action="{{ route('saveSubscriberData') }}" method="post" id="add_front_subs" name="add_front_subs"  novalidate class="newsletter-form needs-validation">
                                @csrf
                                    <input name="email" id='email' placeholder="Email address" required="required" type="email">
                                    @if ($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                    <div class="button">
                                        <button type="submit" class="sub-btn"><i class="lni lni-envelope"></i></button>
                                    </div>
                                </form>
                            </div>
                            <!-- End Single Widget -->
                        </div>
                        <!-- <div class="col-lg-4 col-md-6 col-12">
                             Single Widget 
                            <div class="single-footer f-link">
                                <h3>Subscribe</h3>
                                <ul>
                                    <li><a href="{{url('front/newsletter')}}">Newsletter</a></li>
                                   
                                </ul>
                                
                            </div>
                             End Single Widget -->
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="copyright-txt">
                                <p class="m-0">Copyright © {{date("Y")}} <a href="createmycontract.com">createmycontract.com</a> - All Rights Reserved </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Footer Top -->
    </footer>
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    
    <script src="{{ asset('front/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('front/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('front/js/count-up.min.js') }}"></script>
    <script src="{{ asset('front/js/main.js') }}"></script>
    <script src="{{ asset('front/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('front/js/my-custom.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    
    <script src="{{ asset('front/js/sweetalert.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    
    <script>
        //========= testimonial 
        tns({
            container: '.testimonial-slider',
            items: 3,
            slideBy: 'page',
            autoplay: false,
            mouseDrag: true,
            gutter: 0,
            nav: true,
            controls: false,
            controlsText: ['<i class="lni lni-arrow-left"></i>', '<i class="lni lni-arrow-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                },
                1170: {
                    items: 2,
                }
            }
        });

        GLightbox({
            'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
            'type': 'video',
            'source': 'youtube', //vimeo, youtube or local
            'width': 900,
            'autoplayVideos': true,
        });
   
    </script>
    <script type="text/javascript">
        var baseurl = <?php echo "'".url('/')."';"; ?>;
        var csrf_token = <?php echo "'".csrf_token()."';"; ?>
</script>
    @yield("js_section")
    <?php
/*
  @Author : Ritesh Rana
  @Desc   : Used for the custom js initilization just pass array of the scripts with links
  @Input  :
  @Output :
  @Date   : 15/05/2021
 */
if (isset($footerJs) && count($footerJs) > 0) {
foreach ($footerJs as $js) {?>
<script src="{{ asset($js) }}" ></script>
<?php }
} ?>
    











