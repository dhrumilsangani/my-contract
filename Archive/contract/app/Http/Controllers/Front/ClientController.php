<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContractCategories;
use App\Models\News;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Auth;
use App\Models\TeamMember;
use App\Models\Testimonials;
use App\Models\User;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class ClientController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 11/06/2021
    */
    public function index()
    {
        //add Jquery 
        $footerJs[0]    = "front/customJs/dashboard.js";
        
        //start get team member data
        $teamData = TeamMember::select('id','name','image','positions','facebook','twitter','linkedin','status')
        ->where('status',1)
        ->limit(3)
        ->get();
        //End get team member data

        //Start get Testimonials data
        $testimonials = Testimonials::select('id','title','name','image','positions','status')
        ->where('status',1)
        ->get();
        //End get Testimonials data

        //Start get Product data
        $product = Pricing::select('id','title','type','price','price_code','status','price_features')
        ->where('status',1)
        ->get();
        //End get Testimonials data


        // $categories = ContractCategories::with(['subCategories' => function ($q)  {
        //     $q->select('id','categories_id','sub_categories_name');
        // },'subCategories.contract' => function ($q) {
        //     $q->select('id', 'sub_category_id');
        // }])
        //     ->select('contract_categories.*')
		// 	->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
		// 	->join('contract','contract.sub_category_id','sub_categories.id')
		// 	->where('contract_categories.status',1)
		// 	->where('sub_categories.status',1)
		// 	->where('contract.status',1)
		// 	->groupBy('sub_categories.categories_id')
		// 	->get();

            $categories = ContractCategories::select('id','categories_name','image','status')
            ->where('status',1)
            ->get();

           
        
        return view('front.dashboard', compact('product','teamData','testimonials','footerJs','categories'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 11/06/2021
    */
    public function profile()
    {
        //add Jquery 
        $footerJs[0]    = "front/customJs/profile.js";
        $id =Auth::user()->id;

        $user = User::find($id);

        $currentSub = Subscription::where('user_id',$id)->first();
        return view('front.client_profile', compact('user','footerJs','currentSub'));
    }



    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function profileUpdate(Request $request)
    {
        $id =Auth::user()->id;
        $request->validate([
            'company_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'name' => 'required',
        ]);
        //check validation
        //Start Update user data
         $user = User::find($id);
         $user->company_name = $request->company_name;
         $user->name = $request->name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->phone = (int)$request->phone;
         $user->save();
         //End Update user data
         //Redirect with message
         alert()->success('your profile has been updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/front/profile/');
    }

    public function changePassword()
    {
        $headerCss[0] = "admin/css/demo.css";
        
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_client_managemnet.js";
        $footerJs[0]    = "front/customJs/profile.js";

        return view('front.change_password', compact('footerJs','headerCss'));
    }

    public function updatePassword(Request $request)
    {
            # Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
            
            #Match The Old Password
            if(!Hash::check($request->old_password, auth()->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
            
            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            
            return back()->with("status", "Password changed successfully!");
    }

}
