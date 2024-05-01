@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Edit Categories Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit category</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                        <form class="needs-validation" novalidate id="edit_categories" name="edit_categories" action="{{ route('update_categories', $categories->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf            
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="name">Category name <span class="astrick">*</span></label>
                                <input type="text" class="form-control" id="categories_name" placeholder="Category name" maxlength="25" name="categories_name" value="{{!empty(old('categories_name'))?old('categories_name'):$categories->categories_name}}">
                                 @if ($errors->has('categories_name'))
                                    <div class="invalid-feedback">{{ $errors->first('categories_name') }}</div>
                                  @endif
                          </div>
                        </div>
                        <?php
				$image = $categories->image;
        if(empty($image)){
					$doc = "";
				}
				else
				{
          $imagePath = public_path(CATEGORIE_IMAGE.$image);
          $image_url		=	asset(CATEGORIE_IMAGE.$image);
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
                        <div class="form-group mb-5">
                          <label for="customFile">Image</label>
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($errors->has('image'))
                              <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                            @endif
                            <div class="row align-items-center">
                              <div class="col-md-3 text-center mb-3">
                                <div class="avatar avatar-xl">
                                  <img src="{{ $doc }}" alt="..." class="avatar-img rounded-circle">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        
                        <div class="custom-control custom-checkbox mb-4">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1" {{!empty($categories->status)?"checked":""}}>
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