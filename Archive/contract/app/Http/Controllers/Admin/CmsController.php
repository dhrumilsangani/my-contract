<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsPage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CmsController extends Controller
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
        @Date   : 17/05/2021
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_cms_pages.js";

//        $cms_pages = CmsPage::orderBy('id', 'DESC')->get();
        if(isset($request->search_by_page_title)){
            $cms_pages = CmsPage::where('page_title','like','%'.$request->search_by_page_title.'%')->paginate(Config::get('constants.LIST_PER_PAGE'));
        }else{
            $cms_pages = CmsPage::orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        }
        return view('admin.cms_pages.index',compact('cms_pages','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function create()
    { 
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_cms_pages.js";
        return view('admin.cms_pages.add', compact('footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Store a newly created resource in storage.
        @Input  : 
        @Output : \Illuminate\Http\Request  $request
        @Date   : 17/05/2021
    */
    public function store(Request $request)
    {
            $request->validate([
                'page_title' => 'required',
            ]);
            $cms_page = new CmsPage;
            $cms_page->page_title=$request->page_title;
            $cms_page->page_content=$request->page_content;
            $cms_page->page_slug = $request->page_slug;
            $cms_page->status=isset($request->status)?1:0;
            $cms_page->save();
            alert()->success('Cms page added successfully!')->showConfirmButton('Ok', '#07689f');
            return redirect('/admin/cms_pages');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display the specified resource.
        @Input  : 
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
        @Date   : 17/05/2021
    */
    public function edit($id)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_cms_pages.js";

        $cms_page=CmsPage::find($id);
        return view('admin.cms_pages.edit',compact("cms_page","footerJs"));
    }


     /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function update(Request $request, $id)
    {
        
            $request->validate([
            'page_title' => 'required',
            ]);
            $cms_page = CmsPage::where('id',$id)->first();
            $cms_data['page_title']=$request->page_title;
            $cms_data['page_content']=$request->page_content;
            $cms_data['page_slug'] = $request->page_slug;
            $cms_data['status']=isset($request->status)?1:0;
            $cms_page->update($cms_data);

            alert()->success('Cms page updated successfully!')->showConfirmButton('Ok', '#07689f');
            return redirect('/admin/cms_pages');
    }

     /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function destroy($id)
    {
        $category = CmsPage::find($id)->delete();
        alert()->success('Cms page deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/cms_pages');
    }

      /*
        @Author : Ritesh Rana
        @Desc   : check Slug.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function checkSlug(Request $request)
	{   
        $slug = Str::slug($request->page_title);
        $slug = SlugService::createSlug(CmsPage::class, 'page_slug', $request->page_title);
        return response()->json(['slug' => $slug]);
	}
}
