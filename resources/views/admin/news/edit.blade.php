@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit News Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit news</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_news" name="edit_news" action="{{ route('update_news', $news->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                      
                        <div class="form-group mb-3">
                            <label for="name">Title <span class="astrick">*</span></label>
                            <input type="text" maxlength="100" name="title" class="form-control" id="title" placeholder="News title" value="{{!empty(old('title'))?old('title'):$news->title}}" required>
                            @if ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description<span class="astrick">*</span></label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description">{{!empty(old('description'))?old('description'):$news->description ? $news->description:'' }}</textarea>
                            <span class="form-error" id='error-description'></span>
                        </div>

                            <?php
                            $image = $news->image;
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
                        
                          
                       
                        <div class="custom-control custom-checkbox mb-4 mt-5">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($news->status)?"checked":""}}>
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