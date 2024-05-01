@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Contract Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Add contract</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                      <form class="needs-validation" novalidate method="post" id="add_contract" name="add_contract" action="{{ route('store_contract') }}" enctype="multipart/form-data">
						@csrf
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Categories <span class="astrick">*</span></label>
                            <select class="custom-select categories_id" id="categories_id" name="categories_id" required>
                            <option selected disabled value="">Select Categories</option>
                              @foreach ($categories as $categorie)
                                <option value="{{$categorie->id}}">{{ $categorie->categories_name }}</option>
                              @endforeach
                            </select>
                            <span class="form-error" id='error-contract'></span>
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom04">Sub categories <span class="astrick">*</span></label>
                            <select class="custom-select" id="sub_categories_id" name="sub_categories_id" required>
								<option selected disabled value="">Select sub categories</option>								
                            </select>
                            <span class="form-error" id='error-contract'></span>
                          </div>
						</div>

                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="title">Contract title <span class="astrick">*</span></label>
                            <input type="text" name="title" maxlength="50" class="form-control" id="title" placeholder="Contract title" value="{{old('title')}}" required>
                            @if ($errors->has('title'))
                            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                          </div>
                        </div>

                        <div class="form-group mb-3">
                          <label for="detail">Contract detail</label>
                          <textarea class="form-control detail" name="contract_detail" id="detail" placeholder="Contract detail"></textarea>
                          @if ($errors->has('contract_detail'))
                                    <div class="invalid-feedback">{{ $errors->first('contract_detail') }}</div>
                                    @endif
                        </div>

                        <div class="form-group mb-3">
                          <label for="detail">Contract FAQ</label>
                          <textarea class="form-control" name="contract_faq" id="contract_faq" placeholder="Contract FAQ"></textarea>
                          @if ($errors->has('contract_faq'))
                            <div class="invalid-feedback">{{ $errors->first('contract_faq') }}</div>
                          @endif
                        </div>
                       
                      <div class="form-row">
                        <div class="form-group mb-3">
                          <label for="customFile">Contract file <span class="astrick">*</span></label>
                          <div class="custom-file">
                            <input type="file" name="contract_file" class="custom-file-input" id="contractFile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @if ($errors->has('contract_file'))
                              <div class="invalid-feedback">{{ $errors->first('contract_file') }}</div>
                            @endif
                          </div>
                        </div>
                      </div>

                      <!-- <div class="form-row">
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
                      </div> -->
                      
                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" id="status" name="status" class="custom-control-input" value="1">
                          <label class="custom-control-label" for="status">Active</label>
                          <div class="invalid-feedback">Example invalid feedback text</div>
                            @if ($errors->has('status'))
                                <div class="invalid-feedback">{{ $errors->first('status') }}</div>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-secondary" href="{{url('/admin/contract_management')}}">Cancel</a>
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