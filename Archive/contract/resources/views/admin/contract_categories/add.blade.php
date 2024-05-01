@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Categories Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add category</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_categories" name="add_categories" action="{{ route('store_categories') }}" enctype="multipart/form-data">
                              @csrf
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Category name <span class="astrick">*</span></label>
                            <input type="text" name="categories_name" maxlength="25" class="form-control" id="categories_name" placeholder="Category name" value="{{old('categories_name')}}" required>
                            @if ($errors->has('categories_name'))
                            <div class="invalid-feedback">{{ $errors->first('categories_name') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-row">
                        <div class="form-group mb-3">
                          <label for="customFile">Image <span class="astrick">*</span></label>
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" required id="image customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($errors->has('image'))
                              <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            @endif
                          </div>
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
                        <a class="btn btn-secondary" href="{{url('/admin/categories_management')}}">Cancel</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection