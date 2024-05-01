<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContractData;
use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\Product;
use App\Models\PaymentDetails;
use App\Models\Pricing;
use App\Models\TemporarilyUser;
use App\Models\User;
use App\Models\Subscription;
use Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\View;
use App\Traits\SendMail;


class StripePaymentController extends Controller
{
  use SendMail;
    /*
        @Author : Ritesh Rana
        @Desc   : Display strip payment page.
        @Input  : \Illuminate\Http\Request
        @Output : \Illuminate\Http\Response
        @Date   : 15/06/2021
    */  
  public function stripe()
    {
        return view('front.payment.stripe');
    }
    /*
        @Author : Ritesh Rana
        @Desc   : Display strip payment page.
        @Input  : \Illuminate\Http\Request
        @Output : \Illuminate\Http\Response
        @Date   : 15/06/2021
    */
    public function stripePost(Request $request)
    {
      
      //Strip key and Secret key
        $stripeKey = config('services.strip.key'); 
        $stripeSecret = config('services.strip.secret');
        
        //$product_id = deCodeVal($request->product_price); 
        $product_id = $request->product_price;  
        //get product data
        $product_details = Pricing::find($product_id);
        //Start add payment data 
        $payDetail = new PaymentDetails;
        if(isset($request->temUserId) && !empty($request->temUserId)){
          $temUserId = deCodeVal($request->temUserId);  
          $payDetail->user_id = $temUserId;
        }else{
          $payDetail->user_id = Auth::user()->id;
        }
        $payDetail->amount = $product_details->price;
        $payDetail->type = $product_details->type;
        $payDetail->transaction_status = "inprocess";
        $payDetail->save();
        //End add payment data 
        //Set  success url and cancel url
        if(isset($request->temUserId) && !empty($request->temUserId)){
          $success_payment = url('/front/user/success_payment/'.$payDetail->id);
        }else{
          $success_payment = url('/front/success_payment/'.$payDetail->id);
        }
        //End Set success url and cancel url
        //Start get strip payment page tokan
        Stripe\Stripe::setApiKey($stripeSecret);
        
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'customer'=>null,
          
            'line_items' => [[
                'price' => $product_details->price_code,
                'quantity' => 1,
            ]],
            "metadata" => ["order_id" => $payDetail->id],
            'mode' => 'payment',
            'success_url' => $success_payment,
            'cancel_url' =>  url('/'),
          ]);
        //End get strip payment page tokan
        // Update session id in payment table
          $update_order = PaymentDetails::find($payDetail->id);
          $update_order->payment_session_id = $session->id;
          $update_order->save();
        
        return $session->id;

    }

    /*
        @Author : Ritesh Rana
        @Desc   : Get success payment Response and update subscription date
        @Input  : \Illuminate\Http\Request
        @Output : \Illuminate\Http\Response
        @Date   : 17/06/2021
    */
    function success_payment(Request $request,$pay_id){
      //get Payment Details
      $pay_details = PaymentDetails::find($pay_id);

      //set stripe Key and stripe Secret
      $stripeKey = config('services.strip.key'); 
      $stripeSecret = config('services.strip.secret');
      // Start get strip payment success data
      Stripe\Stripe::setApiKey($stripeSecret);
      
      $session = \Stripe\Checkout\Session::retrieve(
        $pay_details->payment_session_id,
        []);
       // End get strip payment success data 
       
       //Update payment detail
        $pay_details->payment_type = "stripe";
        $pay_details->transaction_id = $session->payment_intent;
        $pay_details->transaction_status = ($session->payment_status == "paid")?"success":"fail";
        $pay_details->currency = $session->currency;
        $pay_details->save();

        //Get old subscriptions data 
        $oldSub = Subscription::where('user_id',Auth::user()->id)->first();
        
        //Start update end subscriptions date 
      if($session->payment_status == "paid"){
        if(!empty($oldSub)){
        $subscriptions = Subscription::find($oldSub->id);
        $subscriptions->from_date = date('Y-m-d');
        if($pay_details->type == "Yearly"){
          if($oldSub->status == 1){
            if($oldSub->to_date !== '0000-00-00 00:00:00'){
              $yearly = date("Y-m-d H:i:s", strtotime("+1 years", strtotime($oldSub->to_date)));
            }else{
              $yearly = date("Y-m-d H:i:s", strtotime("+1 years"));
            }
          }else{
            $yearly = date('Y-m-d', strtotime('+1 years'));
          }
          $subscriptions->to_date = $yearly;
          $subscriptions->type = "Yearly";
        }else if($pay_details->type == "Monthly"){
          if($oldSub->status == 1){
            if($oldSub->to_date !== '0000-00-00 00:00:00'){
              $month = date('Y-m-d', strtotime('+1 months', strtotime($oldSub->to_date)));  
            }else{
              $month = date('Y-m-d', strtotime('+1 months'));
            }
        }else{
            $month = date('Y-m-d', strtotime('+1 months'));
        }
          $subscriptions->to_date = $month;
          $subscriptions->type = "month";
        }else{
          $subscriptions->to_date = "";
          $subscriptions->type = "One-Off Contract";
        }
        $subscriptions->total_amount= $pay_details->amount;
        $subscriptions->status = 1;
        $subscriptions->save();
      }else{
        $subscriptions = new Subscription();
        $subscriptions->from_date = date('Y-m-d H:i:s');
        if($pay_details->type == "Yearly"){
          $yearly = date('Y-m-d', strtotime('+1 years'));
          $subscriptions->to_date = $yearly;
          $subscriptions->type = "Yearly";
        }else if($pay_details->type == "Monthly"){
          $month = date('Y-m-d', strtotime('+1 months'));
          $subscriptions->to_date = $month;
          $subscriptions->type = "month";
        }else{
          $subscriptions->to_date = "";
          $subscriptions->type = "One-Off Contract";
        }
        $subscriptions->user_id = Auth::user()->id;
        $subscriptions->total_amount= $pay_details->amount;
        $subscriptions->status = 1;
        $subscriptions->save();

        $subject = "User Registration successfully!";
        $link = route('loginPage');
        $data = array('email' => Auth::user()->email,'login' => $link);
        $makeHtmlView = (string)View::make('emails.registration_successfully_mail', $data);
        $this->fire(Auth::user()->email,$subject,$makeHtmlView);
      }

      if($pay_details->type == "One-Off"){
         $updateContract = ContractData::where('created_by',Auth::user()->id)->get();
        if(!empty($updateContract)){
          foreach($updateContract as $contract){
            $contractData = ContractData::find($contract->id);
            $contractData->one_coontract_status = 0;
            $contractData->save();
          }
        }
      }
      
         //start send email to user
         $subject = "Your payment has been processed successfully!";
         $link = route('loginPage');
         $data = array('to_date'=>$subscriptions->to_date,'amount'=>$pay_details->amount,'subscriptions->type' => $subscriptions->type,'email' =>  Auth::user()->email,'name'=>Auth::user()->name,'login' => $link);
          $makeHtmlView = (string)View::make('emails.payment_successfully_mail', $data);
          $this->fire(Auth::user()->email,$subject,$makeHtmlView);

        alert()->success('Your payment has been processed successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/front/dashboard');
      }else{
        alert()->error('Sorry, your payment failed!')->showConfirmButton('Ok', '#07689f');
        return redirect('/front/dashboard');
      }
        //End update end subscriptions date 
   
    }

    /*  
        @Author : Ritesh Rana
        @Desc   : Get new user success payment Response and add in subscription
        @Input  : \Illuminate\Http\Request
        @Output : \Illuminate\Http\Response
        @Date   : 17/06/2021
    */
    function user_success_payment(Request $request,$pay_id){
      //get Payment Details
      $pay_details = PaymentDetails::find($pay_id);

      //set stripe Key and stripe Secret
      $stripeKey = config('services.strip.key'); 
      $stripeSecret = config('services.strip.secret');

      // Start get strip payment success data
      Stripe\Stripe::setApiKey($stripeSecret);
      
      $session = \Stripe\Checkout\Session::retrieve(
        $pay_details->payment_session_id,
        []);
       // End get strip payment success data 
       
       // Start Create new user after payment
        if($session->payment_status == "paid"){
          $userData = TemporarilyUser::where('id',$pay_details->user_id)->first();
          $user = new User();
          $user->role_id = $userData->role_id;
          $user->password = $userData->password;
          $user->email = $userData->email;
          $user->save();
        }
        // End Create new user after payment

        //update payment detail
        $pay_details->user_id = $user->id;
        $pay_details->payment_type = "stripe";
        $pay_details->transaction_id = $session->payment_intent;
        $pay_details->transaction_status = ($session->payment_status == "paid")?"success":"fail";
        $pay_details->currency = $session->currency;
        $pay_details->save();

  //Start create Subscription 
if($session->payment_status == "paid"){
        $subscriptions = new Subscription();
        $subscriptions->from_date = date('Y-m-d H:i:s');
        if($pay_details->type == "Yearly"){
          $yearly = date('Y-m-d', strtotime('+1 years'));
          $subscriptions->to_date = $yearly;
          $subscriptions->type = "Yearly";
        }else if($pay_details->type == "Monthly"){
          $month = date('Y-m-d', strtotime('+1 months'));
          $subscriptions->to_date = $month;
          $subscriptions->type = "month";
        }else{
          $subscriptions->to_date = "";
          $subscriptions->type = "One-Off Contract";
        }
        $subscriptions->user_id = $user->id;
        $subscriptions->total_amount= $pay_details->amount;
        $subscriptions->status = 1;
        $subscriptions->save();

        $subject = "User Registration successfully!";
        $link = route('loginPage');
        $data = array('email' => $userData->email,'login' => $link);
        $makeHtmlView = (string)View::make('emails.registration_successfully_mail', $data);
        $this->fire($userData->email,$subject,$makeHtmlView);
      }   
      //End create Subscription 

      //login and redirect to deshbord page
      if ($user->id) {
          Auth::login($user);

        //start send email to user
         $subject = "Your payment has been processed successfully!";
         $link = route('loginPage');
         $data = array('to_date'=>$subscriptions->to_date,'amount'=>$pay_details->amount,'subscriptions->type' => $subscriptions->type,'email' =>  Auth::user()->email,'name'=>Auth::user()->name,'login' => $link);
          $makeHtmlView = (string)View::make('emails.payment_successfully_mail', $data);
          $this->fire(Auth::user()->email,$subject,$makeHtmlView);

          alert()->success('Your payment has been processed successfully!')->showConfirmButton('Ok', '#07689f');
          return redirect('/front/dashboard');
      }else{
        alert()->error('Sorry, your payment failed!')->showConfirmButton('Ok', '#07689f');
          return redirect('/signup');
      }
    }

    
}
