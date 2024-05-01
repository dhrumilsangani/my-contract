@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="page-title">Questionnaire Template Management</h2>
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title template-title">Add template</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                    <form method="post" id="formbuild_data" name="formbuild_data" action="{{ route('store_template') }}">
                                    @csrf
        <div class="category-section">
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
					
					<!--
                    <div class="form-row">
						<div class="col-md-6 mb-3">
							<label for="validationCustom04">Contract <span class="astrick">*</span></label>
							<select class="custom-select" id="contract_name" name="contract_name" id="validationCustom04" required>
							<option selected disabled value="">Select contract</option>
							@foreach ($contracts as $contract)
							  <option value="{{$contract->id}}">{{ $contract->title }}</option>
							@endforeach
							</select>
							<span class="form-error" id='error-contract'></span>
						</div>
					  </div> -->
					  
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                              <label for="email">Template name <span class="astrick">*</span></label>
                                  <input type="text" maxlength="35" name="template_name" class="form-control" id="template_name" placeholder="Template name" value="" required>
                                  <span class="form-error" id='error-contract'></span>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="col-md-6 mb-3">
                              <label for="email">Position number <span class="astrick">*</span></label>
                                  <input type="number" maxlength="3" name="position_no" class="form-control" id="position_no" placeholder="Position number" value="" required>
                                  <span class="form-error" id='error-contract'></span>
                            </div>
                          </div>
                          </div>
                        
                    <div id="stage1" class="build-wrap">
                    
                    </div>
                          <div class="render-wrap">
                          
                          </div>
                          <button type="button" id="edit-form" class="btn btn-primary">Edit Form</button>
                              <input type="hidden" id="formbuild_data_val" name="form_data">
                              <input type="hidden" id="form_json_data" name="form_json_data">
                              <input type="hidden" id="form_secret" name="form_secret"  value="">

                          </form>
                          <div class="action-buttons">
                              <button style="display: none" id="showData" type="button">Show Data</button>
                              <button style="display: none" id="clearFields" type="button">Clear All Fields</button>
                              <button style="display: none" id="getData" type="button">Get Data</button>
                              <button style="display: none" id="getXML" type="button">Get XML Data</button>
                              <button style="display: none" id="getJSON" type="button">Get JSON Data</button>
                              <button style="display: none" id="getJS" type="button">Get JS Data</button>
                              <button style="display: none" id="setData" type="button">Set Data</button>
                              <button style="display: none" id="addField" type="button">Add Field</button>
                              <button style="display: none" id="removeField" type="button">Remove Field</button>
                              <button style="display: none" class="btn btn-primary" id="testSubmit" type="submit">Submit</button>
                              <button style="display: none" id="resetDemo" type="button">Reset Demo</button>
                              <a class="btn btn-secondary" href="{{url('/admin/template_management')}}">Cancel</a>
                          </div>
                          
                        
                        </div>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /.col -->   
              </div> <!-- end section -->
            </div> <!-- /.col-12 col-lg-10 col-xl-10 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        @endsection