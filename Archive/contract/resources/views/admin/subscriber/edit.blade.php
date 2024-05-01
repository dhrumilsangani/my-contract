@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Subscriber Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit subscribers </strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_subs" name="edit_subs" action="{{ route('update_subs', $subscriber->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                      
                        <div class="form-group mb-3">
                            <label for="name">Email <span class="astrick">*</span></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{!empty(old('email'))?old('email'):$subscriber->email}}" required>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="custom-control custom-checkbox mb-3 mt-5">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($subscriber->status)?"checked":""}}>
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>             
                  
        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/subs_management')}}">Cancel</a>
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