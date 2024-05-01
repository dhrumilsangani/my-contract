<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Validator;
use App\Models\ContactUs;
use RealRashid\SweetAlert\Facades\Alert;
use Config;
use App\Traits\SendMail;

class ContactUsController extends Controller
{
    use SendMail;
    /*
        @Author : Ritesh Rana
        @Desc   : Store contact us data
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 11/06/2021
    */
    public function saveContact(Request $request)
    {
        $validationArr = array(
			'name' => 'required',
            'subject' => 'required',
            'email' => 'required',
        );

        $validator = Validator::make($request->all(),$validationArr);
        //check validation
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}else {
            //store contact us data
            $user = new ContactUs;
            $user->name = $request->name;
            $user->subject = $request->subject;
            $user->email = $request->email;
            $user->message = $request->message;
            $user->save();
            //start send email to admin
                $data = array('message_data'=>$request->message, 'email' => $request->email,'name'=>$request->name);
                $makeHtmlView = (string)View::make('emails.contact_us_mail', $data);
                $this->fire(config('constants.fromEmail'),$request->subject,$makeHtmlView);
            //end send email to admin
            //start send email to user
                $message_data = "We appreciate you contacting us. One of our colleagues will get back in touch with you soon! Have a great day!";
                $data = array('message_data'=>$message_data, 'email' => $request->email,'name'=>$request->name);
                $makeHtmlView = (string)View::make('emails.contact_us_mail', $data);
                $this->fire($request->email,$request->subject,$makeHtmlView);
            //End send email to user
            //Redirect with message
            alert()->success('Thank you for filling out your information!')->showConfirmButton('Ok', '#07689f');
            return redirect('/contact-us');
        }
    }
}
