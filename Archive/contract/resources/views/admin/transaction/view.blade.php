@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">View Transactions Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">View transactions</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_client_page" name="add_client_page" action="{{ route('store_client') }}">
                                    @csrf
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="com_name"><strong>Company name:</strong></label>
                            {{ $paymentData->company_name }}
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="email"><strong>Amount:</strong></label>
                            {{ $paymentData->currency == "eur" ? "€":"$" }} {{$paymentData->amount}}
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="password"><strong>Duration:</strong></label>
                            {{ $paymentData->type }}      
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="confirm_password"><strong>Transaction id:</strong></label>
                            {{ $paymentData->transaction_id }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address"><strong>Status:</strong></label>
                            {{ $paymentData->transaction_status }}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone"><strong>Date:</strong></label>
                            {{ date("m-d-Y", strtotime($paymentData->created_at)) }}
                        </div>
                        </div>
                        

                        <a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection
