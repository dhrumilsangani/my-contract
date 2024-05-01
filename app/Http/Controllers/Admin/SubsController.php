<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Subscriber;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\ContractCategories;
use App\Models\FrequentlyQuestions;
use App\Models\SubCategories;
use App\Models\Template;
use App\Models\TemplateForm;
use DB;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;

class SubsController extends Controller
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
        @Author : Sanjay Saw
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";

        $dataQuery = Subscriber::select("id",'email','status');
        if ($request->has('search_by_email') && $request->search_by_title != '') {
           $dataQuery->where('email', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.subscriber.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function create(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";
        
        return view('admin.subscriber.add', compact('request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:subscribe_newsletters',
            //'content' => 'required',
        ]);
        
        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->status = isset($request->status)?1:0;
        $subscriber->save();
        
        alert()->success('subscriber created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/subs_management')->with('success', 'subscriber created successfully!');
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function show($id)
    {
        //
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function edit(Request $request,$id)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";

        $subscriber = Subscriber::find($id);
        return view('admin.subscriber.edit', compact('request','subscriber','footerJs'));
    }

    
    /*
        @Author : Sanjay Saw
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'email' => 'required|unique:subscribe_newsletters',
        ]);

        $subscriber = Subscriber::find($id);
        $subscriber->email = $request->email;
        $subscriber->status = isset($request->status)?1:0;
        $subscriber->save();
     
        alert()->success('subscriber updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/subs_management');
    }

     /*
        @Author : Sanjay Saw
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function destroy($id)
    {
        $category = Subscriber::find($id)->delete();
        alert()->success('subscriber deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/subs_management');
    }
}
