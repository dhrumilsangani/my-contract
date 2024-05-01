<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ContentManagementController extends Controller
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
        @Date   : 04/01/2022
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_content_managemnet.js";

        $dataQuery = Content::select("id",'title','content','content_slug','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('title', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.content.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function create(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_content_managemnet.js";
        
        return view('admin.content.add', compact('request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            //'content' => 'required',
        ]);
        
        $content = new Content();
        $content->title = $request->title;
        $content->content = $request->content;
        $content->content_slug = $request->content_slug;
        $content->status = isset($request->status)?1:0;
        $content->save();
        
        alert()->success('Content created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/content_management')->with('success', 'Content created successfully!');
    }

    /*
        @Author : Ritesh Rana
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
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function edit(Request $request,$id)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_content_managemnet.js";

        $content = Content::find($id);
        return view('admin.content.edit', compact('request','content','footerJs'));
    }

    
    /*
        @Author : Ritesh Rana
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
        ]);
        
        $content = Content::find($id);
        $content->title = $request->title;
        $content->content = $request->content;
        $content->status = isset($request->status)?1:0;
        $content->save();

        alert()->success('Content updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/content_management');
    }

}
