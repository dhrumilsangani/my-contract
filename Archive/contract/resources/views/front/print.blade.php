    <div class="row">
                    <input type="hidden" id="prev_position_no" name="prev_position_no" value="{{$template->position_no}}">  
                    <input type="hidden" id="contract_data_id" name="contract_data_id" value="{{$contract_data_id}}">    
                    <input type="hidden" id="contract_id" name="contract_id" value="{{$contract_id}}">
                    <input type="hidden" id="previous_template_id" name="previous_template_id" value="{{$template->id}}">
                    <div class="col-lg-6">
                            <div class="main-title">Print/Download</div>
                            <input type="hidden" class="need_to_get_iFrameUrl" value="{{$doc_url}}"/>
                    </div>
                <div class="col-lg-12 col-md-12 col-12 mb-4 iframeData">
                <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=https://interoperability.blob.core.windows.net/files/MS-DOCX/%5bMS-DOCX%5d-210216.docx' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
                    
                    <iframe src="{{$doc_url}}" width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                </div>
                @if($eventType == "add")
                <div class="form-group col-12 mb-4">
                    <!-- <label for="inputEmail4" class="form-label">Amend Contract</label> -->
                    <label for="inputEmail4" class="form-label">Insert Additional Clause</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input amend_agreement" checked="checked" type="radio" name="amend_agreement" data-val="yes" id="inlineRadio3" value="yes">
                            <label class="form-check-label" for="inlineRadio3">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input amend_agreement" type="radio" name="amend_agreement" data-val="no" id="inlineRadio3" value="no">
                            <label class="form-check-label" for="inlineRadio3">No</label>
                        </div>
                </div>

                <div class="form-group mb-4 amend_header">
                    <label for="inputMake" class="form-label">Insert Clause Header<span class="astrick">*</span></label>
                    <input type="text" id="" placeholder="eg. Extension of Contract" class="form-control amend_header_val" required=true name="amend_header" data-parsley-errors-container="#errors-amend-header" value="" />
                    <span id="errors-amend-header"></span>
                </div>

                <div class="form-group mb-4 insert_other_clause">
                    <label for="inputMake" class="form-label">Insert Additional Clause Language<span class="astrick">*</span></label>
                    <textarea class="form-control tinyeditor insert_other_val" required=true rows="3" name="insert_other_clause_data" placeholder="eg. The parties agree to discuss in good faith an extension of the agreement." data-parsley-errors-container="#errors-container" id="" ></textarea>
                    <span id="errors-container"></span>
                </div>
                @endif

                <?php 
                    $subData = checkSubscriptionDetail();
                ?>
                @if($subData == "Yearly")
                <div class="form-group col-6 mb-4">
                    <label for="example-select" class="form-label">Contract download type</label>
                        <select class="form-control" name="download_type">
                            <option value="docx" selected>DOCX</option>
                            <option value="pdf">PDF</option>
                            <option value="both">DOCX And PDF</option>
                        </select>
                </div>
                @endif
                
                <div class="button temp mb-5">
                    <input type="hidden" id="previous_data_print" name="previous_data" value="">  
                    <button type="button" data-tempName="print" class="back-and-edit-print btn prev-btn">Back</button>
                    <button type="submit" value="submit" name="submit" class="btn">Submit</button>
                    @if($eventType == "add")
                    <!-- <button type="submit" value="preview" name="preview" formtarget="_blank" class="btn">Preview</button> -->
                    <button type="submit" value="preview" name="preview" formtarget="_blank" class="btn">Download Docx</button>
                    @endif
                    <!-- <a href="{{url('/front/user_contract_list')}}" class="btn">Submit</a> -->
                </div>
            </div>