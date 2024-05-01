@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">CMS Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit CMS Page</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_cms_page" name="edit_cms_page" action="{{ route('update_cms_page', $cms_page->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="page_title">Page title <span class="astrick">*</span></label>
                            <input type="text" name="page_title" maxlength="25" class="form-control" value="{{!empty($cms_page->page_title)?$cms_page->page_title:''}}" id="page_title" placeholder="Page title" required>
                            @if ($errors->has('page_title'))
                            <div class="invalid-feedback">{{ $errors->first('page_title') }}</div>
                            @endif
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="page_slug">Page slug</label>
                                <input type="text" name="page_slug" class="form-control" value="{{!empty($cms_page->page_slug)?$cms_page->page_slug:''}}" id="page_slug" placeholder="Page slug" readonly>
                                    @if ($errors->has('page_slug'))
                                        <div class="invalid-feedback">{{ $errors->first('page_slug') }}</div>
                                    @endif
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <label for="page_content">Page content</label>
                          <textarea class="form-control" name="page_content" id="editor" placeholder="Page content">{{!empty($cms_page->page_content)?$cms_page->page_content:''}}</textarea>
                          @if ($errors->has('page_content'))
                                    <div class="invalid-feedback">{{ $errors->first('page_content') }}</div>
                                    @endif
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($cms_page->status)?"checked":""}}>
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/cms_pages')}}">Cancel</a>
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