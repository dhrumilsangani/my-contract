@extends('front/layouts.master')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-lg-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Contract template</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{url('/front/dashboard')}}">Home</a></li>
                        <li>Contract template</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

     <!-- Start Contact Area -->
     <div class="contact-us section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Alert messages code start here -->
                @include('message_data')
            <!-- Alert messages code end here -->
             <div class="row">
                           <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                           <h2 class="h4 mb-1">{{ $contractDetail->title }}</h2>
                    <div class="contact-form">
                        <form class="form" method="post" id="template_frm" name="template_frm" data-parsley-validate action="{{ route('contract.saveTemplate') }}" enctype="multipart/form-data">
                                    @csrf


                        <div class="form-row row">
                        <div class="form-group col-12 mb-4">
                                    <label for="example-select">Contract name <span class="astrick">*</span></label>
                                    <input type="text" name="contract_name" class="form-control" required id="" placeholder="Contract name" value="" re/>
                                </div>
                        <?php if(!empty($template_form)){
                                foreach ($template_form as $row){
                                if(!empty($row['meta'])){
                                    $meta = (array) json_decode($row['meta']);
                                }else{
                                    $meta = "";
                                }
                                if($row['type'] == 'textarea'){ ?>
                                <div class="form-group <?= $row['name'] == "insert_milestone_one_details" || $row['name'] == "insert_milestone_two_details"?$row['name']:''?>">
                                <label>{{ !empty($row['label']) ? $row['label'] : '' }} <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                <textarea maxlength="55" class="form-control {{ isset($meta['subtype']) && $meta['subtype'] == 'tinymce' ? 'tinyeditor':''}}" <?=!empty($row['is_required'])?'required=true':''?>
                                                 name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>"
                                                 placeholder="<?= !empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>"
                                                 <?php if(isset($meta['subtype']) && $meta['subtype'] != 'tinymce') { ?>
                                                 <?=!empty($meta['maxlength'])?'maxlength="'.$meta['maxlength'].'"':''?>
                                                 <?=!empty($meta['rows'])?'rows="'.$meta['rows'].'"':''?>
                                                 <?php } ?>
                                                 id="<?=!empty($row['name'])?$row['name']:''?>" ></textarea>
                                                 <span id="errors-container<?=$row['name']?>"></span>
                                </div>
                                <?php
                                } else if($row['type'] == 'text'){ ?>
                                                
                                        <div class="form-group col-12 mb-4 <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?> <?= $row['name'] == "amount"?$row['name']:''?>">
                                        <label for="inputEmail4"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>

                <input type="text" class="form-control <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>"
            <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($row['placeholder'])?$row['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
                                                <?php if(!empty($row['subtype']) && $row['subtype'] == 'time') {?>
                                                 <span class="input-group-addon add-on"><i class="bi bi-clock"></i></span>
                                                 <span id="errors-container<?=$row['name']?>"></span>
                                                <?php } ?>
                                                
                                        </div>
                            <?php } else if($row['type'] == 'number' || $row['type'] == 'date'){ ?> 
                                <div class="<?= $row['name'] == "amount"?$row['name']:''?>">
                                <label for="inputEmail4"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                <div class="form-group col-lg-6 type-<?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>">
                                        


                                        <input type="<?=(!empty($row['type']) && $row['type']=='number')?'number':((!empty($row['subtype']) && $row['subtype'] !='time')?$row['subtype']:'text')?>" class="form-control <?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>"
            <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($row['placeholder'])?$row['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
                                                <?php if(!empty($row['type']) && $row['type'] == 'date') {?>
                                                <span class="input-group-addon add-on" ><i class="bi bi-calendar-range"></i></span>
                                            <?php } ?>
                                        </div>
                                        </div>      
                                <?php }elseif($row['type'] == 'radio-group'){ ?>
                                    <div class="form-group col-12 mb-4">
                                        <label><?= !empty($row['label']) ? $row['label'] : '' ?><?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                        <?php if(count($meta['options']) > 0) {
                                            foreach ($meta['options'] as $radio) {
                                                if(!empty($radio->label)){ ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input <?= $row['name'] == "answer7"?$row['name']:''?>" data-val="<?=!empty($radio->label)?$radio->label:''?>" type="radio" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" <?=!empty($row['required'])?'required=true':''?> id="inlineRadio3" value="<?=!empty($radio->value)?$radio->value:''?>" <?=!empty($radio->selected)?'checked="checked"':''?>>
                                            <label class="form-check-label" for="inlineRadio3"><?=!empty($radio->label)?$radio->label:''?></label>
                                        </div>
                                        <?php } } } //radio loop ?>
                                    </div>
                                <?php } else if($row['type'] == 'checkbox-group'){ ?>
                                    <div class="col-lg-6 mb-4">
                                        <label class="mb-2">{{ !empty($row['label']) ? $row['label'] : '' }} <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                        <?php if(count($meta['options']) > 0) {
                                                 foreach ($meta['options'] as $checkbox) {
                                                     if(!empty($checkbox->label)) {
                                                  ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'[]':''?>" type="checkbox" id="inlineCheckbox1" value="<?=!empty($checkbox->value)?$checkbox->value:''?>" <?=!empty($checkbox->selected)?'checked="checked"':''?>
                                                            <?=!empty($row['is_required'])?'required=true':''?> data-parsley-errors-container="#errors-container<?=$row['name']?>">
                                            <label class="form-check-label" for="inlineCheckbox1"><?=!empty($checkbox->label)?$checkbox->label:''?></label>
                                        </div>
                                        <span id="errors-container<?=$row['name']?>"></span>
                                        <?php } } } //radio loop ?>
                                    </div>
                                <?php } else if($row['type'] == 'select') { ?>
                                    <div class="form-group col-12 mb-4 <?= $row['name'] == "frequency"?$row['name']:''?>">
                                            <label for="example-select"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                            <select class="form-control" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['is_required'])?'required=true':''?> data-parsley-errors-container="#errors-container<?=$row['name']?>">
                                            <?php if(count($meta['options']) > 0) {
                                                foreach ($meta['options'] as $select) {
                                                     if(!empty($select->label)) {
                                                ?>
                                            <option value="<?=!empty($select->value)?$select->value:''?>" <?= !empty($select->selected)?'selected="true"':''?> ><?=!empty($select->label)?$select->label:''?></option>
                                        <?php } } } //select loop ?>
                                            </select>
                                            <span id="errors-container<?=$row['name']?>"></span>
                                        </div>
                                <?php } else if($row['type'] == 'header'){ ?>
                                    <div class="col-md-12 mb-4">
                                            <p class="fw-bold"><?=!empty($row['label'])?$row['label']:''?></p>

                                    </div>

                                <?php } else if($row['type'] == 'file'){ ?>

                                    <div class="form-group col-12">
                                        <label for="inputEmail4"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <input type="file" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'[]':''?>" id="<?=!empty($row['name'])?$row['name']:''?>"  class="form-control-file"
                                            <?=!empty($meta->multiple)?'multiple="true"':''?> <?= !empty($row['is_required']) ? 'required=true' : '' ?> data-parsley-errors-container="#errors-container<?=$row['name']?>">
                                            <span id="errors-container<?=$row['name']?>"></span>
                                </div>

                            <?php } ?>
                            <?php } ?>

                                <div class="form-group col-12">
                                    <label for="example-select">Contract download type</label>
                                    <select class="form-control" name="download_type">
                                        <option value="docx" selected>DOCX</option>
                                        <option value="pdf">PDF</option>
                                    </select>
                                </div>

                            <?php }else{ ?>
                            <div class="activity-list-item shadow-sm">
                                <p class="font-weight-bold mb-1 text-center">No record found.</p>
                            </div>
                            <?php }?>
                        </div>

                        <div class="button ">
                            <input type="hidden" id="template_id" name="template_id" value="{{$template->id}}">
                            <input type="hidden" id="contract_id" name="contract_id" value="{{$contractDetail->id}}">
                            
                            <div class="d-flex">
                                <!-- <button type="submit" name="submit" value="view" class="btn">View</button> -->
                                <button type="button" name="submit" value="view" id="reviewContract" target="_blank" class="btn">View</button>
                                <!-- <button type="submit" name="submit" value="download" class="btn">Download</button> -->
                                <button type="button" name="submit" value="download" id="downloadContract" class="btn">Download</button>
                            </div>
                            <button type="submit" name="submit" value="submit" class="btn mt-2">Send Message</button>
                        </div>
                        </form>
                    </div>
                     </div>
                           <div class="col-lg-6 order-1 order-lg-2">
                            <div class="contact-widget-wrapper">
                                   <p><?php if(!empty($contractDetail->contract_faq)) echo htmlspecialchars_decode($contractDetail->contract_faq); ?></p>
                               </div>
                           </div>
                       </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Contact Area -->
@endsection
