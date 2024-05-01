@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Client Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add Client</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_client_page" name="add_client_page" action="{{ route('store_client') }}">
                                    @csrf
                        <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Your name <span class="astrick">*</span></label>
                            <input type="text" name="name" class="form-control" maxlength="25" id="name" placeholder="Your name" value="{{old('name')}}" required>
                            <div class="invalid-feedback">Please enter your name</div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="com_name">Company name <span class="astrick">*</span></label>
                            <input type="text" name="company_name" class="form-control" maxlength="25" id="com_name" placeholder="Company name" value="{{old('company_name')}}" required>
                            <div class="invalid-feedback">Please enter company name</div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="email">Email id <span class="astrick">*</span></label>
                                <input type="text" name="email" class="form-control validateEmail" maxlength="25" id="email" placeholder="Email id" value="{{old('email')}}" required>
                                <div class="invalid-feedback">Please use a valid email</div>
                                    
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="password">Password <span class="astrick">*</span></label>
                                <input type="password" class="form-control" id="password" placeholder="Password" maxlength="10" name="password" value="{{old('password')}}" required>
                                <div class="invalid-feedback">Please enter password</div>
                                
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="confirm_password">Confirm password <span class="astrick">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="confirm_password" maxlength="10" required autocomplete="new-password" value="{{old('confirm_password')}}">
                                <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address">Address</label>
                                <input id="address" type="text" maxlength="155" class="form-control" name="address" placeholder="Address"  value="{{old('address')}}">
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                                <input id="phone" type="text" class="form-control onlynum" minlength="10" maxlength="15" name="phone" placeholder="Phone" value="{{old('phone')}}">
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                
                        </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/client_management')}}">Cancel</a>
                        
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection
