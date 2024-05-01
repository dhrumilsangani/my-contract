<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    public function newsletter()
    {
        //Start get Product data
        $news = News::where('status',1)->get();
        //End get Testimonials data
       // dd($news);
        return view('front.newsletter', compact('news'));
    }
}
