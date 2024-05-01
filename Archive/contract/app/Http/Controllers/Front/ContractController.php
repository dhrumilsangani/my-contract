<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AmendAgreement;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\ContractCategories;
use App\Models\Template;
use App\Models\TemplateForm;
use App\Models\TemplateFieldData;
use App\Models\ContractData;
use App\Models\SubCategories;
use App\Models\Subscription;
use Thumbnail;
use Validator;
use Illuminate\Support\Facades\Response;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use PDF;
use App\Traits\SendMail;

class ContractController extends Controller
{
    use SendMail;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /*
        @Author : Ritesh Rana
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 02/05/2021
    */
    public function index()
    {
        /* Start get contract data */
        //$contracts = Contract::where('status',1)->get();
        /* End get contract data */

        $contracts = Template::select('template.status','template.id','template.form_json_data','contract.contract_faq','contract.title','contract.contract_detail')
        ->join('contract','contract.id','=','template.contract_id')
        ->where('template.status',1)->orderBy('template.id', 'DESC')
        ->get();
        
        /* check Subscription*/
        $check = checkSubscription();
        return view('front.contract_list', compact('contracts','check'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display created contract listing.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 03/05/2021
    */
    public function createdContractList(Request $request)
    {
        /* Start get contract data */
        // $contractData = ContractData::with('contract')->select(['contract_name','id','template_id','contract_id','created_at'])
        //     ->leftJoin('contract', 'contract.id', '=', 'contract_data.contract_id')
        //     ->where('created_by',Auth::user()->id)
        //     ->orderBy('id', 'DESC')
        //     ->get();
        $contracts = ContractData::select(['contract_data.contract_name','contract_data.id','contract_data.template_id','contract_data.contract_id','contract_data.created_at','contract.title'])
            ->leftJoin('contract', 'contract.id', '=', 'contract_data.contract_id')
            ->where('created_by',Auth::user()->id);
            if ($request->has('search_by_name') && $request->search_by_name != '') {
                $contracts->where((function($custQ) use($request){
                       $custQ->orWhere('contract.title', 'like', '%' . $request->search_by_name . '%');
                       $custQ->orWhere('contract_data.created_at', 'like', '%' . $request->search_by_name . '%');
                }));
            }
            $contractData = $contracts->orderBy('id', 'DESC')->get();
            // echo "<pre>";
            // print_r($contractData);exit;
        /* End get contract data */

        /* check Subscription*/
        $check = checkSubscription();
        return view('front.user_contract_list', compact('contractData','check'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Edit contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/05/2021
    */
    public function editContract($id)
    {
        /* start add css */
            $headerCss[0] = "front/css/jquery.datetimepicker.min.css";
            $headerCss[1] = "front/css/parsley.css";
        /* End add css */
        /* start add js */
            $footerJs[0]    = "front/js/jquery.datetimepicker.js";
            $footerJs[1]    = "front/js/parsley.min.js";
            $footerJs[2]    = "front/js/parsley-fields-comparison-validators.js";
            $footerJs[3]    = "front/customJs/template_frm.js";
        /* End add js */    
        // /* Start get contract data */
        // $contractData = ContractData::select(['contract_name','id','template_id','contract_id','created_at'])
        //     ->where('id',$id)
        //     ->first();
        // /* End get contract data */

        // /* Start get Template Field Data */
        // $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
        //     ->where('contract_data_id',$id)
        //     ->get();

        // /* End get Template Field Data */
        
        // /* Start get Template Form Data */
        // $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')
        //     ->where('template_id',$contractData->template_id)
        //     ->get();
            
        // /* End get Template Form Data */

        // /* start get contract data*/    
        
        // $contractDetail = Contract::where('id',$contractData->contract_id)->where('status',1)->first();
        // /* End get contract data*/    
        // $user_id = Auth::user()->id;

/*new code*/
        /* Start get contract data */
        $contractData = ContractData::select(['contract_name','id','template_id','contract_id','created_at'])
            ->where('id',$id)
            ->first();
        /* End get contract data */
        if(!empty($contractData)){
            $contractDetail = Contract::where('id',$contractData->contract_id)->where('status',1)->first();
           // $template = Template::where('contract_id',$contractData->contract_id)->where('status',1)->orderBy('position_no','ASC')->get();
            $template = Template::with(['templateQuestions' => function ($q)  {
                $q->select('id','template_id','questions','description');
            }])
            ->select('template.*')
            ->where('contract_id',$contractData->contract_id)
            ->where('status',1)
            ->orderBy('position_no','ASC')
            ->get();

            if(!empty($template[0]->id)){
                /* Start get Template Field Data */
                
                $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
                    ->where('contract_data_id',$id)
                    ->where('template_id',$template[0]->id)
                    ->get();
                /* End get Template Field Data */
                /* Start get Template Form Data */
                $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')
                    ->where('template_id',$template[0]->id)
                    ->get();
                /* End get Template Form Data */
        
                /* start get contract data*/    
                $user_id = Auth::user()->id;

                $noTemplate = count($template) + 1;
                $progData = 100 / $noTemplate;
                $contract_data_id = $id;

                return view('front.edit_contract', compact('contract_data_id','progData','template_form','templateField','contractData','contractDetail','footerJs','headerCss','user_id','template'));    
            }else{
                alert()->error('Template data not found!')->showConfirmButton('Ok', '#07689f');
                return redirect('/front/user_contract_list'); 
            }
           
        }else{
            alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
            return redirect('/front/user_contract_list'); 
        }
    }

    /*
        @Author : Ritesh Rana
        @Desc   : create contract form.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/05/2021
    */
    public function contractData($id)
    {
        /* start check Subscription */
            $check = checkSubscription();
            
            if($check == 2){
                alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
                 return redirect('/front/dashboard'); 
            } 
            if($check == 0){
                alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
                return redirect('/pricing');
            }   
        /* End check Subscription */

        /* Start add css */
            $headerCss[0] = "front/css/jquery.datetimepicker.min.css";
            $headerCss[1] = "front/css/parsley.css";
        /* End add css */
        /* start add js */
            $footerJs[0]    = "front/js/jquery.datetimepicker.js";
            $footerJs[1]    = "front/js/parsley.min.js";
            $footerJs[2]    = "front/js/parsley-fields-comparison-validators.js";
            $footerJs[3]    = "front/customJs/template_frm.js";
        /* End add js */
        /* Start get template contract and template form data  */
            $template = Template::where('id',$id)->where('status',1)->first();
            if(empty($template)){
                alert()->error('Contract not found !')->showConfirmButton('Ok', '#07689f');
                return redirect('/front/dashboard'); 
            }else{
                $contractDetail = Contract::where('id',$template->contract_id)->where('status',1)->first();
                $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')->where('template_id',$template->id)->where('status',1)->get();
            /* End get template contract and template form data  */
                return view('front.contract_form', compact('template_form','template','contractDetail','footerJs','headerCss'));       
            }
         
    }
    
    
  /*
        @Author : Ritesh Rana
        @Desc   : store contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 07/05/2021
    */
    public function saveTemplateDetail(Request $request)
    {
       // dd($request->all());
    /* Start check Subscription */
        // $check = checkSubscription();
        // if($check == 2){
        //     alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
        //     return redirect('/front/dashboard'); 
        // } 
        // if($check == 0){
        //     alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
        //     return redirect('/pricing');
        // }
        
    /* End check Subscription */
    /* Start get template form data*/
        $template_form = TemplateForm::select('id','name','is_required','type')
        ->where('template_id',$request->template_id)
        ->whereNotIn('type', ['header','paragraph'])
        ->where('status',1)
        ->get();
        
    /* End get template form data*/   
    
    $template = Template::select('contract_id')->where('id',$request->template_id)->where('status',1)->first();
    $contract_id = $template->contract_id;
        
    $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
    ->where('contract_data_id',$request->contract_data_id)
    ->where('template_id',$request->template_id)
    ->get();
    
        
    if(!empty($templateField) && count($templateField) > 0){
            /*start check validation*/
            $validationArr = array();
            if(!empty($template_form)){
                foreach($template_form as $templates){
                    foreach ($templateField as $value){
                        if($value->field_id == $templates->id){   
                            if($templates->is_required == 1){
                                $validationArr[$templates->name.'_'.$templates->id.'_'.$value->id] = 'required';
                                //$validationArr[$templates->name.'_'.$templates->id] = 'required';
                            }
                        }
                    }
                }
            }   
            //dd($validationArr);
            if(!empty($validationArr)){
            $validator = Validator::make($request->all(),$validationArr);
            //check validation
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            }
            /*End check validation*/
            $input = $request->all();
            $docName = array();
                //Start update Template Field Data
                foreach($template_form as $template){
                    foreach ($templateField as $value){
                        if($value->field_id == $template->id){   
                    $fieldData = TemplateFieldData::find($value->id);
                    $fieldData['meta_key'] = $template->name;
                    if($template->type == 'checkbox-group'){
                        $fieldData['meta_value'] = implode(",",$input[$template->name.'_'.$template->id.'_'.$value->id]);
                    }else if($template->type == 'file'){
                            if (!file_exists(public_path(config('constants.templatePath').Auth::user()->id))) {
                                mkdir(public_path(config('constants.templatePath').Auth::user()->id), 0777, true);
                            }
                            if(!empty($input[$template->name.'_'.$template->id.'_'.$value->id])){
                                foreach ($input[$template->name.'_'.$template->id.'_'.$value->id] as $key => $valueData) {
                                    $file_data = $input[$template->name.'_'.$template->id.'_'.$value->id][$key];
                                    $filename =  pathinfo($file_data->getClientOriginalName(), PATHINFO_FILENAME);
                                    $profile_name = time().$key.'.'.$file_data->getClientOriginalExtension();
                                    $destinationPath = public_path(config('constants.templatePath').Auth::user()->id);
                                    $file_data->move($destinationPath, $profile_name);
                                    array_push($docName,$profile_name);
                                }
                                if(!empty($docName)){
                                    $fName = implode(",",$docName);
                                    $fieldData['meta_value'] = $fName;
                                }
                            }
                    }else if($template->type == 'date'){
                            $fieldData['meta_value'] = $input[$template->name.'_'.$template->id.'_'.$value->id];
                    }else{
                        $fieldData['meta_value'] = $input[$template->name.'_'.$template->id.'_'.$value->id];
                    }
                    $fieldData->save();
                }}}
    }else{
        /*start check validation*/
        $validationArr = array();
        if(!empty($template_form)){
            foreach($template_form as $template){
                if($template->is_required == 1){
                    $validationArr[$template->name.'_'.$template->id] = 'required';
                }
            }
        }   
        if(!empty($validationArr)){
            $validator = Validator::make($request->all(),$validationArr);
            //check validation
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        
        /*End check validation*/

            $input = $request->all();
            $next_template = $request->next_template;
        /*Start store Template Field Data*/
                foreach($template_form as $template){
                    $fieldData = new TemplateFieldData;
                    $fieldData['contract_data_id'] = $request->contract_data_id;
                    $fieldData['field_id'] = $template->id;
                    $fieldData['meta_key'] = $template->name;
                    if($template->type == 'checkbox-group'){
                        $fieldData['meta_value'] = implode(",",$input[$template->name.'_'.$template->id]);
                        $setData[$template->name] = implode(",",$input[$template->name.'_'.$template->id]);
                    }else if($template->type == 'file'){
                            if (!file_exists(public_path(config('constants.templatePath').Auth::user()->id))) {
                                mkdir(public_path(config('constants.templatePath').Auth::user()->id), 0777, true);
                            }
                            if(!empty($input[$template->name.'_'.$template->id])){
                                foreach ($input[$template->name.'_'.$template->id] as $key => $value) {

                                    $file_data = $input[$template->name.'_'.$template->id][$key];
                                    $filename =  pathinfo($file_data->getClientOriginalName(), PATHINFO_FILENAME);
                                    $profile_name = time().$key.'.'.$file_data->getClientOriginalExtension();
                                    $destinationPath = public_path(config('constants.templatePath').Auth::user()->id);
                                    $file_data->move($destinationPath, $profile_name);
                                    array_push($docName,$profile_name);
                                }

                            }
                            if(!empty($docName)){
                                $fName = implode(",",$docName);
                                $setData[$template->name] = implode(",",$docName);
                            }else{
                                $fName = "";
                            }
                        $fieldData['meta_value'] = $fName;
                    }else if($template->type == 'date'){
                        $fieldData['meta_value'] = $input[$template->name.'_'.$template->id];
                        $setData[$template->name] = $input[$template->name.'_'.$template->id];
                    }else{
                        $fieldData['meta_value'] = $input[$template->name.'_'.$template->id];
                        $setData[$template->name] = $input[$template->name.'_'.$template->id];
                    }
                    $fieldData['template_id'] = $input['template_id'];
                    $fieldData->save();
                }
            /*End store Template Field Data*/
    }
                $previous_template_id = $input['previous_template_id'];
                $prev =  $request->previous;
                $prveSign = $request->previous_data;
                if(isset($request->edit_contract_data) && $request->edit_contract_data == "edit"){
                    $eventType = $request->edit_contract_data;
                }else{
                    $eventType = "add";
                }
                
            /*click on back button save all current form data and open previous form*/ 
            if(!empty($request->previous_data) && $request->previous_data == "previous"){
                $next_template = $request->template_id;
                $template_id = $input['previous_template_id'];
                $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                $sectionsHtml = $this->getEditTemplate($template_id,$request->contract_id,$request->contract_data_id,$previous_template_id,$prev,$prveSign,$eventType);
            }else{
                /*Open next form*/
                $next_template = $request->next_template;
                $template = Template::where('id',$next_template)->where('status',1)->orderBy('position_no','ASC')->first();
                $sectionsHtml = $this->getTemplate($input['template_id'],$next_template,$request->contract_id,$request->contract_data_id,$eventType);

            }
            
            if(!empty($template)){
                $template_name = preg_replace('/\s+/', '', $template->template_name); 
                
                return response()->json(['status' => 'success', 'sectionsHtml' => $sectionsHtml,'template_name' => $template_name,'next_template' =>$next_template], 200);
            }else{
                return response()->json(['status' => 'success', 'sectionsHtml' => $sectionsHtml,'next_template' =>$next_template], 200);
            }
            // End Add Capture Fields
           
        //return redirect('/front/dashboard')->with('success', 'Contract created successfully!!');
    }

     

    /*
        @Author : Ritesh Rana
        @Desc   : Update contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 07/05/2021
    */
    public function updateTemplate(Request $request)
    {
        /* Start get template form data*/
        
        $template_form = TemplateForm::select('id','name','is_required','type')
        ->where('template_id',$request->template_id)
        ->whereNotIn('type', ['header','paragraph'])
        ->get();
        
        /* End get template form data*/
        $template = Template::select('contract_id')->where('id',$request->template_id)->where('status',1)->first();
        
        $contract_id = $template->contract_id;

        $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
            ->where('contract_data_id',$request->contract_data_id)
            ->where('template_id',$request->template_id)
            ->get();
        /*start check validation*/
        $validationArr = array();
         if(!empty($template_form)){
             foreach($template_form as $templates){
                foreach ($templateField as $value){
                    if($value->field_id == $templates->id){   
                        if($templates->is_required == 1){
                            $validationArr[$templates->name.'_'.$templates->id.'_'.$value->id] = 'required';
                        }
                    }
                }
            }
        }   
       
         if(!empty($validationArr)){
            $validator = Validator::make($request->all(),$validationArr);
            //check validation
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
         }
         /*End check validation*/
            $input = $request->all();
            
            $docName = array();
                //Start update Template Field Data
                foreach($template_form as $template){
                    foreach ($templateField as $value){
                        if($value->field_id == $template->id){   
                    $fieldData = TemplateFieldData::find($value->id);
                    $fieldData['meta_key'] = $template->name;
                    if($template->type == 'checkbox-group'){
                        $fieldData['meta_value'] = implode(",",$input[$template->name.'_'.$template->id.'_'.$value->id]);
                    }else if($template->type == 'file'){
                            if (!file_exists(public_path(config('constants.templatePath').Auth::user()->id))) {
                                mkdir(public_path(config('constants.templatePath').Auth::user()->id), 0777, true);
                            }
                            if(!empty($input[$template->name.'_'.$template->id.'_'.$value->id])){
                                foreach ($input[$template->name.'_'.$template->id.'_'.$value->id] as $key => $valueData) {
                                    $file_data = $input[$template->name.'_'.$template->id.'_'.$value->id][$key];
                                    $filename =  pathinfo($file_data->getClientOriginalName(), PATHINFO_FILENAME);
                                    $profile_name = time().$key.'.'.$file_data->getClientOriginalExtension();
                                    $destinationPath = public_path(config('constants.templatePath').Auth::user()->id);
                                    $file_data->move($destinationPath, $profile_name);
                                    array_push($docName,$profile_name);
                                }
                                if(!empty($docName)){
                                    $fName = implode(",",$docName);
                                    $fieldData['meta_value'] = $fName;
                                }
                            }
                    }else if($template->type == 'date'){
                            $fieldData['meta_value'] = $input[$template->name.'_'.$template->id.'_'.$value->id];
                    }else{
                        $fieldData['meta_value'] = $input[$template->name.'_'.$template->id.'_'.$value->id];
                    }
                    $fieldData->save();
                }}}
                //End store Template Field Data
               
                $previous_template_id = $input['previous_template_id'];
                $prev =  $request->previous;
                $prveSign = $request->previous_data;

                if(isset($request->edit_contract_data) && $request->edit_contract_data == "edit"){
                    $eventType = $request->edit_contract_data;
                }else{
                    $eventType = "add";
                }
                
                if(!empty($request->previous_data) && $request->previous_data == "previous"){
                    $next_template = $request->template_id;
                    $template_id = $input['previous_template_id'];
                    $templates = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                    $sectionsHtml = $this->getEditTemplate($template_id,$request->contract_id,$request->contract_data_id,$previous_template_id,$prev,$prveSign,$eventType);
                }else{
                    /*Open next form*/
                    $next_template = $request->next_template;
                    $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
                    ->where('contract_data_id',$request->contract_data_id)
                    ->where('template_id',$next_template)
                    ->get();
                    
                    if(!empty($templateField) && count($templateField) > 0){
                        $template_id = $request->next_template;
                        $prev_template_id = $request->template_id;
                        $templates = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                        $prev_template = Template::where('id',$prev_template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                        $sectionsHtml = $this->getEditTemplate($template_id,$request->contract_id,$request->contract_data_id,$previous_template_id,$prev,$prveSign,$eventType);
                        $template_name = preg_replace('/\s+/', '', $templates->template_name);    
                    }else{
                        $templates = Template::where('id',$next_template)->where('status',1)->orderBy('position_no','ASC')->first();
                        $sectionsHtml = $this->getTemplate($input['template_id'],$next_template,$request->contract_id,$request->contract_data_id,$eventType);
                        //$template_name = preg_replace('/\s+/', '', $templates->template_name);    
                         
                    }
                    if(isset ($templates->template_name)){
                        $template_name = preg_replace('/\s+/', '', $templates->template_name);    
                    }else{
                        $template_name = "";
                    }
                    
                    
                    
                }
                if(!empty($templates)){
                    return response()->json(['status' => 'success', 'sectionsHtml' => $sectionsHtml,'template_name' => $template_name,'next_template' =>$next_template], 200);
                }else{
                    return response()->json(['status' => 'success', 'sectionsHtml' => $sectionsHtml,'next_template' =>$next_template], 200);
                }

    }
    

    /*
        @Author : Ritesh Rana
        @Desc   : change Docx data.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function changeDocData($id,$setData,$type,$submit_type)
    {
        $category = Contract::withTrashed()->where('id',$id)->first();
        //dd($category->title);
        $path = base_path() . '/public/'.DOCUMENT_FILE.$category->contract_file;
        if (!file_exists(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id)) {
            mkdir(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id, 0777, true);
        }
        //$file_name = $category->title;
        $file_name = preg_replace('/[0-9\@\.\;\" ","(",")"]+/', '', $category->title);

        //$newFilePath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/newDoc.docx';
        $newFilePath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
        if (file_exists($newFilePath) ) {
            unlink($newFilePath);
        }
        
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //$templateProcessor->setValues($setData);
        //$templateProcessor->setValue('{name}', 'ritesh rana');
        foreach($setData as $key=>$setVal){
           $templateProcessor->setValue('${'.$key.'}', $setVal);
        }
        $templateProcessor->saveAs($newFilePath);
        
        /* start Create PDF file*/
        $inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
        /*@ If already PDF exists then delete it */
        
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        /* Set the PDF Engine Renderer Path */
        $Content = \PhpOffice\PhpWord\IOFactory::load($inputfile); 
        
        if($submit_type == "view"){
            $inputfileLink = url('/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx');
            $fileData = $inputfileLink;
            //$this->viewContract($fileData);
            //$inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.'newDoc.docx';
           //return view('front.view_contract', compact('fileData'));
           return $fileData;
           
        }else if($submit_type == "download"){
        //Save it into PDF
        //$savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
        $savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
        $PdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/';
        /*@ If already PDF exists then delete it */
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }

        //Save it into PDF  
        $output = shell_exec('export HOME='.$PdfPath.' && libreoffice --headless --convert-to pdf '.$inputfile.' --outdir '.$PdfPath);
        
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        // $PDFWriter->save($savePdfPath);

            if($type == 'docx'){
                $fileData = asset(CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx');
             }else{
                 $fileData = asset(CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf');
             }
            // header('Content-Description: File Transfer');
            // header('Content-Type: application/octet-stream');
            // header('Content-Disposition: attachment; filename='.$fileData);
            // header('Content-Transfer-Encoding: binary');
            // header('Expires: 0');
            // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            // header('Pragma: public');
            // header('Content-Length: ' . filesize($fileData));
            // flush();
            // readfile($fileData);
            //Response::download($savePdfPath);
            //return Response::download($savePdfPath);
            return $fileData;
        }else{
            //Save it into PDF
                $savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
                $PdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/';
                /*@ If already PDF exists then delete it */
                if (file_exists($savePdfPath) ) {
                    unlink($savePdfPath);
                }

                //Save it into PDF
                $output = shell_exec('export HOME='.$PdfPath.' && libreoffice --headless --convert-to pdf '.$inputfile.' --outdir '.$PdfPath);
                // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
                // $PDFWriter->save($savePdfPath);

                    if($type == 'docx'){
                        $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
                        //$fileData = asset(CREATE_DOCUMENT_FILE.Auth::user()->id.'/newDoc.docx');
                    }else{
                        $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
                        //$fileData = asset(CREATE_DOCUMENT_FILE.Auth::user()->id.'/new-result.pdf');
                    }
            return $fileData; 
        }
    }
/*
        @Author : Ritesh Rana
        @Desc   : view Contract.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 08/05/2021
    */
    public function viewContract($id)
    {
        // $contract_id = $template->contract_id;
        //$inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.'newDoc.docx';
        $category = Contract::where('id',$id)->first();
        $inputfile = url(CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$category->title.'.docx');
        return view('front.view_contract', compact('inputfile'));
    }

/*
        @Author : Ritesh Rana
        @Desc   : create Contract Arr.
        @Input  :  array $template_form and $input
        @Output : \Illuminate\Http\Response
        @Date   : 08/05/2021
    */
    public function getContractArr($template_form,$input)
    {
        $setData = array();
        $docName = array();
        foreach($template_form as $template){
            if($template->type == 'checkbox-group'){
                $setData[$template->name] = implode(",",$input[$template->name.'_'.$template->id]);
            }else if($template->type == 'file'){
                if (!file_exists(public_path(config('constants.templatePath').Auth::user()->id))) {
                    mkdir(public_path(config('constants.templatePath').Auth::user()->id), 0777, true);
                }
                    if(!empty($input[$template->name.'_'.$template->id])){
                        foreach ($input[$template->name.'_'.$template->id] as $key => $value) {
                            $file_data = $input[$template->name.'_'.$template->id][$key];
                            $filename =  pathinfo($file_data->getClientOriginalName(), PATHINFO_FILENAME);
                            $profile_name = time().$key.'.'.$file_data->getClientOriginalExtension();
                            $destinationPath = public_path(config('constants.templatePath').Auth::user()->id);
                            $file_data->move($destinationPath, $profile_name);
                            array_push($docName,$profile_name);
                        }
                    }
                    if(!empty($docName)){
                        $setData[$template->name] = implode(",",$docName);
                    }
            }else if($template->type == 'date'){
                $setData[$template->name] = $input[$template->name.'_'.$template->id];
            }else{
                $setData[$template->name] = $input[$template->name.'_'.$template->id];
            }
        }
        return $setData;
    }

    /*
        @Author : Ritesh Rana
        @Desc   : create Contract Arr.
        @Input  :  array $template_form and $input
        @Output : \Illuminate\Http\Response
        @Date   : 08/05/2021
    */
    public function getEditContractArr($template_form,$templateField,$input)
    {
        $setData = array();
        $docName = array();
        foreach($template_form as $template){
            foreach ($templateField as $value){
                if($value->field_id == $template->id){  
            if($template->type == 'checkbox-group'){
                $setData[$template->name] = implode(",",$input[$template->name.'_'.$template->id.'_'.$value->id]);
            }else if($template->type == 'file'){
                if (!file_exists(public_path(config('constants.templatePath').Auth::user()->id))) {
                    mkdir(public_path(config('constants.templatePath').Auth::user()->id), 0777, true);
                }
                    if(!empty($input[$template->name.'_'.$template->id])){
                        foreach ($input[$template->name.'_'.$template->id] as $key => $value) {
                            $file_data = $input[$template->name.'_'.$template->id][$key];
                            $filename =  pathinfo($file_data->getClientOriginalName(), PATHINFO_FILENAME);
                            $profile_name = time().$key.'.'.$file_data->getClientOriginalExtension();
                            $destinationPath = public_path(config('constants.templatePath').Auth::user()->id);
                            $file_data->move($destinationPath, $profile_name);
                            array_push($docName,$profile_name);
                        }
                    }
                    if(!empty($docName)){
                        $setData[$template->name] = implode(",",$docName);
                    }
            }else if($template->type == 'date'){        
                $setData[$template->name] = $input[$template->name.'_'.$template->id.'_'.$value->id];
            }else{
                $setData[$template->name] = $input[$template->name.'_'.$template->id.'_'.$value->id];
            }
        }}}
        return $setData;
    }
    

/*
        @Author : Ritesh Rana
        @Desc   : review Contract.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 09/05/2021
    */
    public function reviewContract(Request $request)
    {
    /* start get Template Form */
        $template_form = TemplateForm::select('id','name','is_required','type')
        ->where('template_id',$request->template_id)
        ->whereNotIn('type', ['header','paragraph'])
        ->where('status',1)
        ->get();
    /* End get Template Form */
        
        $template = Template::select('contract_id')->where('id',$request->template_id)->where('status',1)->first();
        $contract_id = $template->contract_id;
        /* start check validation */
        $validationArr = array();
         if(!empty($template_form)){
             foreach($template_form as $template){
                 if($template->is_required == 1){
                    $validationArr[$template->name.'_'.$template->id] = 'required';
                 }
            }
        }   
         
         if(!empty($validationArr)){
            $validator = Validator::make($request->all(),$validationArr);
            //check validation
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        /* End check validation */

            $input = $request->all();
            $type = $request->download_type;
            $submit_type = "view";
        /* create contract array */
            $setData = $this->getContractArr($template_form,$input);
        /* End contract array */    
        /* start create contract Doc */    
            $docUrl = $this->changeDocData($contract_id,$setData,$type,$submit_type);
        /* End create contract Doc */    
         /* success Response  */   
            return response()->json(['status' => 'success', 'docFile' => $docUrl], 200);

    }
    

    /*
        @Author : Ritesh Rana
        @Desc   : review Contract.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 09/05/2021
    */
    public function editContractReview(Request $request)
    {
    /* start get Template Form */
        $template_form = TemplateForm::select('id','name','is_required','type')
        ->where('template_id',$request->template_id)
        ->whereNotIn('type', ['header','paragraph'])
        ->where('status',1)
        ->get();
    /* End get Template Form */

        $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
        ->where('contract_data_id',$request->contract_data_id)
        ->get();
        
        $template = Template::select('contract_id')->where('id',$request->template_id)->where('status',1)->first();
        $contract_id = $template->contract_id;
        /* start check validation */
        $validationArr = array();
        if(!empty($template_form)){
            foreach($template_form as $template){
               foreach ($templateField as $value){
                   if($value->field_id == $template->id){   
                       if($template->is_required == 1){
                           $validationArr[$template->name.'_'.$template->id.'_'.$value->id] = 'required';
                       }
                   }
               }
           }
       }   
         
         if(!empty($validationArr)){
            $validator = Validator::make($request->all(),$validationArr);
            //check validation
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        /* End check validation */

            $input = $request->all();
            $type = $request->download_type;
            $submit_type = "view";
        /* create contract array */
            $setData = $this->getEditContractArr($template_form,$templateField,$input);
        /* End contract array */    
        /* start create contract Doc */    
            $docUrl = $this->changeDocData($contract_id,$setData,$type,$submit_type);
        /* End create contract Doc */    
         /* success Response  */   
            return response()->json(['status' => 'success', 'docFile' => $docUrl], 200);

    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 02/05/2021
    */
    public function contractType($subCategorieId)
    {
        /* Start get contract data */
            $contracts = Contract::where('sub_category_id',$subCategorieId)->where('status',1)->get();
            
        /* End get contract data */

        $subCategories = SubCategories::find($subCategorieId);

         if(isset(Auth::user()->id)){
            $check = checkSubscription();
        }
        return view('front.contract_type', compact('contracts','subCategories'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 02/05/2021
    */
    public function getsubCategorie($categorieId)
    {
        /* Start get sub Categorie data */
        $subCategories = SubCategories::where('categories_id',$categorieId)->where('status',1)->get(); 
        
        if(empty($subCategories) || count($subCategories) == 0){
            alert()->error('sub Categories not found !')->showConfirmButton('Ok', '#07689f');
            if(isset(Auth::user()->id)){
                return redirect('/front/dashboard'); 
            }else{
                return redirect('/'); 
            }
        }
        // dd($subCategories);   
        /* End get sub Categorie data */
        $ContractCategories = ContractCategories::find($categorieId);

        if(isset(Auth::user()->id)){
            $check = checkSubscription();
        }
        
        return view('front.sub_categories', compact('ContractCategories','subCategories'));
    }

    


    /*
        @Author : Ritesh Rana
        @Desc   : store contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 07/05/2021
    */
    public function saveContractTypeDetailOld(Request $request)
    {
        $check = checkSubscription();
        if($check == 2){
            alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
            return redirect('/front/dashboard'); 
        } 
        if($check == 0){
            alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
            return redirect('/pricing');
        }

         /* End check Subscription */
          /* Start add css */
          $headerCss[0] = "front/css/jquery.datetimepicker.min.css";
          $headerCss[1] = "front/css/parsley.css";
      /* End add css */
      /* start add js */
          $footerJs[0]    = "front/js/jquery.datetimepicker.js";
          $footerJs[1]    = "front/js/parsley.min.js";
          $footerJs[2]    = "front/js/parsley-fields-comparison-validators.js";
          $footerJs[3]    = "front/customJs/template_frm.js";
      /* End add js */
    /* Start check Subscription */
            $contractDetail = Contract::where('id',$request->contract_type)->where('status',1)->first();
            //$template = Template::where('contract_id',$request->contract_type)->where('status',1)->first();

            $template = Template::with(['templateForm' => function ($q)  {
                $q->select('id','template_id','label','name','type','meta','is_required','status')->where('status',1);
            }])
                ->select('template.*')
                ->where('status',1)
                ->where('contract_id',$request->contract_type)
                ->orderBy('position_no','ASC')
                ->get();
                //  foreach ($template as $key=>$templates){
                //     $skip_page = $key + 1;
                    
                //     if($skip_page != count($template)){
                //         echo $template[$skip_page]->position_no;
                //     }
                     
                //     echo "<pre>";
                //     print_r($template);
                //     echo "</pre>";
                //  }
                //  exit;
            // echo "<pre>";
            // print_r($template[0]);
            // echo "</pre>";exit;
             if(empty($template)){
                alert()->error('Contract not found !')->showConfirmButton('Ok', '#07689f');
                return redirect('/front/dashboard'); 
            }else{
                
                //$template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')->where('template_id',$template->id)->where('status',1)->get();
            /* End get template contract and template form data  */
                return view('front.contract_form_new', compact('template','contractDetail','footerJs','headerCss'));       
            }
    
    }


    public function saveContractTypeDetail(Request $request)
    {
        $check = checkSubscription();
        if($check == 2){
            alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
            return redirect('/front/dashboard'); 
        } 
        if($check == 0){
            if(isset(Auth::user()->id)){
                alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
            }else{
                alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
            }
            
            return redirect('/pricing');
        }

         /* End check Subscription */
          /* Start add css */
          $headerCss[0] = "front/css/jquery.datetimepicker.min.css";
          $headerCss[1] = "front/css/parsley.css";
      /* End add css */
      /* start add js */
          $footerJs[0]    = "front/js/jquery.datetimepicker.js";
          $footerJs[1]    = "front/js/parsley.min.js";
          $footerJs[2]    = "front/js/parsley-fields-comparison-validators.js";
          $footerJs[3]    = "front/customJs/template_frm.js";
      /* End add js */

            $template = Template::with(['templateQuestions' => function ($q)  {
                $q->select('id','template_id','questions','description');
            }])
            ->select('template.*')
            ->where('contract_id',$request->contract_type)
            ->where('status',1)
            ->orderBy('position_no','ASC')
            ->get();
            
            if(empty($template) || count($template) == 0){
                alert()->error('Contract not found !')->showConfirmButton('Ok', '#07689f');
                return redirect('/front/dashboard'); 
            }
    
            $conData = new ContractData();
            $conData->contract_id = $request->contract_type;
            $conData->created_by = Auth::user()->id;
            $conData->one_coontract_status = 1;
            $conData->save();

                
    /* Start check Subscription */
            $contractDetail = Contract::where('id',$request->contract_type)->where('status',1)->first();
            // $template = Template::where('contract_id',$request->contract_type)
            // ->where('status',1)
            // ->orderBy('position_no','ASC')
            // ->get();

           
            $noTemplate = count($template) + 1;
            $progData = 100 / $noTemplate;
            //dd($template);
            // $template = Template::with(['templateForm' => function ($q)  {
            //     $q->select('id','template_id','label','name','type','meta','is_required','status')->where('status',1);
            // }])
            //     ->select('template.*')
            //     ->where('status',1)
            //     ->where('contract_id',$request->contract_type)
            //     ->orderBy('position_no','ASC')
            //     ->get();
                
            //  foreach ($template as $key=>$templates){
            //         $skip_page = $key + 1;
                    
            //         if($skip_page != count($template)){
            //             dd($template[$skip_page]);
            //         }
                     
                    
            //      }
            //      exit;
               
            // echo "<pre>";
            // print_r($template[0]);
            // echo "</pre>";exit;
             if(empty($template)){
                alert()->error('Contract not found !')->showConfirmButton('Ok', '#07689f');
                return redirect('/front/dashboard'); 
            }else{
                $contract_data_id = $conData->id;
                $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')->where('template_id',$template[0]->id)->where('status',1)->get();
                
            /* End get template contract and template form data  */
                return view('front.contract_form_new', compact('progData','contract_data_id','template_form','template','contractDetail','footerJs','headerCss'));       
            }
    
    }

    /*
         @Author : Ritesh Rana
         @Desc   : get template tab.
         @Input  : screcard id
         @Output : \Illuminate\Http\Response
         @Date   : 20/04/2020
    */
    public function getTemplate($template_id,$next_template,$contract_id,$contract_data_id,$eventType)
    {
        Log::info('ContractController :: getTemplate || Get sections by screcard id');
        $template = Template::where('id',$next_template)->where('status',1)->orderBy('position_no','ASC')->first();
        $contractDetail = Contract::where('id',$contract_id)->where('status',1)->first();
        $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')->where('template_id',$next_template)->where('status',1)->get();
        $previous_template_id = $template_id;
        if (!empty($template)) {

            $sectionsHtml = view('front.template', compact('template','contractDetail','template_form','contract_data_id','previous_template_id','eventType'))->render();
        } else {
            $template = Template::where('contract_id',$contract_id)->where('status',1)->orderBy('position_no','DESC')->first();
            $setData = $this->getTemplateArr($template_id,$contract_data_id,$contract_id);
            $type="docx";
            $submit_type = "view";
            $doc_url_link = $this->changeDocData($contract_id,$setData,$type,$submit_type);
            $doc_url = "https://view.officeapps.live.com/op/embed.aspx?src=".$doc_url_link;
            $sectionsHtml = view('front.print', compact('doc_url','template','contract_id','contractDetail','template_form','contract_data_id','eventType'))->render();
        }
        return $sectionsHtml;
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Edit contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/05/2021
    */
    public function getEditTemplate($template_id,$contract_id,$contract_data_id,$previous_template_id,$prev,$prveSign,$eventType)
    {
        /* Start get contract data */
        $contractData = ContractData::select(['contract_name','id','template_id','contract_id','created_at'])
            ->where('id',$contract_data_id)
            ->first();
        /* End get contract data */

        /* Start get Template Field Data */
        $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
            ->where('contract_data_id',$contract_data_id)
            ->where('template_id',$template_id)
            ->get();
        /* End get Template Field Data */
        
        /* Start get Template Form Data */
        $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')
            ->where('template_id',$template_id)
            ->get();
            
        /* End get Template Form Data */

        /* start get contract data*/    
        $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
        $contractDetail = Contract::where('id',$contract_id)->where('status',1)->first();
        /* End get contract data*/    
        $sectionsHtml = view('front.edit_template', compact('eventType','template','contractData','templateField','contractDetail','template_form','contract_data_id','previous_template_id','prev','prveSign'))->render();
        return $sectionsHtml;
    }

    /*
        @Author : Ritesh Rana
        @Desc   : create Contract Arr.
        @Input  :  array $template_form and $input
        @Output : \Illuminate\Http\Response
        @Date   : 08/05/2021
    */
    public function getTemplateArr($template_id,$contract_data_id,$contract_id)
    {
        $setData = array();
        $docName = array();

        $template = Template::with(['templateForm' => function ($q)  {
                $q->select('id','template_id','label','name','type','meta','is_required','status')->where('status',1);
            }])
                ->select('template.*')
                ->where('status',1)
                ->where('contract_id',$contract_id)
                ->orderBy('position_no','ASC')
                ->get();

         /* Start get contract data */
        $contractData = ContractData::select(['contract_name','id','template_id','contract_id','created_at'])
         ->where('id',$contract_data_id)
         ->first();
     /* End get contract data */

     /* Start get Template Field Data */
        $templateFieldData = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
         ->where('contract_data_id',$contract_data_id)
         ->get();
         
         if(!empty($template)){
            foreach($template as $templates){
                foreach($templates->templateForm as $template_field){
                    foreach($templateFieldData as $data){
                        if($template_field->id == $data->field_id){
                            if($template_field->type == 'checkbox-group'){
                                $setData[$template_field->name] = $data->meta_value;
                            }else if($template_field->type == 'date'){
                                $setData[$template_field->name] = $data->meta_value;
                            }else{
                                $setData[$template_field->name] = $data->meta_value;
                            }
                        }
                    }
                }
            }
         }
        $amendAgreement = AmendAgreement::where('contract_data_id',$contract_data_id)->first();
        if(!empty($amendAgreement)){
            if($amendAgreement->amend_agreement == "yes"){
                $setData["amend_header"] = $amendAgreement->amend_header;
                $setData["amend_agreement"] = $amendAgreement->amend_content;
            }else{
                $setData["amend_header"] = "";
                $setData["amend_agreement"] = "";
            }
        }else{
            $setData["amend_header"] = "";
            $setData["amend_agreement"] = "";
        }
        return $setData;
    }

    /*
        @Author : Ritesh Rana
        @Desc   : store contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 07/05/2021
    */
    public function backWithNotsaveTemplateDetail(Request $request)
    {
        //dd($request->all());
    /* Start check Subscription */
        // $check = checkSubscription();
        // if($check == 2){
        //     alert()->error('Your purchase plan is expired!')->showConfirmButton('Ok', '#07689f');
        //     return redirect('/front/dashboard'); 
        // } 
        // if($check == 0){
        //     alert()->error('Your subscription has expired!')->showConfirmButton('Ok', '#07689f');
        //     return redirect('/pricing');
        // }
        
    /* End check Subscription */
    /* Start get template form data*/
            $input = $request->all();
            $next_template = $request->next_template;
            /*End store Template Field Data*/
            /*click on back button save all current form data and open previous form*/ 
            $previous_template_id = $request->previous_template_id;
            $prev =  $request->previous;
            $prveSign = $request->previous_data;

            /* Start get Template Field Data */
            if(isset($request->edit_contract_data) && $request->edit_contract_data == "edit"){
                $eventType = $request->edit_contract_data;
            }else{
                $eventType = "add";
            }
            
            if(!empty($request->previous_data) && $request->previous_data == "previous"){
                $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
                ->where('contract_data_id',$request->contract_data_id)
                ->where('template_id',$input['previous_template_id'])
                ->get();
                $template_id = $input['previous_template_id'];
                if(!empty($templateField) && count($templateField) > 0){
                    $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                    $sectionsHtml = $this->getEditTemplate($template_id,$request->contract_id,$request->contract_data_id,$previous_template_id,$prev,$prveSign,$eventType);
                }else{
                    $next_template = $request->next_template;
                    $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                    $sectionsHtml = $this->getTemplateWithoutData($template_id,$next_template,$request->contract_id,$request->contract_data_id,$eventType);    
                }
            }else{
                /*Open next form*/
                $next_template = $request->next_template;
                $templateField = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
                ->where('contract_data_id',$request->contract_data_id)
                ->where('template_id',$next_template)
                ->get();
                $template_id = $next_template;
                if(!empty($templateField) && count($templateField) > 0){
                    $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
                    $sectionsHtml = $this->getEditTemplate($template_id,$request->contract_id,$request->contract_data_id,$previous_template_id,$prev,$prveSign,$eventType);
                }else{
                    $template = Template::where('id',$next_template)->where('status',1)->orderBy('position_no','ASC')->first();
                    $sectionsHtml = $this->getTemplate($input['template_id'],$next_template,$request->contract_id,$request->contract_data_id,$eventType);
                }
                // $next_template = $request->next_template;
                //     $template = Template::where('id',$next_template)->where('status',1)->orderBy('position_no','ASC')->first();
                //     $sectionsHtml = $this->getTemplate($input['template_id'],$next_template,$request->contract_id,$request->contract_data_id);
                
            }
            if(isset ($template->template_name)){
                $template_name = preg_replace('/\s+/', '', $template->template_name);    
            }else{
                $template_name = "";
            }
            $previous_template_id = $input['previous_template_id'];
            return response()->json(['status' => 'success', 'sectionsHtml' => $sectionsHtml,'template_name' => $template_name,'next_template' =>$next_template], 200);
            // End Add Capture Fields
           
        //return redirect('/front/dashboard')->with('success', 'Contract created successfully!!');
    }


    /*
         @Author : Ritesh Rana
         @Desc   : get template with without data tab.
         @Input  : template id
         @Output : \Illuminate\Http\Response
         @Date   : 20/12/2020
    */
    public function getTemplateWithoutData($template_id,$next_template,$contract_id,$contract_data_id,$eventType)
    {
        Log::info('ContractController :: getTemplate || Get sections by screcard id');
        $template = Template::where('id',$template_id)->where('status',1)->orderBy('position_no','ASC')->first();
        $contractDetail = Contract::where('id',$contract_id)->where('status',1)->first();
        $template_form = TemplateForm::select('id','label','name','type','meta','is_required','status')->where('template_id',$template_id)->where('status',1)->get();
        $sectionsHtml = view('front.template', compact('template','contractDetail','template_form','contract_data_id','eventType'))->render();
        return $sectionsHtml;
    }

    /*
         @Author : Ritesh Rana
         @Desc   : get template tab.
         @Input  : screcard id
         @Output : \Illuminate\Http\Response
         @Date   : 20/04/2020
    */
    public function preview(Request $request)
    {
        //dd($request->all());
        $contract_id = $request->contract_id;
        $template_id = $request->template_id;
        $contract_data_id = $request->contract_data_id;
       
        $setData = array();
        $docName = array();

        $template = Template::with(['templateForm' => function ($q)  {
                $q->select('id','template_id','label','name','type','meta','is_required','status')->where('status',1);
            }])
                ->select('template.*')
                ->where('status',1)
                ->where('contract_id',$contract_id)
                ->orderBy('position_no','ASC')
                ->get();

            $templateFieldData = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
            ->where('contract_data_id',$contract_data_id)
            ->get();   

                if(!empty($template)){
                    foreach($template as $templates){
                        foreach($templates->templateForm as $template_field){
                            $fieldName = $template_field->name.'_'.$template_field->id;
                            if(isset($request->$fieldName)){
                                if($template_field->type == 'checkbox-group'){
                                    $setData[$template_field->name] = $request->$fieldName;
                                }else if($template_field->type == 'date'){
                                    $setData[$template_field->name] = $request->$fieldName;
                                }else{
                                    $setData[$template_field->name] = $request->$fieldName;
                                }
        
                            }else{
                                if(!empty($templateFieldData)){
                                    foreach($templateFieldData as $data){
                                        if($template_field->id == $data->field_id){
                                            if($template_field->type == 'checkbox-group'){
                                                $setData[$template_field->name] = $data->meta_value;
                                            }else if($template_field->type == 'date'){
                                                $setData[$template_field->name] = $data->meta_value;
                                            }else{
                                                $setData[$template_field->name] = $data->meta_value;
                                            }
                                        }
                                    }
                                }else{
                                    $setData[$template_field->name] = "";
                                }
                            }
                        }
                    }
                }

         
        
            $type="docx";
            $submit_type = "view";
            $doc_url = $this->changeDocData($contract_id,$setData,$type,$submit_type);
            
            return response()->json(['status' => 'success', 'doc_url' => $doc_url], 200); 
    }

    /*
        @Author : Ritesh Rana
        @Desc   : view Contract.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 08/05/2021
    */
    public function previewContract($contract_id,$contract_data_id)
    {
        // $contract_id = $template->contract_id;
        //$inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.'newDoc.docx';
        // $category = Contract::where('id',$contract_id)->first();
        // $inputfile = url(CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$category->title.'.docx');

        $template = Template::where('contract_id',$contract_id)->where('status',1)->orderBy('position_no','DESC')->first();
        $template_id = "";
        $setData = $this->getTemplateArr($template_id,$contract_data_id,$contract_id);
        $type="docx";
        $submit_type = "view";
        $doc_url_link = $this->changeDocData($contract_id,$setData,$type,$submit_type);
        $doc_url = "https://view.officeapps.live.com/op/embed.aspx?src=".$doc_url_link;

        return view('front.view_contract', compact('doc_url'));
    }


    /*
        @Author : Ritesh Rana
        @Desc   : Submit contract data.
        @Input  : $id
        @Output : \Illuminate\Http\Response
        @Date   : 05/04/2022
    */
    public function submitContract(Request $request)
    {
        // dd($request->all());
        return 'test'; die;
        /* start add css */
            $headerCss[0] = "front/css/jquery.datetimepicker.min.css";
            $headerCss[1] = "front/css/parsley.css";
        /* End add css */
        /* start add js */
            $footerJs[0]    = "front/js/jquery.datetimepicker.js";
            $footerJs[1]    = "front/js/parsley.min.js";
            $footerJs[2]    = "front/js/parsley-fields-comparison-validators.js";
            $footerJs[3]    = "front/customJs/template_frm.js";
        /* End add js */    
           
        
            //echo $contractId;exit;
        /* Start Get Contract Data */
        $dataQuery = ContractData::select(['contract_data.id','contract_data.contract_id'])
        ->where('contract_data.id',$request->contract_data_id)
        ->first();
        /* End Get Contract Data */

    /* Start store Amend Agreement Data */
    if(isset($request->amend_agreement)){
        if($request->amend_agreement == "no"){
            $userpost = AmendAgreement::where('contract_data_id',$request->contract_data_id);
            $userpost->delete();
        }else{
            $userpost = AmendAgreement::where('contract_data_id',$request->contract_data_id);
            $userpost->delete();

            $amend = new AmendAgreement();
            $amend->contract_data_id = $request->contract_data_id;
            $amend->amend_agreement = $request->amend_agreement;
            $amend->amend_header = isset($request->amend_header) ? $request->amend_header : '';
            $amend->amend_content = isset($request->insert_other_clause_data) ? $request->insert_other_clause_data : '';
            $amend->save();
        }
    }
            
    /* End store Amend Agreement Data */       

        $setData = $this->getContractUrl($request->contract_data_id);
        dd($setData);
    /* End create array for download file */  
        if(isset($request->download_type) && !empty($request->download_type)){
            $type = $request->download_type;
        }else{
            $type = "pdf";
        }

        if(isset($request->preview) && $request->preview == "preview"){
            $type="docx";
            $this->downloadContract($dataQuery->contract_id,$setData,$type);
            return true;
            // $submit_type = "download";
            // $doc_url_link = $this->changeDocData($dataQuery->contract_id,$setData,$type,$submit_type);
            // $doc_url = "https://view.officeapps.live.com/op/embed.aspx?src=".$doc_url_link;
            // return view('front.view_contract', compact('doc_url'));
        }
        
        //$type = "sendUrl";
        
        /* start Create PDF file */
            $contrct_url = $this->SendContractUrl($dataQuery->contract_id,$setData,$type);
            $contractDetail = Contract::select('title')->where('id',$dataQuery->contract_id)->where('status',1)->first();
            
            $attachmentURl = [];
            if($type == "pdf"){
                $attachmentURl[] = $contrct_url;
            }else if($type == "docx"){
                $attachmentURl[] = $contrct_url;
            }else{
                $attachmentURl[] = $contrct_url[0];
                $attachmentURl[] = $contrct_url[1];
            }
            $link = route('loginPage');
            $subject = 'Contract-'.$contractDetail->title;
            $data = array('email' => Auth::user()->email,'name' => Auth::user()->name,'login' => $link);
            $makeHtmlView = (string)View::make('emails.contract_successfully_mail', $data);
            $this->fire(Auth::user()->email,$subject,$makeHtmlView,$attachmentURl);

            alert()->success('Contract created successfully!')->showConfirmButton('Ok', '#07689f');
            return redirect('/front/user_contract_list');
    
            
    }

    public function getContractUrl($contractId)
    {
        /* Start Get Contract Data */
        $dataQuery = ContractData::select(['contract_data.id','contract_data.contract_id'])
        ->where('contract_data.id',$contractId)
        ->first();
        /* End Get Contract Data */
        $setData = array();
        $docName = array();

        $template = Template::with(['templateForm' => function ($q)  {
                $q->select('id','template_id','label','name','type','meta','is_required','status')->where('status',1);
            }])
                ->select('template.*')
                ->where('status',1)
                ->where('contract_id',$dataQuery->contract_id)
                ->orderBy('position_no','ASC')
                ->get();

         /* Start get contract data */
        
     /* End get contract data */

     /* Start get Template Field Data */
        $templateFieldData = TemplateFieldData::select('id','contract_data_id','field_id','template_id','meta_key','meta_value')
         ->where('contract_data_id',$contractId)
         ->get();

        $setData = array();
        $docName = array();
        if(!empty($template)){
            foreach($template as $templates){
                foreach($templates->templateForm as $template_field){
                    foreach($templateFieldData as $data){
                        if($template_field->id == $data->field_id){
                            if($template_field->type == 'checkbox-group'){
                                $setData[$template_field->name] = $data->meta_value;
                            }else if($template_field->type == 'date'){
                                $setData[$template_field->name] = $data->meta_value;
                            }else{
                                $setData[$template_field->name] = $data->meta_value;
                            }
                        }
                    }
                }
            }
        }
        $amendAgreement = AmendAgreement::where('contract_data_id',$contractId)->first();
        if(!empty($amendAgreement)){
            if($amendAgreement->amend_agreement == "yes"){
                $setData["amend_header"] = $amendAgreement->amend_header;
                $setData["amend_agreement"] = $amendAgreement->amend_content;
            }else{
                $setData["amend_header"] = "";
                $setData["amend_agreement"] = "";
            }
        }else{
            $setData["amend_header"] = "";
            $setData["amend_agreement"] = "";
        }
        
        return $setData;
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function SendContractUrl($id,$setData,$type)
    {
        $category = Contract::withTrashed()->where('id',$id)->first();
        $file_name = preg_replace('/[0-9\@\.\;\" ","(",")"]+/', '', $category->title);
        
        $path = base_path() . '/public/'.DOCUMENT_FILE.$category->contract_file;
        if (!file_exists(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id)) {
            mkdir(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id, 0777, true);
        }
        $newFilePath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
         /*@ If already PDF exists then delete it */
        if (file_exists($newFilePath) ) {
            unlink($newFilePath);
        }
        //echo $newFilePath;exit;
        
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //$templateProcessor->setValues($setData);
        //$templateProcessor->setValue('{name}', 'ritesh rana');
        foreach($setData as $key=>$setVal){
            $templateProcessor->setValue('${'.$key.'}', $setVal);
        }
        $templateProcessor->saveAs($newFilePath);

        /* start Create PDF file*/
        $inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
        /*@ If already PDF exists then delete it */
        
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        /* Set the PDF Engine Renderer Path */
        $Content = \PhpOffice\PhpWord\IOFactory::load($inputfile); 
        
        //Save it into PDF
        $savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
        $PdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/';
        /*@ If already PDF exists then delete it */
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }
        
        //Save it into PDF
        $output = shell_exec('export HOME='.$PdfPath.' && libreoffice --headless --convert-to pdf '.$inputfile.' --outdir '.$PdfPath);
        
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        // $PDFWriter->save($savePdfPath);

        if($type == 'docx'){
            $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
        }else if($type == 'pdf'){
            $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
            $file_name = $file_name.".pdf";
        }else{
            $docFile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
            $pdfFile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
            $fileData = array($docFile,$pdfFile);
        }
        return $fileData;
            
            // if($type == "sendUrl"){
            //     return $fileData;    
            // }else{
            //     header('Content-Description: File Transfer');
            //     header('Content-Type: application/octet-stream');
            //     header('Content-Disposition: attachment; filename='.$file_name);
            //     header('Content-Transfer-Encoding: binary');
            //     header('Expires: 0');
            //     header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            //     header('Pragma: public');
            //     header('Content-Length: ' . filesize($fileData));
            //     flush();
                
            //     readfile($fileData);
            //     //return Response::download($fileData);
            //     return response()->download($fileData);
            // }
    }


    public function downloadContract($id,$setData,$type)
    {
        $category = Contract::withTrashed()->where('id',$id)->first();
        
        $file_name = preg_replace('/[0-9\@\.\;\" ","(",")"]+/', '', $category->title);

        $path = base_path() . '/public/'.DOCUMENT_FILE.$category->contract_file;
        if (!file_exists(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id)) {
            mkdir(base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id, 0777, true);
        }
        $newFilePath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
         /*@ If already PDF exists then delete it */
        if (file_exists($newFilePath) ) {
            unlink($newFilePath);
        }
        //echo $newFilePath;exit;
        
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($path);
        //$templateProcessor->setValues($setData);
        //$templateProcessor->setValue('{name}', 'ritesh rana');
        foreach($setData as $key=>$setVal){
            // if($key == "amend_header"){
                $templateProcessor->setValue('${'.$key.'}', $setVal);    
            // }else{
            //     $templateProcessor->setValue('${'.$key.'}', $setVal);
            // }
        }
        $templateProcessor->saveAs($newFilePath);

        /* start Create PDF file*/
        $inputfile = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
        /*@ If already PDF exists then delete it */


        
        /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        /* Set the PDF Engine Renderer Path */
        $Content = \PhpOffice\PhpWord\IOFactory::load($inputfile); 
         
        //Save it into PDF
        $savePdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
        $PdfPath = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/';
        /*@ If already PDF exists then delete it */
        if (file_exists($savePdfPath) ) {
            unlink($savePdfPath);
        }

        //$output = shell_exec('export HOME=/var/www/html/docxtopdf/ && libreoffice --headless --convert-to pdf /var/www/html/docxtopdf/newcontract.docx --outdir /var/www/html/docxtopdf/');
        $output = shell_exec('export HOME='.$PdfPath.' && libreoffice --headless --convert-to pdf '.$inputfile.' --outdir '.$PdfPath);
        
        // Save it into PDF
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        // $PDFWriter->save($savePdfPath);

            if($type == 'docx'){
                $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
                $file_name = $file_name.".docx";
             }else{
                $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.pdf';
                $file_name = $file_name.".pdf";
                // $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/new-result.doc';
                
                // $file_name = "new-contract.doc";
            }
            
            if($type == "sendUrl"){
                return $fileData;    
            }else{
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$file_name);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($fileData));
                flush();
                
                readfile($fileData);
                //return Response::download($fileData);
                return response()->download($fileData);
            }
            
            
    }

}
