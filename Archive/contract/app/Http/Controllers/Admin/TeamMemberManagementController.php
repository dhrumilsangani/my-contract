<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Config;
use RealRashid\SweetAlert\Facades\Alert;

class TeamMemberManagementController extends Controller
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
        $footerJs[1]    = "admin/customJs/admin_team_managemnet.js";

        $dataQuery = TeamMember::select("id",'name','image','positions','facebook','twitter','linkedin','status');
        if ($request->has('search_by_title') && $request->search_by_title != '') {
           $dataQuery->where('name', 'like', '%' . $request->search_by_title . '%')
           ->orWhere('positions', 'like', '%' . $request->search_by_title . '%');
        }
        $data = $dataQuery->orderBy('id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.team.index', compact('data','request','footerJs'));
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
        $footerJs[1]    = "admin/customJs/admin_team_managemnet.js";
        return view('admin.team.add', compact('request','footerJs'));
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
            'name' => 'required',
            'positions' => 'required',
            //'image' => 'mimes:jpeg,jpg,png,gif|required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048',
        ]);
        
        $document_file = $request->image;
        $file_name = time().'.'.$document_file->getClientOriginalExtension();
        $destinationPath = public_path(config('constants.teamPath'));
        $document_file->move($destinationPath, $file_name);

        $team = new TeamMember();
        $team->name = $request->name;
        $team->positions = $request->positions;
        $team->image = $file_name;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->linkedin = $request->linkedin;
        $team->status = isset($request->status)?1:0;
        $team->save();
        alert()->success('Team added successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/team_management');
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
        $team = TeamMember::find($id);
        $footerJs[0]    = "admin/js/jquery.validate.min.js";
        $footerJs[1]    = "admin/customJs/admin_team_managemnet.js";
        return view('admin.team.edit', compact('request','team','footerJs'));
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
            'name' => 'required',
            'positions' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:2048',
        ]);


        $file = $request->file('image');

			if(!empty($file)){
            	$fileArr = TeamMember::select('image')->where(array('id'=>$id))->first();
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
                TeamMember::where('id', $id)->update($document);
			}

        $team = TeamMember::find($id);
        $team->name = $request->name;
        $team->positions = $request->positions;
        $team->facebook = $request->facebook;
        $team->twitter = $request->twitter;
        $team->linkedin = $request->linkedin;
        $team->status = isset($request->status)?1:0;
        $team->save();
        alert()->success('Team updated successfully!')->showConfirmButton('Ok', '#07689f');
         return redirect('/admin/team_management');
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
        TeamMember::find($id)->delete();
        alert()->success('Team deleted successfully!')->showConfirmButton('Ok', '#07689f');
        return redirect('/admin/team_management');
    }
}
