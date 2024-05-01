<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractCategories;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SubCategoriesController extends Controller
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
        @Date   : 17/11/2021
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_sub_categories_managemnet.js";

        $dataQuery = SubCategories::select("id",'sub_categories_name','status','categories_id');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('sub_categories_name', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        
        return view('admin.sub_categories.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/11/2021
    */
    public function create(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_sub_categories_managemnet.js";
        $categories = ContractCategories::where('status',1)->orderBy('categories_name', 'asc')->get();
        return view('admin.sub_categories.add', compact('categories','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 18/11/2021
    */
    public function store(Request $request)
    {
        $request->validate([
            'categories_id' => 'required',
            'sub_categories_name' => 'required',
        ]);
        
        $categories = new SubCategories();
        $categories->sub_categories_name = $request->sub_categories_name;
        $categories->categories_id = $request->categories_id;
        $categories->status = isset($request->status)?1:0;
        $categories->save();
        alert()->success('Sub Categories added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/sub_categories_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 18/11/2021
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
        @Date   : 18/11/2021
    */
    public function edit(Request $request,$id)
    {
        $SubCategories = SubCategories::find($id);
        $categories = ContractCategories::where('status',1)->orderBy('categories_name', 'asc')->get();
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_sub_categories_managemnet.js";
        return view('admin.sub_categories.edit', compact('request','categories','SubCategories','footerJs'));
    }

    
    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 18/11/2021
    */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'categories_id' => 'required',
            'sub_categories_name' => 'required',
        ]);

        $team = SubCategories::find($id);
        $team->categories_id = $request->categories_id;
        $team->sub_categories_name = $request->sub_categories_name;
        $team->status = isset($request->status)?1:0;
        $team->save();
        alert()->success('Sub Categories updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/sub_categories_management');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 18/11/2021
    */
    public function destroy($id)
    {
        SubCategories::find($id)->delete();
        alert()->success('Categories deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/sub_categories_management');
    }
}
