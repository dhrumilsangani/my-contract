@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Pricing Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit price</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_price" name="edit_price" action="{{ route('update_price', $pricing->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                      
                          <div class="form-group mb-3">
                            <label for="name">Price title <span class="astrick">*</span></label>
                            <input type="text" name="title" maxlength="25" class="form-control" id="title" placeholder="Price title" value="{{!empty(old('title'))?old('title'):$pricing->title}}" required>
                            @if ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                          </div>

                          <div class="form-group mb-3">
                            <label for="price_features">Price features</label>
                            <textarea class="form-control" name="price_features" id="editor" placeholder="price features">{{!empty($pricing->price_features)?$pricing->price_features:''}}</textarea>
                            @if ($errors->has('price_features'))
                              <div class="invalid-feedback">{{ $errors->first('price_features') }}</div>
                            @endif
                          </div>

                        <div class="form-group mb-3">
                          <label for="value">Price type <span class="astrick">*</span></label>
                          <input type="text" name="type" maxlength="25" class="form-control" id="type"  value="{{!empty(old('type'))?old('type'):$pricing->type}}" required>
                            @if ($errors->has('type'))
                            <div class="invalid-feedback">{{ $errors->first('type') }}</div>
                            @endif
                        </div>
                       
                        <div class="form-group mb-3">
                          <label for="value">Price  <span class="astrick">*</span></label>
                          <input type="text" name="price" maxlength="10" class="form-control" id="price"  value="{{!empty(old('price'))?old('price'):$pricing->price}}" required>
                            @if ($errors->has('price'))
                            <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                          <label for="value">Price code <span class="astrick">*</span></label>
                          <input type="text" name="price_code" maxlength="35" class="form-control" id="price_code"  value="{{!empty(old('price_code'))?old('price_code'):$pricing->price_code}}" required>
                            @if ($errors->has('price_code'))
                            <div class="invalid-feedback">{{ $errors->first('price_code') }}</div>
                            @endif
                        </div>

                        <div class="custom-control custom-checkbox mb-3 mt-5">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($pricing->status)?"checked":""}}>
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>             
                  
        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/price_management')}}">Cancel</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection
@section('js_section')
  <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
@endsection