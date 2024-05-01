<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contract;
use App\Models\ContractCategories;
use App\Models\SubCategories;
use App\Models\Template;
use Auth;
use DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;

class ContractManagementController extends Controller
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
        //$footerJs[1]    = "admin/js/additional-methods.js";
        $footerJs[1]    = "admin/customJs/admin_contract_managemnet.js";

        $dataQuery = Contract::select("id",'title','contract_detail','status','created_at');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('title', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        //$currentUserData = User::find(Auth::id()); 
        return view('admin.contract.index', compact('data','request','footerJs'));
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
        //$footerJs[1]    = "admin/js/additional-methods.js";
        $footerJs[1]    = "admin/customJs/admin_contract_managemnet.js";
        //$categories = ContractCategories::where('status',1)->get();
		$categories = DB::table('contract_categories')
			->select('contract_categories.id','contract_categories.categories_name')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->groupBy('sub_categories.categories_id')
            ->orderBy('contract_categories.categories_name', 'asc')
			->get();
        return view('admin.contract.add', compact('categories','request','footerJs'));
    }
	
	/*
        @Author : Ritesh Rana
        @Desc   : Get subcategory from parent categort id.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 23/11/2021
    */
	
	public function getSubCategoryFromParent(Request $request)
    {
		$categoryId = $request->input('categoriesId');
		$data = SubCategories::where(['categories_id' => $categoryId, 'status' => 1])->orderBy('sub_categories_name', 'asc')->get();
		
		$response = json_encode([
			'result' => 'success',
			'stausCode' => 200,
			'message' => 'Sub category details',
			'data' => $data
		],true);
		return $response;
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
            //'contract_detail' => 'required',
            'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'contract_file' => 'required|mimes:docx',
            //'image' => 'mimes:jpeg,jpg,png,gif|required',
        ]);
        
        $document_file = $request->contract_file;
        $file_name = time().'.'.$document_file->getClientOriginalExtension();
        $destinationPath = public_path(config('constants.uploadPath'));
        $document_file->move($destinationPath, $file_name);


        // $contract_image = $request->image;
        // $image_name = time().'.'.$contract_image->getClientOriginalExtension();
        // $destinationImgPath = public_path(config('constants.contractImagePath'));
        // $contract_image->move($destinationImgPath, $image_name);
        

        $contract = new Contract();
        $contract->title = $request->title;
        $contract->category_id = $request->categories_id;
        $contract->sub_category_id = $request->sub_categories_id;
        $contract->contract_detail = $request->contract_detail;
        $contract->contract_faq = $request->contract_faq;
        $contract->status = isset($request->status)?1:0;
        $contract->contract_file = $file_name;
        //$contract->image = $image_name;
        
        $contract->save();

        alert()->success('Contract created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/contract_management');
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
        //$footerJs[1]    = "admin/js/additional-methods.js";
        $footerJs[1]    = "admin/customJs/admin_contract_managemnet.js";

        $contract = Contract::find($id);
		$categories = array();
		$subcategory = array();
		if(!empty($contract->category_id)){
			$categories = DB::table('contract_categories')
				->select('contract_categories.id','contract_categories.categories_name')
				->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
				->where('contract_categories.status',1)
				->where('sub_categories.status',1)
				->groupBy('sub_categories.categories_id')
                ->orderBy('contract_categories.categories_name', 'asc')
				->get();
			$subcategory = SubCategories::where(['categories_id' => $contract->category_id, 'status' => 1])->orderBy('sub_categories_name', 'asc')->get();
		}
        return view('admin.contract.edit', compact('request','contract','categories','subcategory','footerJs'));
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
            //'contract_detail' =>'required',
			'categories_id' => 'required',
            'sub_categories_id' => 'required',
            'contract_file' => 'mimes:docx',
        ]);

        
        $file = $request->file('contract_file');

			if(!empty($file)){

				$fileArr = Contract::select('contract_file')->where(array('id'=>$id))->first();
				if(!empty($fileArr)){
					$image_path = base_path() . '/public/'.DOCUMENT_FILE.$fileArr->contract_file;
					if (file_exists($image_path)) {
						@unlink($image_path);
					}
				}

				$file_name = time().'.'.$file->getClientOriginalExtension();
				$file->move(base_path() . '/public/'.DOCUMENT_FILE, $file_name);
                $document = array(
					'contract_file' =>   $file_name,
				);
                Contract::where('id', $id)->update($document);
			}


            // $image = $request->file('image');

			// if(!empty($image)){
            // 	$imageArr = Contract::select('image')->where(array('id'=>$id))->first();
            //     if(!empty($imageArr)){
			// 		$images_path = base_path() . '/public/'.CONTRACT_IMAGE.$imageArr->image;
            //         if (file_exists($images_path)) {
			// 			@unlink($images_path);
			// 		}
			// 	}

			// 	$image_name = time().'.'.$image->getClientOriginalExtension();
            //     $image->move(base_path() . '/public/'.CONTRACT_IMAGE, $image_name);
            //     $imageUpdate = array(
			// 		'image' => $image_name,
			// 	);
            //     Contract::where('id', $id)->update($imageUpdate);
			// }    

        $contract = Contract::find($id);
        $contract->title = $request->title;
		$contract->category_id = $request->categories_id;
        $contract->sub_category_id = $request->sub_categories_id;
        $contract->contract_detail = $request->contract_detail;
        $contract->contract_faq = $request->contract_faq;
        $contract->status = isset($request->status)?1:0;
        $contract->save();

        $temps = Template::where('contract_id', $id)->get();
        if(!empty($temps)){
            foreach($temps as $temp){
                $templateEdit = isset($request->status)?1:0;
                Template::where('id',$temp->id)->update(['status' => $templateEdit]);
            }
        }
        alert()->success('Contract updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/contract_management');
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

        Contract::find($id)->delete();
        $temp = Template::where('contract_id', $id)->first();
        if(!empty($temp)){
            $templateEdit['status'] = 0;
            $temp->update($templateEdit);
        }
        alert()->success('Contract deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/contract_management');
    }


    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function changeDocData($id)
    {
        $category = Contract::where('id',$id)->first();
        $path = base_path() . '/public/'.DOCUMENT_FILE.$category->contract_file;
        $newFilePath = CREATE_DOCUMENT_FILE. 'newDoc.docx';
        
        $setval = array(
            'firstname' => 'John',
            'lastname' => 'Doe'
        );

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //$templateProcessor->setValues('{name}', 'ritesh rana');
        $templateProcessor->setValue('{name}', 'ritesh rana');
        $templateProcessor->saveAs($newFilePath);

        /* start Create PDF file*/
        $inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.'newDoc.docx';
        /*@ If already PDF exists then delete it */
        
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        /* Set the PDF Engine Renderer Path */
        $Content = \PhpOffice\PhpWord\IOFactory::load($inputfile); 
        
        //Save it into PDF
        $savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.'new-result.pdf';
        
        /*@ If already PDF exists then delete it */
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }

        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        $PDFWriter->save($savePdfPath);
        return Response::download($savePdfPath);
    }

}
