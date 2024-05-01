@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              
              <div class="row">
                <!-- Striped rows -->
                <div class="col-md-12 my-4">
                  <h2 class="h4 mb-1">Transactions Management</h2>
                  <div class="card shadow">
                    <div class="card-body">
                    @include('message_data')
                      <div class="toolbar row mb-3">
                        <div class="col">
                          <form class="form-inline" action="" method="GET" role="search">
                            <div class="form-row">
                              <div class="form-group col-auto mr-2">
                                <label for="search" class="sr-only">Search</label>
                                <input type="text" placeholder="Search" class="form-control" id="search_by_english_text" name="search_by_user_name" value="{{isset($request->search_by_user_name)?$request->search_by_user_name:'' }}">
                              </div>
                            </div>
                            <button type="submit" name="search_submit" value="1" class="btn btn-primary mr-2">Search</button>
                            <a href="{{ url('/admin/transaction_management') }}" class="btn btn-secondary">Reset</a>
                          </form>
                        </div>
                        <div class="col ml-auto">
                          <div class="dropdown float-right">
                          </div>
                        </div>
                      </div>
                      <!-- table -->
                      <table class="table table-bordered">
                        <thead>
                          <tr role="row">
                          <th>#</th>
                        <th>Company name</th>
                        <th>Amount</th>
                        <th>Duration</th>
                        <th>Transaction id</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                       
          <?php 
            if(!empty($paymentData)){
                //$i = 1;
                $i = $paymentData->perPage() * ($paymentData->currentPage() - 1) + 1;
                foreach ($paymentData as $key => $value) { ?>
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$value->company_name}}</td>
                        <td> {{ $value->currency == "eur" ? "€":"$" }} {{$value->amount}}</td>
                        <td>{{$value->type}}</td>
                        <td>{{$value->transaction_id}}</td>
                        <td>{{ convertDate($value->created_at) }}</td>
                        <td>{{$value->transaction_status}}</td>
                        <td class="mb-0 text-center">
                          <a class="mr-3" href="{{url('admin/view_transaction/'.$value->id)}}" alert="Edit"><i class="fe fe-file fe-16"></i></a>
                        </td>
                    </tr>
            <?php 
                $i++;
                }}
            ?>
                        </tbody>
                      </table>
                      <div class="d-flex justify-content-center">  {!! $paymentData->withQueryString()->links("pagination::bootstrap-4") !!}</div>
                    </div>
                  </div>
                </div> <!-- simple table -->
              </div> <!-- end section -->
              
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        
@endsection