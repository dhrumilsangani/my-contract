<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AmendAgreement;
use Illuminate\Http\Request;
use App\Models\SendContract;
use App\Models\ContractData;
use App\Models\TemplateFieldData;
use App\Models\TemplateForm;
use App\Models\Contract;
use App\Models\Template;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
use Config;
use Auth;
use PDF;
use App\Traits\SendMail;

class SendContractController extends Controller
{
    use SendMail;
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
        @Date   : 22/06/2021
    */
    public function index(Request $request)
    {
        
        /* start get send contract datat */ 
        $dataQuery = SendContract::select('send_contract.*','contract_data.contract_name','contract.title')
			->leftJoin('contract_data', 'contract_data.id', '=', 'send_contract.contract_id')
            ->leftJoin('contract', 'contract.id', '=', 'contract_data.contract_id')
            ->where('send_contract.created_by',Auth::user()->id);
            if ($request->has('search_by_name') && $request->search_by_name != '') {
             $dataQuery->where((function($custQ) use($request){
                    $custQ->orWhere('contract.title', 'like', '%' . $request->search_by_name . '%');
                    $custQ->orWhere('send_contract.email', 'like', '%' . $request->search_by_name . '%');
             }));
                
            }
        $contractData=$dataQuery->orderBy('send_contract.id', 'DESC')->get();
        /* End get send contract datat */ 
        return view('front.send_contract_list', compact('contractData','request'));
    }

    /*
        @Author : Ritesh Rana
        @Desc   : Display send contract page
        @Input  : contract id
        @Output : \Illuminate\Http\Response
        @Date   : 22/06/2021
    */
    public function sendContractPage($contractId)
    {
        //echo $contractId;exit;
        /* Start Get Contract Data */
        $dataQuery = ContractData::select(['contract_data.id','contract_data.contract_id'])
        ->where('contract_data.id',$contractId)
        ->first();
        /* End Get Contract Data */

        $setData = $this->getTemplateArr($contractId);
    /* End create array for download file */  
        $type = "sendUrl";
        /* start Create PDF file */
        $savePdfPath = $this->changeDocData($dataQuery->contract_id,$setData,$type);
        /* End Create PDF file */
        $contract_id = $contractId;
        /*ad js */
        $footerJs[0]    = "front/customJs/send_contract.js";
        return view('front.send_contract', compact('savePdfPath','contract_id','footerJs'));
    }  

     /*
        @Author : Ritesh Rana
        @Desc   : send contract and Store contract data
        @Input  :
        @Output : \Illuminate\Http\Response
        @Date   : 22/06/2021
    */
    public function sendContract(Request $request)
    {
        $validationArr = array(
			'contrct_url' => 'required',
            'email' => 'required',
        );

        $validator = Validator::make($request->all(),$validationArr);
        //check validation
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}else {
            //store sent contract data
            $SendCon = new SendContract;
            $SendCon->contract_url = $request->contrct_url;
            $SendCon->email = $request->email;
            $SendCon->contract_id = $request->contract_id;
            $SendCon->message = $request->message;
            $SendCon->created_by = Auth::user()->id;
            $SendCon->save();

            $dataQuery = ContractData::select(['contract_data.contract_id'])
            ->where('contract_data.id',$request->contract_id)
            ->first();
            

            $contract = Contract::select('title')
            ->where('id',$dataQuery->contract_id)
            ->first();
            
            if(!empty($contract->title)){
                $contract_name = $contract->title;
            }else{
                $contract_name = '';
            }
            //start send email to user
            $subject = 'Contract-'.$contract_name;
            $data = array('message_data'=>$request->message, 'email' => $request->email);
            $makeHtmlView = (string)View::make('emails.send_contract_mail', $data);
            $this->fire($request->email,$subject,$makeHtmlView,[$request->contrct_url]);

            //End send email to user
            //Redirect with message
            alert()->success('Your attachment message has been successfully sent!')->showConfirmButton('Ok', '#07689f');
            return redirect('/front/manage_document');
        }
    }

/*
        @Author : Ritesh Rana
        @Desc   : Download contract PDF
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 28/05/2021
    */
    public function downloadContract($contractId)
    {
         /* Start Get Contract Data */
         $dataQuery = ContractData::select(['contract_data.id','contract_data.contract_id'])
         ->where('contract_data.id',$contractId)
         ->first();
         /* End Get Contract Data */
        $setData = $this->getTemplateArr($contractId);
        //dd($setData);
        /* End create array for download file */  
        $type = "pdf";
        /* create PDF */
        $docUrl = $this->changeDocData($dataQuery->contract_id,$setData,$type);
            
       // return response()->json(['status' => 'success', 'docFile' => $docUrl], 200);

    }


    /*
        @Author : Ritesh Rana
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 20/05/2021
    */
    public function changeDocData($id,$setData,$type)
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

        //$output = shell_exec('export HOME=/var/www/html/docxtopdf/ && libreoffice --headless --convert-to pdf /var/www/html/docxtopdf/newcontract.docx --outdir /var/www/html/docxtopdf/');
        $output = shell_exec('export HOME='.$PdfPath.' && libreoffice --headless --convert-to pdf '.$inputfile.' --outdir '.$PdfPath);
        
        // Save it into PDF
        // $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content, 'PDF');
        // $PDFWriter->save($savePdfPath);

            if($type == 'docx'){
                $fileData = base_path() . '/public/'.CREATE_DOCUMENT_FILE.Auth::user()->id.'/'.$file_name.'.docx';
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

    public function getTemplateArr($contractId)
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
}
