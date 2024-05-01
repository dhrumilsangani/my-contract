<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   /* protected $redirectTo = RouteServiceProvider::HOME;*/

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(){
        if (Auth::check()) {
            return redirect(backUrl(''));
        }
        
        return view('admin.login');
    }
    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()]);
        } else {
            DB::enableQueryLog();

            $user = User::where(['email' =>$request->email,'role_id' => 1])->first();
             if (!$user) {
              return back()->withErrors('Your email is incorrect, please try again!')->withInput();
             }
             if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors('Your password is incorrect, please try again!')->withInput();
             }
           /* print_r(DB::getQueryLog());exit;*/
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            }
        }
    }

    public function logout(Request $request) {
       // auth()->logout();
       $this->guard()->logout();

       $request->session()->invalidate();

       $request->session()->regenerateToken();
        return redirect()->to('/admin/login');
    }
   
    
}
