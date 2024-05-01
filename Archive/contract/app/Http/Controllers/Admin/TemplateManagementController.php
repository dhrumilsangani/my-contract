<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\ContractCategories;
use App\Models\SubCategories;
use App\Models\Template;
use App\Models\TemplateForm;
use DB;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;

class TemplateManagementController extends Controller
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
        $dataQuery = Template::select('template.status','template.template_name','template.id','template.form_json_data','contract.title','contract.contract_detail')
			->join('contract','contract.id','=','template.contract_id');
            if ($request->has('search_by_text') && $request->search_by_text != '') {
                $dataQuery->where('contract.title', 'like', '%' . $request->search_by_text . '%');
            }
        $data = $dataQuery->where('template.status',1)->orderBy('template.id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.template.index', compact('data','request'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 02/06/2021
    */
    public function templatePageCreate(Request $request)
    {
        $headerCss[0] = "admin/css/demo.css";

        $footerJs[0]    = "admin/js/formbuilder/assets/js/vendor.js";
        $footerJs[1]    = "admin/js/formbuilder/assets/js/form-builder.min.js";
        $footerJs[2]    = "admin/js/formbuilder/assets/js/form-render.min.js";
        $footerJs[3]    = "admin/js/formbuilder/assets/js/demo.js";
        $footerJs[4]    = "admin/js/jquery.validate.min.js";
        $footerJs[5]    = "admin/customJs/admin_template_managemnet.js";

        $contracts = Contract::get();
		$categories = ContractCategories::select('contract_categories.id','contract_categories.categories_name')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->join('contract','contract.sub_category_id','=','sub_categories.id')
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->where('contract.status',1)
			->groupBy('sub_categories.categories_id')
            ->orderBy('contract_categories.categories_name', 'asc')
			->get();
        return view('admin.template.add', compact('contracts','categories','footerJs','headerCss'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Get subcategory from parent categort id.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
	
	public function getSubCategoryFromParent(Request $request)
    {
		$categoryId = $request->input('category_id');
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
        @Desc   : Get contract from category id and sub categort id.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
	
	public function getContactFromCatAndSubCat(Request $request)
    {
		$categoryId = $request->category_id;
		$subCategoryId = $request->sub_category_id;
		$data = ContractCategories::select('contract.id','contract.title')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->join('contract','contract.sub_category_id','sub_categories.id')
			->where('sub_categories.categories_id',$request->category_id)
			->where('contract.sub_category_id',$request->sub_category_id)
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->where('contract.status',1)
			//->groupBy('sub_categories.categories_id')
			->get();
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
            'template_name' => 'required',
            'position_no' => 'required',
        ]);

        $form_json_data = strip_tags($request->form_json_data);
        $jsonData = json_decode($form_json_data, TRUE);
        $fields = array();
        $jsonDataUpdated = array();
        $n = 0;
        foreach ($jsonData as $row) {
            foreach ($row as $key => $value) {
                if ($key == 'name') {
                    $jsonDataUpdated[$n][$key] = str_replace('-', '_', $value);
                } else {
                    $jsonDataUpdated[$n][$key] = $value;
                }
                $jsonDataUpdated[$n][$key] = str_replace(array("'", '"'), "", $jsonDataUpdated[$n][$key]);
            }
            $n++;
        }
       
        /*start store form json data*/ 
        $tempData = new Template();
        $tempData->category_id = $request->category_id;
        $tempData->sub_category_id = $request->sub_category_id;
        $tempData->position_no = $request->position_no;
        $tempData->template_name = $request->template_name;
        $tempData->contract_id = $request->contract_name;
        $tempData->form_json_data = json_encode($jsonDataUpdated);
        $tempData->save();

    /*start store form json data*/ 
       /* start create array useing input type*/
       $metaVal= '';
        foreach ($jsonDataUpdated as $key=>$value) {
                if($value['type'] == 'checkbox-group'){
                    if(isset($value['values']) && !empty($value['values'])){
                        $meta_check['options'] = $value['values'];
                    }
                    if(!empty($meta_check)){
                        $metaVal= json_encode($meta_check);
                    }
                    $fields[$key]= array(
                            'type' => $value['type'], 
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0,  
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );
                } else if ($value['type'] == 'date') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $meta_date['placeholder'] = $value['placeholder'];
                    }
                    if(!empty($meta_date)){
                        $metaVal= json_encode($meta_date);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'], 
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'file') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaFile['placeholder'] = $value['placeholder'];
                    }
                    if(isset($value['multiple']) && !empty($value['multiple'])){
                        $metaFile['multiple'] = $value['multiple'];
                    }
                    if(!empty($metaFile)){
                        $metaVal= json_encode($metaFile);
                    }
                    
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'header') {
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaHeader['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaHeader)){
                        $metaVal= json_encode($metaHeader);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                }else if ($value['type'] == 'paragraph') {
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaPara['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaPara)){
                        $metaVal= json_encode($metaPara);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'number') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaNumber['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['min']) && !empty($value['min'])){
                        $metaNumber['min'] = $value['min'];
                    }
                    
                    if(isset($value['man']) && !empty($value['man'])){
                        $metaNumber['man'] = $value['man'];
                    }
                    if(!empty($metaNumber)){
                        $metaVal= json_encode($metaNumber);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'radio-group') {
                    if(isset($value['values']) && !empty($value['values'])){
                        $metaOpt['options'] = $value['values'];
                    }
                    if(!empty($metaOpt)){
                        $metaVal= json_encode($metaOpt);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => isset($value['label']) && !empty($value['label']) ? $value['label'] : '',
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'select') {
                    if(isset($value['values']) && !empty($value['values'])){
                        $metaSel['options'] = $value['values'];
                    }
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaSel['placeholder'] = $value['placeholder'];
                    }
                    if(!empty($metaSel)){
                        $metaVal= json_encode($metaSel);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'], 
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'text') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaText['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['maxlength']) && !empty($value['maxlength'])){
                        $metaText['maxlength'] = $value['maxlength'];
                    }
                    
                    if(isset($value['man']) && !empty($value['man'])){
                        $metaText['man'] = $value['man'];
                    }

                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaText['subtype'] = $value['subtype'];
                    }
                    if(!empty($metaText)){
                        $metaVal= json_encode($metaText);
                    }

                    $fields [$key]= array(
                        'type' => $value['type'], 
                        'name' => $value['name'], 
                        'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                        'label' => $value['label'],
                        'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'textarea') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaTextarea['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['maxlength']) && !empty($value['maxlength'])){
                        $metaTextarea['maxlength'] = $value['maxlength'];
                    }

                    if(isset($value['rows']) && !empty($value['rows'])){
                        $metaTextarea['rows'] = $value['rows'];
                    }
                   
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaTextarea['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaTextarea)){
                        $metaVal= json_encode($metaTextarea);
                    }
                    $fields [$key]= array(
                        'type' => $value['type'], 
                        'name' => $value['name'], 
                        'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                        'label' => $value['label'],
                        'meta' => $metaVal,
                    );    
                }   
            }
    /* End create array useing input type*/
        //dd($fields);
        /*Start store form data*/ 
            if(!empty($fields)){
                foreach($fields as $field){
                    $temp = new TemplateForm();
                    $temp->contract_id = $request->contract_name;
                    $temp->template_id = $tempData->id;
                    if(!empty($field['label'])){
                        $temp->label = $field['label'];
                    }
                    if(!empty($field['name'])){
                        $temp->name = $field['name'];
                    }
                    if(!empty($field['type'])){
                        $temp->type = $field['type'];
                    }
                    if(!empty($field['meta'])){
                        $temp->meta = $field['meta'];
                    }
                    if(!empty($field['required'])){
                        $temp->is_required = $field['required'];
                    }
                    $temp->save();
                }
            }
            /*End store form data*/ 
           
        alert()->success('Template added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/template_management');
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
        $contractDetail = ContractData::where('template_id',$id)->get();
        // if(count($contractDetail) != 0){
        //     return redirect('/admin/template_management')->with('error', "Sorry you can't edit this template because contract already created");
        // }

        $headerCss[0]   = "admin/css/demo.css";
        $footerJs[0]    = "admin/js/formbuilder/assets/js/vendor.js";
        $footerJs[1]    = "admin/js/formbuilder/assets/js/form-builder.min.js";
        $footerJs[2]    = "admin/js/formbuilder/assets/js/form-render.min.js";
        $footerJs[3]    = "admin/js/formbuilder/assets/js/demo.js";
        //$footerJs[4]    = "admin/js/jquery.validate.min.js";
        $footerJs[5]    = "admin/customJs/admin_template_managemnet.js";

        $contracts = Contract::get();
		
		$getFormData = Template::select('template.category_id','template.position_no','template.sub_category_id','template.template_name','template.contract_id','template.status','template.id','template.form_json_data','contract.title','contract.contract_detail')
            ->join('contract','contract.id','=','template.contract_id')->where('template.id',$id)->first();
			
		$categories = DB::table('contract_categories')
			->select('contract_categories.id','contract_categories.categories_name')
			->join('sub_categories','sub_categories.categories_id','=','contract_categories.id')
			->where('contract_categories.status',1)
			->where('sub_categories.status',1)
			->groupBy('sub_categories.categories_id')
            ->orderBy('contract_categories.categories_name', 'asc')
			->get();
		
		$subcategory = SubCategories::where(['categories_id' => $getFormData->category_id, 'status' => 1])->orderBy('sub_categories_name', 'asc')->get();
		
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
			
        return view('admin.template.edit', compact('contracts','categories', 'subcategory','contractRs','footerJs','headerCss','getFormData','id'));
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

        return view('admin.template.view', compact('contracts','footerJs','headerCss','getFormData','id'));
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
        // $request->validate([
        //     'contract_name' => 'required',
        // ]);

        $form_json_data = strip_tags($request->form_json_data);
        $jsonData = json_decode($form_json_data, TRUE);
        $fields = array();
        $jsonDataUpdated = array();
        $n = 0;
        foreach ($jsonData as $row) {
            foreach ($row as $key => $value) {
                if ($key == 'name') {
                    $jsonDataUpdated[$n][$key] = str_replace('-', '_', $value);
                } else {
                    $jsonDataUpdated[$n][$key] = $value;
                }
                $jsonDataUpdated[$n][$key] = str_replace(array("'", '"'), "", $jsonDataUpdated[$n][$key]);
            }
            $n++;
        }
       
        /*start update form json data*/ 
        $tempData = Template::find($request->form_id);
        $tempData->category_id = $request->category_id;
        $tempData->sub_category_id = $request->sub_category_id;
        $tempData->template_name = $request->template_name;
        $tempData->contract_id = $request->contract_name;
        $tempData->position_no = $request->position_no
        ;
        $tempData->form_json_data = json_encode($jsonDataUpdated);
        $tempData->save();

        
    /*start store form json data*/ 
       /* start create array useing input type*/
       $metaVal= '';
        foreach ($jsonDataUpdated as $key=>$value) {
                if($value['type'] == 'checkbox-group'){
                    if(isset($value['values']) && !empty($value['values'])){
                        $meta_check['options'] = $value['values'];
                    }
                    if(!empty($meta_check)){
                        $metaVal= json_encode($meta_check);
                    }
                    $fields[$key]= array(
                            'type' => $value['type'], 
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0,  
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );
                } else if ($value['type'] == 'date') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $meta_date['placeholder'] = $value['placeholder'];
                    }
                    if(!empty($meta_date)){
                        $metaVal= json_encode($meta_date);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'], 
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'file') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaFile['placeholder'] = $value['placeholder'];
                    }
                    if(isset($value['multiple']) && !empty($value['multiple'])){
                        $metaFile['multiple'] = $value['multiple'];
                    }
                    if(!empty($metaFile)){
                        $metaVal= json_encode($metaFile);
                    }
                    
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'header') {
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaHeader['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaHeader)){
                        $metaVal= json_encode($metaHeader);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                }else if ($value['type'] == 'paragraph') {
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaPara['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaPara)){
                        $metaVal= json_encode($metaPara);
                    }
                    $fields [$key]= array(
                            'type' => $value['type'],
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'number') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaNumber['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['min']) && !empty($value['min'])){
                        $metaNumber['min'] = $value['min'];
                    }
                    
                    if(isset($value['man']) && !empty($value['man'])){
                        $metaNumber['man'] = $value['man'];
                    }
                    if(!empty($metaNumber)){
                        $metaVal= json_encode($metaNumber);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'radio-group') {
                    if(isset($value['values']) && !empty($value['values'])){
                        $metaOpt['options'] = $value['values'];
                    }
                    if(!empty($metaOpt)){
                        $metaVal= json_encode($metaOpt);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'],
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'select') {
                    if(isset($value['values']) && !empty($value['values'])){
                        $metaSel['options'] = $value['values'];
                    }
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaSel['placeholder'] = $value['placeholder'];
                    }
                    if(!empty($metaSel)){
                        $metaVal= json_encode($metaSel);
                    }

                    $fields [$key]= array(
                            'type' => $value['type'],
                            'name' => $value['name'], 
                            'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                            'label' => $value['label'],
                            'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'text') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaText['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['maxlength']) && !empty($value['maxlength'])){
                        $metaText['maxlength'] = $value['maxlength'];
                    }
                    
                    if(isset($value['man']) && !empty($value['man'])){
                        $metaText['man'] = $value['man'];
                    }

                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaText['subtype'] = $value['subtype'];
                    }
                    if(!empty($metaText)){
                        $metaVal= json_encode($metaText);
                    }

                    $fields [$key]= array(
                        'type' => $value['type'], 
                        'name' => $value['name'], 
                        'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                        'label' => $value['label'],
                        'meta' => $metaVal,
                    );    
                } else if ($value['type'] == 'textarea') {
                    if(isset($value['placeholder']) && !empty($value['placeholder'])){
                        $metaTextarea['placeholder'] = $value['placeholder'];
                    }

                    if(isset($value['maxlength']) && !empty($value['maxlength'])){
                        $metaTextarea['maxlength'] = $value['maxlength'];
                    }

                    if(isset($value['rows']) && !empty($value['rows'])){
                        $metaTextarea['rows'] = $value['rows'];
                    }
                   
                    if(isset($value['subtype']) && !empty($value['subtype'])){
                        $metaTextarea['subtype'] = $value['subtype'];
                    }

                    if(!empty($metaTextarea)){
                        $metaVal= json_encode($metaTextarea);
                    }
                    $fields [$key]= array(
                        'type' => $value['type'], 
                        'name' => $value['name'], 
                        'required' => isset($value['required']) && !empty($value['required']) ? $value['required'] : 0, 
                        'label' => $value['label'],
                        'meta' => $metaVal,
                    );    
                }   
            }
        /* End create array useing input type*/
        $contractDetail = ContractData::where('template_id',$request->form_id)->get();
        if(count($contractDetail) != 0){
            $editField['status'] = 0;
            TemplateForm::where('template_id', $request->form_id)->update($editField);
        }else{
            TemplateForm::where('template_id', $request->form_id)->delete();
        }
        /*Start store form data*/ 
            if(!empty($fields)){
                foreach($fields as $field){
                    $temp = new TemplateForm();
                    $temp->contract_id = $request->contract_name;
                    $temp->template_id = $tempData->id;
                    if(!empty($field['label'])){
                        $temp->label = $field['label'];
                    }
                    if(!empty($field['name'])){
                        $temp->name = $field['name'];
                    }
                    if(!empty($field['type'])){
                        $temp->type = $field['type'];
                    }
                    if(!empty($field['meta'])){
                        $temp->meta = $field['meta'];
                    }
                    if(!empty($field['required'])){
                        $temp->is_required = $field['required'];
                    }
                    $temp->save();
                }
            }
            /*End store form data*/ 
           
        alert()->success('Template updated successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/template_management');
    }
}
