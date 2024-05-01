<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Validator;
use App\Models\TemporarilyUser;
use App\Models\Product;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Traits\SendMail;

class RegisterController extends Controller
{
    use SendMail;

    public function signup()
    {
        $footerJs[0]    = "front/customJs/signUp.js";
        return view('front.signup', compact( 'footerJs'));
    }

    public function saveUser(Request $request)
    {
        /* add js */
        $footerJs[0]    = "front/customJs/pricing_plan.js";
    /* start check validation */
        $validationArr = array(
			'email' => 'required|email|unique:App\Models\User,email',
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => 'required_with:password|same:password',
        );

        $validator = Validator::make($request->all(),$validationArr);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
       /* End check validation */     
		}else {
        //store Temporarily User data
            $user = new TemporarilyUser;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 2;
            $user->save();
        //End Temporarily User data
        /* get Product data */
            $product = Pricing::select('id','title','type','price','price_code','status')
            ->where('status',1)
            ->get();

          //start send email to user
          $subject = "User Registration successfully!";
          $link = route('loginPage');
          $data = array('email' => $request->email,'login' => $link);
          $makeHtmlView = (string)View::make('emails.registration_successfully_mail', $data);
          $this->fire($request->email,$subject,$makeHtmlView);

          //End send email to user

            return view('front.pricing_plan', compact('user','product','footerJs'));
        }
        
    }

    
}
