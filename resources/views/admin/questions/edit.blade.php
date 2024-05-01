@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Frequently Asked Question</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Edit questions</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                    <form method="post" id="formbuild_data" name="formbuild_data" action="{{ route('update_questions') }}">
                                    @csrf
          	<div class="form-row">
						  <div class="col-md-6 mb-3">
							<label for="category_id">Select category<span class="astrick">*</span></label>
							<select class="custom-select" id="category_id" name="category_id" required>
								<option selected disabled value="">Select category</option>
								@foreach ($categories as $cat)
								  <option value="{{$cat->id}}" {{ $getFormData->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->categories_name }}</option>
								@endforeach
							</select>
							<span class="form-error" id='error-category'></span>
						  </div>
						</div>
						
						<div class="form-row">
						  <div class="col-md-6 mb-3">
							<label for="sub_category_id">Select sub category<span class="astrick">*</span></label>
								<select class="custom-select" id="sub_category_id" name="sub_category_id" required>
								<option selected disabled value="">Select sub category</option>
								@foreach ($subcategory as $subcat)
								  <option value="{{$subcat->id}}" {{ $getFormData->sub_category_id == $subcat->id ? 'selected' : '' }}>{{ $subcat->sub_categories_name }}</option>
								@endforeach
							</select>
							<span class="form-error" id='error-sub-category'></span>
						  </div>
						</div>
						
						<div class="form-row">
							<div class="col-md-6 mb-3">
								<label for="validationCustom04">Contract <span class="astrick">*</span></label>
									<select class="custom-select" id="contract_name" name="contract_name" id="validationCustom04" required>
										<option selected disabled value="">Select contract</option>	
											@foreach ($contractRs as $contra)
												<option value="{{$contra->id}}" {{ $getFormData->contract_id == $contra->id ? 'selected' : '' }}>{{ $contra->title }}</option>
											@endforeach
									</select>
								<span class="form-error" id='error-contract'></span>
							</div>
						</div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                              <label for="template_id">Template name <span class="astrick">*</span></label>
                              <select class="custom-select" id="template_id" name="template_id" id="validationCustom04" required>
                                <option selected disabled value="">Select template name</option>	
                                  @foreach ($templates as $template)
                                    <option value="{{$template->id}}" {{ $getFormData->template_id == $template->id ? 'selected' : '' }}>{{ $template->template_name }}</option>
                                  @endforeach
                              </select>
                                  <span class="form-error" id='error-template-name'></span>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                              <label for="email">Questions<span class="astrick">*</span></label>
                                  <input type="text" name="questions" maxlength="255" class="form-control" id="questions" placeholder="Questions" value="{{ !empty($getFormData->questions) ? $getFormData->questions:''}}" required>
                                  <span class="form-error" id='error-questions'></span>
                            </div>
                          </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="description">Description<span class="astrick">*</span></label>
                              <textarea class="form-control" name="description" id="description" placeholder="Description">{{ !empty($getFormData->description) ? $getFormData->description:''}}</textarea>
                              <span class="form-error" id='error-description'></span>
                          </div>
                        </div>
                    
                        <input type="hidden" id="questions_id" name="questions_id" value="{{$id}}">
                          <button type="submit" class="btn btn-primary">Save</button>
                          <a class="btn btn-secondary" href="{{url('/admin/frequently_questions')}}">Cancel</a>
                          </form>
                        </div>
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