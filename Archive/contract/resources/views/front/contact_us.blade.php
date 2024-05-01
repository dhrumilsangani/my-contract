@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Contact Us</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Contact Area -->
    <div class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                <!-- Alert messages code start here -->	
                @include('message_data')	
            <!-- Alert messages code end here -->
                    <div class="contact-form">
                        <form class="form" method="post" id="contact_frm" name="contact_frm" action="{{ route('saveContactData') }}">
                                    @csrf
                            <div class="form-group">
                                <label>Your name <span class="astrick">*</span></label>
                                <input name="name" type="text" placeholder="Your name" required="required">
                            </div>
                            <div class="form-group">
                                <label>Your Subject <span class="astrick">*</span></label>
                                <input name="subject" type="text" placeholder="Type your subject" required="required">
                            </div>
                            <div class="form-group">
                                <label>Email address <span class="astrick">*</span></label>
                                <input name="email" type="email" placeholder="Your email" required="required">
                                <!-- <span id="errors-email">Please enter a valid email address.</span> -->
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea placeholder="Write your message here" name="message" id="message-area"
                                    class="form-control"></textarea>
                            </div>
                            <div class="button">
                                <button name="submit" type="submit" id="submit" class="btn" value="Submit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="contact-widget-wrapper">
                    <?php 
                                    if(!empty($page_details->page_content)) echo htmlspecialchars_decode($page_details->page_content); 
                                ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact Area -->
@endsection