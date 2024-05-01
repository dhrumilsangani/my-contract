<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PaymentDetails;
use Illuminate\Support\Facades\Config;

class TransactionManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        $dataQuery = PaymentDetails::select('payment_details.user_id','payment_details.id','users.company_name','users.name','payment_details.amount','payment_details.type','payment_details.transaction_id','payment_details.transaction_status','payment_details.currency','payment_details.created_at')
			->leftJoin('users', 'users.id', '=', 'payment_details.user_id');
            if ($request->has('search_by_user_name') && $request->search_by_user_name != '') {
                $dataQuery->where('users.company_name', 'like', '%' . $request->search_by_user_name . '%');
                $dataQuery->orWhere('payment_details.currency', 'like', '%' . $request->search_by_user_name . '%');
                $dataQuery->orWhere('payment_details.type', 'like', '%' . $request->search_by_user_name . '%');
                $dataQuery->orWhere('payment_details.transaction_status', 'like', '%' . $request->search_by_user_name . '%');
                $dataQuery->orWhere('payment_details.transaction_id', 'like', '%' . $request->search_by_user_name . '%');
            }
        $paymentData=$dataQuery->orderBy('payment_details.id', 'DESC')->paginate(Config::get('constants.LIST_PER_PAGE'));
        return view('admin.transaction.index', compact('paymentData','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentData = PaymentDetails::select('payment_details.created_at','payment_details.user_id','payment_details.id','users.company_name','users.name','payment_details.amount','payment_details.type','payment_details.transaction_id','payment_details.transaction_status','payment_details.currency')
			->leftJoin('users', 'users.id', '=', 'payment_details.user_id')
            ->orderBy('payment_details.id', 'DESC')
            ->where('payment_details.id',$id)
            ->first();
        return view('admin.transaction.view', compact('paymentData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
