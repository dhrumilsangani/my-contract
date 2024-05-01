<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\News;
use App\Models\Contract;
use App\Models\ContractData;
use App\Models\ContractCategories;
use App\Models\FrequentlyQuestions;
use App\Models\SubCategories;
use App\Models\Template;
use App\Models\TemplateForm;
use App\Models\Subscriber;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\View;
use App\Traits\SendMail;
use Illuminate\Support\Facades\Config;

class NewsController extends Controller
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
        @Author : Sanjay Saw
        @Desc   : Display a listing of the resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function index(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_news_managemnet.js";

        $dataQuery = News::select("id",'title','description','image','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('title', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.news.index', compact('data','request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Show the form for creating a new resource.
        @Input  : 
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function create(Request $request)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_news_managemnet.js";
        
        return view('admin.news.add', compact('request','footerJs'));
    }

    /*
        @Author : Sanjay Saw
        @Desc   : Store a newly created resource in storage.
        @Input  : \Illuminate\Http\Request  $request
        @Output : \Illuminate\Http\Response
        @Date   : 17/03/2022
    */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            //'image' => 'mimes:jpeg,jpg,png,gif|required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
            //'content' => 'required',
        ]);

        $document_file = $request->image;
        $file_name = time().'.'.$document_file->getClientOriginalExtension();
        $destinationPath = public_path(config('constants.teamPath'));
        $document_file->move($destinationPath, $file_name);

        $image_url = asset(TEAM_IMAGE.$file_name);
        
        $news = new News();
        $news->title = $request->title;
        $news->description = strip_tags($request->description);
        $news->image = $file_name;
        $news->status = isset($request->status)?1:0;
        $news->save();
        
        $subscriber_emails = Subscriber::select('email')->get();
        $emails_sub = array();
        foreach( $subscriber_emails as $subscriber_email) {
          array_push($emails_sub,$subscriber_email->email);
        }
        // $data = array('message_data' => strip_tags($request->description), 'title' => $request->title, 'imageurl'=> $image_url);
        // Mail::send('emails.news_mail', $data, function ($message) use ($request,$emails_sub) {
        //     $message->to($emails_sub)->subject($request->title);
        //     $message->from('sanjay050293@gmail.com', 'Contract');
        // });
        //$emailData = implode(",",$emails_sub);
        if(!empty($emails_sub)){
            $subject = $request->title;
            $data = array('message_data' => strip_tags($request->description), 'title' => $request->title, 'imageurl'=> $image_url);
            $makeHtmlView = (string)View::make('emails.news_mail', $data);
            $this->fire($emails_sub,$subject,$makeHtmlView);
        }
        

        alert()->success('News created successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/news_management')->with('success', 'News created successfully!');
    }

    /*
        @Author : Sanjay Saw
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
        @Author : Sanjay Saw
        @Desc   : Show the form for editing the specified resource.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 04/01/2022
    */
    public function edit(Request $request,$id)
    {
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_news_managemnet.js";

        $news = News::find($id);
        return view('admin.news.edit', compact('request','news','footerJs'));
    }

    
    /*
        @Author : Sanjay Saw
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
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $file = $request->file('image');

        if(!empty($file)){
            $fileArr = News::select('image')->where(array('id'=>$id))->first();
            if(!empty($fileArr)){
                $image_path = base_path() . '/public/'.TEAM_IMAGE.$fileArr->image;
                if (file_exists($image_path)) {
                    @unlink($image_path);
                }
            }

            $file_name = time().'.'.$file->getClientOriginalExtension();
            $file->move(base_path() . '/public/'.TEAM_IMAGE, $file_name);
            $document = array(
                'image' =>   $file_name,
            );
            News::where('id', $id)->update($document);
        }

        $news = News::find($id);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->status = isset($request->status)?1:0;
        $news->save();
     
        alert()->success('News updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/news_management');
    }

     /*
        @Author : Sanjay Saw
        @Desc   : Remove the specified resource from storage.
        @Input  : int  $id
        @Output : \Illuminate\Http\Response
        @Date   : 17/05/2021
    */
    public function destroy($id)
    {
        $category = News::find($id)->delete();
        alert()->success('News deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/news_management');
    }
}
