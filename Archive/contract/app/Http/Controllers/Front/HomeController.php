<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContractCategories;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use App\Models\Testimonials;
use App\Models\User;
use App\Models\Pricing;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /*
        @Author : Ritesh Rana
        @Desc   : befor login home page.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 07/05/2021
    */
    public function index()
    {
        /* Start get Team Member Data */
        $teamData = TeamMember::select("id",'name','image','positions','facebook','twitter','linkedin','status')
        ->where('status',1)
        ->limit(3)
        ->get();
        /* End get Team Member Data */

        /* Start get Testimonials Data */
        $testimonials = Testimonials::select("id",'title','name','image','positions','status')
        ->where('status',1)
        ->get();
        /* End get Testimonials Data */

        /* Start get Product Data */
        $product = Pricing::select('id','title','type','price','price_code','status','price_features')
        ->where('status',1)
        ->get();
        /* End get Product Data */

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

           
            // foreach($categories as $categorie){
            //     echo "<pre>";
            //     print_r($categorie['subCategories']);
            //     echo "</pre>";
        
            // }exit;
            // echo "<pre>";
            // print_r($categories);
            // echo "</pre>";exit;
        
        return view('front.home', compact('teamData','testimonials','product','categories'));
    }

     /*
        @Author : Ritesh Rana
        @Desc   : login page.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 16/06/2021
    */
    public function login_page()
    {
        /* add js */
        $footerJs[0]    = "front/customJs/signin.js";
        return view('front.login', compact( 'footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : pricing page.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 15/06/2021
    */
    public function pricing()
    {
        /* add js */
        $footerJs[0]    = "front/customJs/dashboard.js";

        $userData = "";
        if(Auth::user() != null){
            $userData = Auth::user()->role_id;
        }
        
        /* start get product data */
        $product = Pricing::select('id','title','type','price','price_code','status','price_features')
        ->where('status',1)
        ->get();
        /* End get product data */
        return view('front.pricing',compact('userData','product','footerJs'));
    }

    
    /*
        @Author : Ritesh Rana
        @Desc   : front Login.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 16/06/2021
    */
    public function frontLogin(Request $request)
    {
        /* check validation */
        $validation = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        /* start check user data */
            $user = User::where(function ($u) use ($request) {
                $u->where('email', $request->email);
                })->where(function ($q) {
                    $q->where('role_id', 2);
                })->first();
            $extinginsyatem = User::where('email',$request->email)->where('role_id',2)->first();
            if(empty($extinginsyatem)){
                $newmassage = "This email is not registered, please sign up";
            }
        
        if (!$user) {
            if(isset($newmassage)){
                return back()->withErrors(['message' => $newmassage])->withInput();
            }

        }
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['message' => 'Your email and/or password is incorrect, please try again!'])->withInput();
        }
        /* End check user data */
        /* create auth */
        if ($user) {
            $user->save();
            Auth::login($user);
            //Redirect 
            return redirect(url('/front/dashboard'));
        }
    }

    /*
        @Author : Ritesh Rana
        @Desc   : front Logout.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/06/2021
    */
    public function frontLogout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
