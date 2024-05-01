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
                      <strong class="card-title">View Template</strong>
                    </div>
                    <div class="card-body">
                    @include('message_data')
                    <input type="hidden" id="editformjson" value='{{json_encode($getFormData->form_json_data)}}'>
                    <form method="post" id="view_formbuild_data" name="view_formbuild_data" >
                                    @csrf
                    <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom04">State</label>
                            @foreach ($contracts as $contract)
                               {{ !empty($getFormData->contract_id) && $getFormData->contract_id == $contract->id ? $contract->title:''}}
                            @endforeach
                            <span class="form-error" id='error-contract'></span>
                            <!-- <div class="invalid-feedback"> Please select a valid state. </div> -->
                          </div>
                        </div>
                    <div id="stage1" class="build-wrap">
                    
                    </div>
                          <div class="render-wrap">
                          
                          </div>
                          <button id="edit-form" class="btn btn-primary">Back</button>
                              <input type="hidden" id="form_id" name="form_id" value="{{$id}}">
                              <input type="hidden" id="formbuild_data_val" name="form_data">
                              <input type="hidden" id="form_json_data" name="form_json_data">
                              <input type="hidden" id="form_secret" name="form_secret"  value="">
                              <input type="hidden" id="contract_name" name="contract_name"  value="{{$getFormData->contract_id}}">
                          </form>
                          <div class="action-buttons">
                              <!-- <button style="display: none" id="showData" type="button">Show Data</button>
                              <button style="display: none" id="clearFields" type="button">Clear All Fields</button>
                              <button style="display: none" id="getData" type="button">Get Data</button>
                              <button style="display: none" id="getXML" type="button">Get XML Data</button>
                              <button style="display: none" id="getJSON" type="button">Get JSON Data</button>
                              <button style="display: none" id="getJS" type="button">Get JS Data</button>
                              <button style="display: none" id="setData" type="button">Set Data</button>
                              <button style="display: none" id="addField" type="button">Add Field</button>
                              <button style="display: none" id="removeField" type="button">Remove Field</button>
                              <button style="display: none" id="testSubmit" type="submit">Submit</button>
                              <button style="display: none" id="resetDemo" type="button">Reset Demo</button> -->
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
