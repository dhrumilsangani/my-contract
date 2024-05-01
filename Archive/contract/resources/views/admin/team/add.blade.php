@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Team Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add team</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_team" name="add_team" action="{{ route('store_team') }}" enctype="multipart/form-data">
                              @csrf
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Name <span class="astrick">*</span></label>
                            <input type="text" name="name" maxlength="25" class="form-control" id="name" placeholder="Name" value="{{old('name')}}" required>
                            @if ($errors->has('name'))
                            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Positions <span class="astrick">*</span></label>
                            <input type="text" maxlength="3" name="positions" class="form-control" id="positions" placeholder="Positions" value="{{old('positions')}}" required>
                            @if ($errors->has('positions'))
                            <div class="invalid-feedback">{{ $errors->first('positions') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Facebook link</label>
                            <input type="text" maxlength="255" name="facebook" class="form-control" id="facebook" placeholder="Facebook" value="{{old('facebook')}}">
                            @if ($errors->has('facebook'))
                            <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Twitter link</label>
                            <input type="text" maxlength="255" name="twitter" class="form-control" id="twitter" placeholder="Twitter" value="{{old('twitter')}}">
                            @if ($errors->has('twitter'))
                            <div class="invalid-feedback">{{ $errors->first('twitter') }}</div>
                            @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Linkedin link</label>
                            <input type="text" maxlength="255" name="linkedin" class="form-control" id="linkedin" placeholder="Linkedin" value="{{old('linkedin')}}">
                            @if ($errors->has('linkedin'))
                            <div class="invalid-feedback">{{ $errors->first('linkedin') }}</div>
                            @endif
                          </div>
                        </div>

                       
                       
                      <div class="form-row">
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
                        <a class="btn btn-secondary" href="{{url('/admin/team_management')}}">Cancel</a>
                      </form>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection