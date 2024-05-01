@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Content Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit content</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_content" name="edit_content" action="{{ route('update_content', $content->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Title <span class="astrick">*</span></label>
                            <input type="text" name="title" maxlength="100" class="form-control" id="title" placeholder="Title" value="{{!empty(old('title'))?old('title'):$content->title}}" required>
                            @if ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <label for="content">Content <span class="astrick">*</span></label>
                          <textarea class="form-control" name="content" id="content" placeholder="Content">{{!empty(old('content'))?old('content'):$content->content}}</textarea>
                          @if ($errors->has('content'))
                            <div class="invalid-feedback">{{ $errors->first('content') }}</div>
                            @endif
                        </div>
                    
                        <div class="custom-control custom-checkbox mb-3 mt-5">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($content->status)?"checked":""}}>
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/content_management')}}">Cancel</a>
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