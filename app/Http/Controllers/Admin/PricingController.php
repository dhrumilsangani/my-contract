<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pricing;
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

class PricingController extends Controller
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
        @Date   : 04/01/2022
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";

        $dataQuery = Pricing::select("id",'title','type','price','price_code','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('title', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.pricing.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function create(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";
        
        return view('admin.pricing.add', compact('request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'price' => 'required',
            'price_code' => 'required',
            'price_features'=>'required'
            //'content' => 'required',
        ]);
        
        $pricing = new Pricing();
        $pricing->title = $request->title;
        $pricing->type = $request->type;
        $pricing->price = $request->price;
        $pricing->price_code = $request->price_code;
        $pricing->status = isset($request->status)?1:0;
        $pricing->price_features = $request->price_features;
        $pricing->save();
        
        alert()->success('Pricing created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/price_management')->with('success', 'pricing created successfully!');
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
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
        @Date   : 04/01/2022
    */
    public function edit(Request $request,$id)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_pricing_management.js";

        $pricing = Pricing::find($id);
        return view('admin.pricing.edit', compact('request','pricing','footerJs'));
    }

    
    /*
        @Author : Sanjay Saw
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'price' => 'required',
            'price_code' => 'required',
            'price_features'=>'required'
        ]);

        $pricing = Pricing::find($id);
        $pricing->title = $request->title;
        $pricing->type = $request->type;
        $pricing->price = $request->price;
        $pricing->price_code = $request->price_code;
        $pricing->status = isset($request->status)?1:0;
        $pricing->price_features = $request->price_features;
        $pricing->save();
     
        alert()->success('Pricing updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/price_management');
    }

     /*
        @Author : Sanjay Saw
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function destroy($id)
    {
        $category = Pricing::find($id)->delete();
        alert()->success('Pricing deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/price_management');
    }
}
