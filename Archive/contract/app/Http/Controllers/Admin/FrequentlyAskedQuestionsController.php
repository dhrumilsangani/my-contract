<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class FrequentlyAskedQuestionsController extends Controller
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
        @Date   : 01/06/2021
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/customJs/frequently_asked_questions.js";

        $dataQuery = FrequentlyQuestions::select('frequently_questions.id','frequently_questions.questions','template.status','template.template_name','contract.title')
			->join('contract','contract.id','=','frequently_questions.contract_id')
            ->join('template','template.id','=','frequently_questions.template_id');
            if ($request->has('search_by_text') && $request->search_by_text != '') {
                $dataQuery->where('frequently_questions.questions', 'like', '%' . $request->search_by_text . '%');
            }
        $data = $dataQuery->orderBy('frequently_questions.id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.questions.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 02/06/2021
    */
    public function questionsCreate(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/frequently_asked_questions.js";

        $contracts = Contract::get();
		$categories = ContractCategories::select('contract_categories.id','contract_categories.categories_name')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->join('contract','contract.sub_category_id','=','sub_categories.id')
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->where('contract.status',1)
			->groupBy('sub_categories.categories_id')
			->get();
        return view('admin.questions.add', compact('contracts','categories','footerJs'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Get subcategory from parent categort id.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
	
	public function getTemplate(Request $request)
    {
		$contractId = $request->input('contract_id');
		$data = Template::where(['contract_id' => $contractId, 'status' => 1])->get();
		
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
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'contract_name' => 'required',
            'template_id' => 'required',
            'questions' => 'required',
            'description' => 'required',
        ]);
       
        /*start store form json data*/ 
        $tempData = new FrequentlyQuestions();
        $tempData->category_id = $request->category_id;
        $tempData->sub_category_id = $request->sub_category_id;
        $tempData->contract_id = $request->contract_name;
        $tempData->template_id = $request->template_id;
        $tempData->questions = $request->questions;
        $tempData->description = $request->description;
        $tempData->save();
           
        alert()->success('Questions added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/frequently_questions');
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 24/06/2021
    */
    public function edit(Request $request,$id)
    {   
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/frequently_asked_questions.js";

        $contracts = Contract::get();
		
		$getFormData = FrequentlyQuestions::select('frequently_questions.category_id','frequently_questions.sub_category_id','frequently_questions.template_id','frequently_questions.contract_id','frequently_questions.id','frequently_questions.questions','frequently_questions.description')
            ->join('contract','contract.id','=','frequently_questions.contract_id')
            ->join('template','template.id','=','frequently_questions.template_id')
            ->where('frequently_questions.id',$id)->first();
			
		$categories = DB::table('contract_categories')
			->select('contract_categories.id','contract_categories.categories_name')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->groupBy('sub_categories.categories_id')
			->get();
		
		$subcategory = SubCategories::where(['categories_id' => $getFormData->category_id, 'status' => 1])->get();
		
        $templates = Template::where('contract_id',$getFormData->contract_id)->get();
        
		$contractRs = ContractCategories::select('contract.id','contract.title')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->join('contract','contract.sub_category_id','sub_categories.id')
			->where('sub_categories.categories_id',$getFormData->category_id)
			->where('contract.sub_category_id',$getFormData->sub_category_id)
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->where('contract.status',1)
			//->groupBy('sub_categories.categories_id')
			->get();
			
        return view('admin.questions.edit', compact('templates','contracts','categories', 'subcategory','contractRs','footerJs','getFormData','id'));
    }

     /*
        @Author : Ritesh Rana
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 16/07/2021
    */
    public function view(Request $request,$id)
    {
        $contractDetail = ContractData::where('template_id',$id)->get();
        // if(count($contractDetail) != 0){
        //     return redirect('/admin/template_management')->with('error', "Sorry you can't edit this template because contract already created");
        // }

        $headerCss[0]   = "admin/css/demo.css";
        $footerJs[0]    = "admin/js/formbuilder/assets/js/vendor.js";
        $footerJs[1]    = "admin/js/formbuilder/assets/js/form-builder.min.js";
        $footerJs[2]    = "admin/js/formbuilder/assets/js/form-render.min.js";
        $footerJs[3]    = "admin/js/formbuilder/assets/js/demo.js";
        $footerJs[4]    = "admin/js/jquery.validate.min.js";
        
        $contracts = Contract::get();

        $getFormData = Template::select('template.contract_id','template.position_no','template.status','template.id','template.form_json_data','contract.title','contract.contract_detail')
            ->join('contract','contract.id','=','template.contract_id')->where('template.id',$id)->first();

        return view('admin.questions.view', compact('contracts','footerJs','headerCss','getFormData','id'));
    }
    
    

    /*
        @Author : Ritesh Rana
        @Desc   : Update the specified resource in storage.
        @Input  : \Illuminate\Http\Request  $request and int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 24/06/2021
    */
    public function update(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'contract_name' => 'required',
            'template_id' => 'required',
            'questions' => 'required',
            'description' => 'required',
        ]);
        /*start update form json data*/ 
        $tempData = FrequentlyQuestions::find($request->questions_id);
        $tempData->category_id = $request->category_id;
        $tempData->sub_category_id = $request->sub_category_id;
        $tempData->contract_id = $request->contract_name;
        $tempData->template_id = $request->template_id;
        $tempData->questions = $request->questions;
        $tempData->description = $request->description;
        $tempData->save();

        alert()->success('Questions updated successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/frequently_questions');
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
        FrequentlyQuestions::find($id)->delete();
        alert()->success('Questions deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/frequently_questions');
    }
}
