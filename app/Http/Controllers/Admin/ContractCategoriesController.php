<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContractCategories;
use App\Models\SubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ContractCategoriesController extends Controller
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
        $footerJs[1]    = "admin/customJs/admin_categories_managemnet.js";

        $dataQuery = ContractCategories::select("id",'categories_name','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('categories_name', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.contract_categories.index', compact('data','request','footerJs'));
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
        $footerJs[1]    = "admin/customJs/admin_categories_managemnet.js";
        return view('admin.contract_categories.add', compact('request','footerJs'));
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
            'categories_name' => 'required',
            //'image' => 'mimes:jpeg,jpg,png,gif|required',
            //'image' => 'required|mimes:jpeg,jpg,png|max:1024|dimensions:min_width=200,max_width=1000',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        $contract_image = $request->image;
        $image_name = time().'.'.$contract_image->getClientOriginalExtension();
        $destinationImgPath = public_path(config('constants.categorieImagePath'));
        $contract_image->move($destinationImgPath, $image_name);

        
        $team = new ContractCategories();
        $team->categories_name = $request->categories_name;
        $team->image = $image_name;
        $team->status = isset($request->status)?1:0;
        $team->save();
        alert()->success('Contract category added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/categories_management');
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
        $categories = ContractCategories::find($id);
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_categories_managemnet.js";
        return view('admin.contract_categories.edit', compact('request','categories','footerJs'));
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
            'categories_name' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
        ]);

        $image = $request->file('image');

        if(!empty($image)){
            $imageArr = ContractCategories::select('image')->where(array('id'=>$id))->first();
            if(!empty($imageArr)){
                $images_path = base_path() . '/public/'.CATEGORIE_IMAGE.$imageArr->image;
                if (file_exists($images_path)) {
                    @unlink($images_path);
                }
            }

            $image_name = time().'.'.$image->getClientOriginalExtension();
            $image->move(base_path() . '/public/'.CATEGORIE_IMAGE, $image_name);
            $imageUpdate = array(
                'image' => $image_name,
            );
            ContractCategories::where('id', $id)->update($imageUpdate);
        }  

        $team = ContractCategories::find($id);
        $team->categories_name = $request->categories_name;
        $team->status = isset($request->status)?1:0;
        $team->save();
        alert()->success('Contract category updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/categories_management');
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
        SubCategories::where('categories_id',$id)->delete();
        ContractCategories::find($id)->delete();
        
        alert()->success('Contract category deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/categories_management');
    }
}
