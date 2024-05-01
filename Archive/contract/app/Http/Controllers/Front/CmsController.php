<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;

class CmsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /*
        @Author : Ritesh Rana
        @Desc   : Display all CMS page.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 18/06/2021
    */
    public function index(Request $request)
    {
        $page_slug = request()->segment(count(request()->segments()));
        /* get all cms page */
        $page_details = CmsPage::where('page_slug',$page_slug)->first();
        if($page_slug == 'privacy-policy'){
            return view('front.privacy_policy_page_details',compact('page_details'));
        }elseif($page_slug == 'terms-conditions'){
             return view('front.terms_conditions_page_details',compact('page_details'));
        }elseif($page_slug == 'acceptable-use-policy'){
             return view('front.acceptable_use_policy_page_details',compact('page_details'));
        }elseif($page_slug == 'contact-us'){
            $footerJs[0]    = "front/customJs/contact_us.js";
            return view('front.contact_us',compact('page_details','footerJs'));
        }elseif($page_slug == 'cookies-policy'){
             return view('front.cookies_policy',compact('page_details'));
        }else{
            return view('front.cms_page',compact('page_details'));
        }
    }
}
