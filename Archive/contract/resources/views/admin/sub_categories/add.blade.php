@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Sub Categories Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add sub category</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_sub_categories" name="add_sub_categories" action="{{ route('store_sub_categories') }}" enctype="multipart/form-data">
                              @csrf
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Category <span class="astrick">*</span></label>
                            <select class="custom-select" id="categories_id" name="categories_id" id="validationCustom04" required>
                            <option selected disabled value="">Select category</option>
                            @foreach ($categories as $categorie)
                              <option value="{{$categorie->id}}" @if(old('categories_id') == $categorie->id) selected @endif>{{ $categorie->categories_name }}</option>
                            @endforeach
                            </select>
                            <span class="form-error" id='error-contract'></span>
                            <!-- <div class="invalid-feedback"> Please select a valid state. </div> -->
                          </div>
                          </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Sub category name <span class="astrick">*</span></label>
                            <input type="text" maxlength="35" name="sub_categories_name" class="form-control" id="sub_categories_name" placeholder="Sub category name" value="{{old('name')}}" required>
                            @if ($errors->has('sub_categories_name'))
                            <div class="invalid-feedback">{{ $errors->first('sub_categories_name') }}</div>
                            @endif
                          </div>
                        </div>
                        
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1">
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/sub_categories_management')}}">Cancel</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection