@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">News Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">News management</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_news" name="add_news" action="{{ route('store_news') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group mb-3">
                        <label for="name">Title<span class="astrick">*</span></label>
                        <input type="text" maxlength="100" name="title" class="form-control" id="title"  value="{{old('title')}}" required>
                        @if ($errors->has('title'))
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                        @endif
                        </div>
                        
                        
                            <div class="form-group mb-3">
                            <label for="description">Description<span class="astrick">*</span></label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description">{{old('description')}}</textarea>
                                <span class="form-error" id='error-description'></span>
                            </div>
                        

                        <div class="form-group mb-3">
                          <label for="customFile">Image <span class="astrick">*</span></label>
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" required id="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($errors->has('image'))
                              <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            @endif
                          </div>
                        </div>

                      

                        <div class="custom-control custom-checkbox mb-4">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1">
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/news_management')}}">Cancel</a>
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