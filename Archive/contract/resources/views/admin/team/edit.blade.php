@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Team Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit team</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_team" name="edit_team" action="{{ route('update_team', $team->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Name <span class="astrick">*</span></label>
                                <input type="text" maxlength="25" class="form-control" id="name" placeholder="Name" name="name" value="{{!empty(old('name'))?old('name'):$team->name}}">
                                 @if ($errors->has('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                  @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Positions <span class="astrick">*</span></label>
                                <input type="text" maxlength="3" class="form-control" id="positions" placeholder="Positions" name="positions" value="{{!empty(old('positions'))?old('positions'):$team->positions}}">
                                 @if ($errors->has('positions'))
                                    <div class="invalid-feedback">{{ $errors->first('positions') }}</div>
                                  @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Facebook link</label>
                                <input type="text" maxlength="255" class="form-control" id="facebook" placeholder="Facebook" name="facebook" value="{{!empty(old('facebook'))?old('facebook'):$team->facebook}}">
                                 @if ($errors->has('facebook'))
                                    <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                                  @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Twitter link</label>
                                <input type="text" maxlength="255" class="form-control" id="twitter" placeholder="Twitter" name="twitter" value="{{!empty(old('twitter'))?old('twitter'):$team->twitter}}">
                                 @if ($errors->has('twitter'))
                                    <div class="invalid-feedback">{{ $errors->first('twitter') }}</div>
                                  @endif
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">linkedin link</label>
                                <input type="text" maxlength="255" class="form-control" id="linkedin" placeholder="Linkedin" name="linkedin" value="{{!empty(old('linkedin'))?old('linkedin'):$team->linkedin}}">
                                 @if ($errors->has('linkedin'))
                                    <div class="invalid-feedback">{{ $errors->first('linkedin') }}</div>
                                  @endif
                          </div>
                        </div>
                    
                        <?php
                          $image = $team->image;
                          if(empty($image)){
                            $doc = "";
                          }
                          else
                          {
                            $imagePath = public_path(TEAM_IMAGE.$image);
                            $image_url		=	asset(TEAM_IMAGE.$image);
                            if (file_exists($imagePath)) {
                              $doc = $image_url;
                            }
                            else
                            {
                              $doc = "";
                            }
                          }
                        ?>

                      <div class="form-row">
                        <div class="form-group mb-3">
                          <label for="customFile">Image</label>
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($errors->has('image'))
                              <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            @endif
                            <div class="row align-items-center">
                              <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                  <img src="{{ $doc }}" alt="..." class="avatar-img rounded-circle">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                        <div class="custom-control custom-checkbox mb-3 mt-5">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($team->status)?"checked":""}}>
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