<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialsManagementController extends Controller
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
        $footerJs[1]    = "admin/customJs/admin_testimonial_managemnet.js";

        $dataQuery = Testimonials::select("id",'title','name','image','positions','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('title', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.testimonials.index', compact('data','request','footerJs'));
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
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_testimonial_managemnet.js";
        
        return view('admin.testimonials.add', compact('request','footerJs'));
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
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
            //'positions' => 'required',
        ]);
        $file_name = "";
        $document_file = $request->image;
        if(!empty($document_file)){
            $file_name = time().'.'.$document_file->getClientOriginalExtension();
            $destinationPath = public_path(config('constants.testimonialPath'));
            $document_file->move($destinationPath, $file_name);
        }
        
        $testimonial = new Testimonials();
        $testimonial->title = $request->title;
        $testimonial->name = $request->name;
        //$testimonial->positions = $request->positions;
        $testimonial->image = $file_name;
        $testimonial->status = isset($request->status)?1:0;
        $testimonial->save();
        alert()->success('Testimonial created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/testimonial_management')->with('success', 'Testimonial created successfully!');
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
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_testimonial_managemnet.js";

        $testimonial = Testimonials::find($id);
        return view('admin.testimonials.edit', compact('request','testimonial','footerJs'));
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
        $input = $request->all();
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
            //'image' => 'required',
            //'positions' => 'required',
        ]);


        $file = $request->file('image');

			if(!empty($file)){

				$fileArr = Testimonials::select('image')->where(array('id'=>$id))->first();
                if(!empty($fileArr)){
					$image_path = base_path() . '/public/'.TESTIMONIAL_IMAGE.$fileArr->image;
                    if (file_exists($image_path)) {
						@unlink($image_path);
					}
				}

				$file_name = time().'.'.$file->getClientOriginalExtension();
                $file->move(base_path() . '/public/'.TESTIMONIAL_IMAGE, $file_name);
                $document = array(
					'image' =>   $file_name,
				);
                Testimonials::where('id', $id)->update($document);
			}

        $testimonial = Testimonials::find($id);
        $testimonial->title = $request->title;
        $testimonial->name = $request->name;
        //$testimonial->positions = $request->positions;
        $testimonial->status = isset($request->status)?1:0;
        $testimonial->save();
        alert()->success('Testimonial updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/testimonial_management');
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
        $category = Testimonials::find($id)->delete();
        alert()->success('Testimonial deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/testimonial_management');
    }
}
