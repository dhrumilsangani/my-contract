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
                      <strong class="card-title">Edit Client</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_form" name="edit_form" action="{{ route('update_client', $userdata->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Your name <span class="astrick">*</span></label>
                                <input type="text" class="form-control" maxlength="25" id="name" placeholder="Your name" name="name" value="{{!empty(old('name'))?old('name'):$userdata->name}}" required>
                                 @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                  @endif
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="comp_name">Company name <span class="astrick">*</span></label>
                                <input type="text" class="form-control" maxlength="25" id="comp_name" placeholder="Company name" name="company_name" value="{{!empty(old('company_name'))?old('company_name'):$userdata->company_name}}">
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
                          <div class="col-md-6 mb-3">
                            <label for="address">Address</label>
                                <input id="address" type="text" maxlength="155" class="form-control" name="address" placeholder="Address" value="{{!empty(old('address'))?old('address'):$userdata->address}}">
                                <div class="invalid-feedback">{{ $errors->first('address') }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                                <input id="phone" type="text" class="form-control onlynum" minlength="10" maxlength="15" name="phone" placeholder="Phone" value="{{!empty(old('phone'))?old('phone'):$userdata->phone?$userdata->phone:''}}">
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