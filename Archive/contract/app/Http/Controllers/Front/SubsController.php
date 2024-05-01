<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use DB;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\View;
use App\Traits\SendMail;

class SubsController extends Controller
{
    use SendMail;
     /*
        @Author : Sanjay Saw
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function storeSubscriber(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscribe_newsletters',
            //'content' => 'required',
        ]);
        
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->status = 1;
        $subscriber->save();

            $subject = "Subscribed Successfully";
            $link = route('loginPage');
            $data = array('email' => $request->email,'login' => $link);
            $makeHtmlView = (string)View::make('emails.subscribed_successfully_mail', $data);
            $this->fire($request->email,$subject,$makeHtmlView);
       
        alert()->success('subscribed successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/')->with('success_data', 'subscribed successfully!');
    }
}
