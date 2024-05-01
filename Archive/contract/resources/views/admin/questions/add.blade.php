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
                      <strong class="card-title">Add questions</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                    <form method="post" id="questions_data" name="questions_data" action="{{ route('store_questions') }}">
                                    @csrf
					<div class="form-row">
					  <div class="col-md-6 mb-3">
						<label for="category_id">Select category<span class="astrick">*</span></label>
						<select class="custom-select" id="category_id" name="category_id" required>
						<option selected disabled value="">Select category</option>
						@foreach ($categories as $cat)
						  <option value="{{$cat->id}}">{{ $cat->categories_name }}</option>
						@endforeach
						</select>
						<span class="form-error" id='error-contract'></span>
					  </div>
					</div>
					
					<div class="form-row">
					  <div class="col-md-6 mb-3">
						<label for="sub_category_id">Select sub category<span class="astrick">*</span></label>
							<select class="custom-select" id="sub_category_id" name="sub_category_id" required>
								<option selected disabled value="">Select sub category</option>
							</select>
						<span class="form-error" id='error-contract'></span>
					  </div>
					</div>
					
					<div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="validationCustom04">Contract <span class="astrick">*</span></label>
								<select class="custom-select" id="contract_name" name="contract_name" id="validationCustom04" required>
									<option selected disabled value="">Select contract</option>							
								</select>
							<span class="form-error" id='error-contract'></span>
						</div>
					</div>
					
          <div class="form-row">
					  <div class="col-md-6 mb-3">
						<label for="template_id">Select Template name<span class="astrick">*</span></label>
							<select class="custom-select" id="template_id" name="template_id" required>
								<option selected disabled value="">Select template</option>
							</select>
						<span class="form-error" id='error-template'></span>
					  </div>
					</div>
          <div class="form-row">
                            <div class="col-md-6 mb-3">
                              <label for="email">Questions<span class="astrick">*</span></label>
                                  <input type="text" maxlength="255" name="questions" class="form-control" id="questions" placeholder="Questions" value="" required>
                                  <span class="form-error" id='error-questions'></span>
                            </div>
                          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="description">Description<span class="astrick">*</span></label>
                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                <span class="form-error" id='error-description'></span>
            </div>
          </div>
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