<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AdminHomeController extends Controller
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

    public function homeAdmin(Request $request)
    {
        /*$data = [];
         Mail::send(['text'=>'admin.login_mail'], $data, function($message) {
         $message->to('axayd1995@gmail.com')->subject
            ('New login Mail');
       });
         echo "perfect";exit;*/
         $users = User::get();
         
        return view('admin.home',compact('users'));
    }
}
