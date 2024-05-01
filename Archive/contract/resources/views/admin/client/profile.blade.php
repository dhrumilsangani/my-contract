@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Admin Profile</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Profile</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="admin_edit_form" name="admin_edit_form" action="{{ route('profile-update', $userdata->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="comp_name">Company name <span class="astrick">*</span></label>
                                <input type="text" class="form-control" id="comp_name" placeholder="Company name" name="company_name" value="{{!empty(old('company_name'))?old('company_name'):$userdata->company_name}}">
                                 @if ($errors->has('company_name'))
                                    <div class="invalid-feedback">{{ $errors->first('company_name') }}</div>
                                  @endif
                          </div>
                          <div class="col-md-6 mb-3">
                              <label for="email">Email <span class="astrick">*</span></label>
                              <input type="text" class="form-control validateEmail" id="email" placeholder="Email Id" name="email" value="{{!empty(old('email'))?old('email'):$userdata->email}}">
                              @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                              @endif
                          </div>
                          <!-- <div class="col-md-6 mb-3">
                              <label for="password">Password <span class="astrick">*</span></label>
                              <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{!empty(old('password'))?old('password'):''}}">
                              @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                              @endif
                          </div>

                          <div class="col-md-6 mb-3">
                              <label for="confirm_password">Confirm password <span class="astrick">*</span></label>
                              <input type="password" class="form-control" id="confirm_password" placeholder="Confirm password" name="confirm_password" value="">
                              @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                              @endif
                          </div> -->
                          
                          <div class="col-md-6 mb-3">
                            <label for="address">Address</label>
                                <input id="address" type="text" class="form-control" name="address" placeholder="Address" value="{{!empty(old('address'))?old('address'):$userdata->address}}">
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                                <input id="phone" type="text" class="form-control onlynum" name="phone" minlength="10" maxlength="15" placeholder="Phone" value="{{!empty(old('phone'))?old('phone'):$userdata->phone}}">
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                        </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/dashboard')}}">Cancel</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection