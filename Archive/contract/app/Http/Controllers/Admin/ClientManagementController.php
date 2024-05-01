<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Config;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ClientManagementController extends Controller
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
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_client_managemnet.js";

        $dataQuery = User::where('role_id',2);
        if ($request->has('search_by_user_name') && $request->search_by_user_name != '') {
           $dataQuery->where('company_name', 'like', '%' . $request->search_by_user_name . '%')
           ->orWhere('email', 'like', '%' . $request->search_by_user_name . '%');
        }
        //$data = $dataQuery->orderBy('id', 'DESC')->get();
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        //$currentUserData = User::find(Auth::id()); 
        return view('admin.client.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function create(Request $request)
    {

        $headerCss[0] = "admin/css/select2.css";
        $headerCss[1] = "admin/css/uppy.min.css";

        $footerJs[0]    = "admin/js/select2.min.js";
        $footerJs[1]    = "admin/js/jquery.validate.min.js";
        $footerJs[2]    = "admin/js/uppy.min.js";
        $footerJs[3]    = "admin/customJs/admin_client_managemnet.js";

        return view('admin.client.add', compact('request','footerJs','headerCss'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' => 'required',
            'company_name' => 'required',
            'email' =>'required|email|unique:users',
            'password' =>'required',
            'confirm_password' =>'required_with:password|same:password',
        ]);

        if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

        $user = new User();
        $user->name = $request->name;
        $user->company_name = $request->company_name;
        $user->role_id = 2;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        alert()->success('User added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/client_management');
        //return redirect('/admin/client_management')->with('success', 'User added successfully!');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function show($id)
    {
        //
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function edit(Request $request,$id)
    {
        $headerCss[0] = "admin/css/demo.css";
        $headerCss[1] = "admin/css/uppy.min.css";

        $footerJs[0]    = "admin/js/select2.min.js";
        $footerJs[1]    = "admin/js/jquery.validate.min.js";
        $footerJs[2]    = "admin/js/uppy.min.js";
        $footerJs[3]    = "admin/customJs/admin_client_managemnet.js";

        $userdata = User::find($id);
        return view('admin.client.edit', compact('request','userdata','footerJs','headerCss'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ]);

         $user = User::find($id);
         $user->name = $request->name;
         $user->company_name = $request->company_name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->phone = !empty($request->phone) && $request->phone ? (int)$request->phone : '';
         $user->save();

         alert()->success('User updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/client_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function destroy($id)
    {
        $category = User::find($id)->delete();
        alert()->success('User deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/client_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 16/07/2021
    */
    public function profile()
    {
        $id = Auth::user()->id;
        $headerCss[0] = "admin/css/demo.css";
        
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_client_managemnet.js";

        $userdata = User::find($id);
        return view('admin.client.profile', compact('userdata','footerJs','headerCss'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function profileUpdate(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            // 'password' => ['required', 'string', 'min:8'],
            // 'confirm_password' => 'required_with:password|same:password',
        ]);

         $user = User::find($id);
         $user->company_name = $request->company_name;
         $user->email = $request->email;
         $user->address = $request->address;
         $user->phone = (int)$request->phone;
         //$user->password = Hash::make($request->password);
         $user->save();

         alert()->success('User updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/profile');
    }

    public function changePassword()
    {
        $headerCss[0] = "admin/css/demo.css";
        
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_client_managemnet.js";

        return view('admin.client.change_password', compact('footerJs','headerCss'));
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
