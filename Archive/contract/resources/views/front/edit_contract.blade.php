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

     <!-- Start Head Area -->
     <section class="header-area widget-area">
        <div class="container">
            <h3 class="text-center">{{$contractDetail->title}}</h3>
            <div class="step-process mx-md-auto">
                <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                    <!-- <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-started-tab" data-bs-toggle="pill" data-bs-target="#pills-started" type="button" role="tab" aria-controls="pills-started" aria-selected="true">Get Started</button>
                    </li> -->
                    <?php 
                        $noTemplate = count($template) + 1;
                    ?>
                    @if (!empty($template))
                    <?php $i=1;?>
                    @foreach ($template as $templates)
                    
                    <?php 
                        $prog = 100 * $i / $noTemplate;
                        $temp_name = preg_replace('/\s+/', '', $templates->template_name);
                    ?>
                     <input type="hidden" id="progress_val_{{$temp_name}}" name="progress_val_{{$temp_name}}" value="{{$prog}}"> 
                    <li class="nav-item" role="presentation">
                      <button class="nav-link <?php if($i==1){echo "active";} ?>" id="pills-property-tab-{{$temp_name}}" data-bs-toggle="pill" data-bs-target="#pills-{{$temp_name}}" type="button" role="tab" aria-controls="pills-property" aria-selected="<?php if($i==1){echo "true";}else{echo "false";} ?>">{{$templates->template_name}}</button>
                    </li>
                    <?php $i++; ?>
                    @endforeach
                    @endif
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-print-tab" data-bs-toggle="pill" data-bs-target="#pills-print" type="button" role="tab" aria-controls="pills-print" aria-selected="false">Print/Download</button>
                    </li>
                  </ul>

                  <div class="progress">
                    <div class="progress-bar" id="progressbar" role="progressbar" style="width:{{$progData}}%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
            </div>
        </div>
    </section>
    <!-- End Head Area -->

    <!-- Start Property Area -->
    <section class="process-level-area">
        <div class="container">
            <div class="tab-content tabContent" id="pills-tabContent">
                @if (!empty($template))
                <?php 
                $f=1; 
                $a=0;
                $prev=1;
                ?>
                @foreach ($template as $key=>$templates)
                <?php $template_name = preg_replace('/\s+/', '', $templates->template_name); ?>
                <div class="vehicle-details-area tab-pane fade <?php if($f==1){echo "show active";} ?> " id="pills-{{$template_name}}" role="tabpanel" aria-labelledby="pills-property-tab-{{$template_name}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="main-title">
                            <?php 
                               $skip_page = $key + 1;
                               $position_no = '';
                               $next_template_id = '';
                            if($skip_page != count($template)){
                                $position_no = $template[$skip_page]->position_no;
                                $next_template_id = $template[$skip_page]['id'];
                            }
                           
                                $prev_position_no = '';
                                $prev_template_id = '';
                            if($key != 0){
                                $prev_page = $key - 1;
                                $prev_position_no = $template[$prev_page]->position_no;
                                $prev_template_id = $template[$prev_page]['id'];
                            }
                            
                            ?>
                                <h3>{{$templates->template_name}}</h3>
                                
                            </div>
                            <form class="form" method="POST" id="template_{{$template_name}}" name="template_{{$template_name}}" data-parsley-validate enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="edit_contract_data" name="edit_contract_data" value="edit"> 
                            <input type="hidden" id="next_position_no" name="next_position_no" value="{{$position_no}}"> 
                            <input type="hidden" id="prev_position_no" name="prev_position_no" value="{{$prev_position_no}}">  
                            <input type="hidden" id="contract_data_id" name="contract_data_id" value="{{$contract_data_id}}">    
                            <input type="hidden" id="next_template" name="next_template" value="{{$next_template_id}}">    
                            <input type="hidden" id="template_id" name="template_id" value="{{$templates->id}}">
                            <input type="hidden" id="contract_id" name="contract_id" value="{{$contractDetail->id}}">
                            <input type="hidden" id="template_name" name="template_name" value="{{$template_name}}">
                            <input type="hidden" id="previous_template_id" name="previous_template_id" value="{{$prev_template_id}}">
                            <input type="hidden" id="previous" name="previous" value="<?php echo $prev;?>">

                            <div class="{{$template_name}}">
                            <?php if(!empty($template_form)){
                                foreach ($template_form as $row){
                                    if(!empty($templateField) && count($templateField) > 0){
                                    foreach ($templateField as $value){
                                        if($value->field_id == $row->id){ 
                                if(!empty($row['meta'])){
                                    $meta = (array) json_decode($row['meta']);
                                }else{
                                    $meta = "";
                                }
                                if($row['type'] == 'textarea'){ ?>
                                    <div class="form-group mb-4 <?= $row['name'] == "insert_milestone_one_details" || $row['name'] == "insert_milestone_two_details"?$row['name']:''?>">
                                    <label for="inputMake" class="form-label">{{ !empty($row['label']) ? $row['label'] : '' }} <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <textarea maxlength="55" class="form-control {{ isset($meta['subtype']) && $meta['subtype'] == 'tinymce' ? 'tinyeditor':''}}" <?=!empty($row['is_required'])?'required=true':''?>
                                                     name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id:''?>"
                                                     placeholder="<?= !empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>"
                                                     <?php if(isset($meta['subtype']) && $meta['subtype'] != 'tinymce') { ?>
                                                     <?=!empty($meta['maxlength'])?'maxlength="'.$meta['maxlength'].'"':''?>
                                                     <?=!empty($meta['rows'])?'rows="'.$meta['rows'].'"':''?>
                                                     <?php } ?>
                                                     id="<?=!empty($row['name'])?$row['name']:''?>" >{{ $value->meta_value }}</textarea>
                                                     <span id="errors-container<?=$row['name']?>"></span>
                                    </div>
                                    <?php } else if($row['type'] == 'text'){ ?>
    
                                            <div class="form-group mb-4 <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?> <?= $row['name'] == "amount"?$row['name']:''?>">
                                            <label for="inputMake" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
    
    
                <input type="<?=(!empty($row['type']) && $row['type']=='number')?'number':((!empty($row['subtype']) && $row['subtype'] !='time')?$row['subtype']:'text')?>" class="form-control <?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>"
                <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($row['placeholder'])?$row['placeholder']:''?>" value="{{ $value->meta_value }}" data-parsley-errors-container="#errors-container<?=$row['name']?>" />
                                                    <?php if(!empty($row['subtype']) && $row['subtype'] == 'time') {?>
                                                                <span class="input-group-addon add-on"><i class="bi bi-clock"></i></span>
                                                    <?php } ?>
                                                    
                                            </div>
                                        <?php } else if($row['type'] == 'number' || $row['type'] == 'date'){ ?> 
                                            <div class="<?= $row['name'] == "amount"?$row['name']:''?>">       
                                                <label for="inputEmail4" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                                <div class="form-group mb-4 col-lg-6 type-<?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>">
                                                <input type="<?=(!empty($row['type']) && $row['type']=='number')?'number':((!empty($row['subtype']) && $row['subtype'] !='time')?$row['subtype']:'text')?>" class="form-control <?=($row['type'] == 'date')?'datetimepicker3':''?>"
                                        <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($row['placeholder'])?$row['placeholder']:''?>" value="{{ $value->meta_value }}" data-parsley-errors-container="#errors-container<?=$row['name']?>" />
                                                        <?php if(!empty($row['subtype']) && $row['subtype'] == 'time') {?>
                                                                    <span class="input-group-addon add-on"><i class="bi bi-clock"></i></span>
                                                        <?php } ?>
                                                        <?php if(!empty($row['type']) && $row['type'] == 'date') {?>
                                                        <span class="input-group-addon add-on" ><i class="bi bi-calendar-range"></i></span>
                                                        <span id="errors-container<?=$row['name']?>"></span>
                                                    <?php } ?>
                                                </div>      
                                            </div> 
                                    <?php }elseif($row['type'] == 'radio-group'){ ?>
                                        <div class="form-group col-12 mb-4">
                                            <label for="inputEmail4" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                            <?php if(count($meta['options']) > 0) {
                                                foreach ($meta['options'] as $radio) { ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" <?= $row['name'] == "ans7"?$row['name']:''?>" data-val="<?=!empty($radio->label)?$radio->label:''?>" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id:''?>" <?=!empty($row['required'])?'required=true':''?> id="inlineRadio3" value="<?=!empty($radio->value)?$radio->value:''?>"  <?php if(!empty($value->meta_value) && $value->meta_value == $radio->value){ echo 'checked="checked"';}else if(!empty($radio->selected)){ echo 'checked="checked"';}else{ echo "";} ?>>
                                                <label class="form-check-label" for="inlineRadio3"><?=!empty($radio->label)?$radio->label:''?></label>
                                            </div>
                                            <?php } }  //radio loop ?>
                                        </div>
                                    <?php } else if($row['type'] == 'checkbox-group'){ ?>
                                        <div class="col-lg-6 mb-4">
                                            <label class="mb-2 form-label">{{ !empty($row['label']) ? $row['label'] : '' }}</label>
                                                        <?php 
                                                            $checkedValues =array();
                                                                if(!empty($value->meta_value))
                                                                {
                                                                    $checkedValues = explode(',',$value->meta_value);
                                                                }
                                                        ?>
                                            <?php if(isset($meta['options']) && count($meta['options']) > 0) {
                                                     foreach ($meta['options'] as $checkbox) {
                                                         if(!empty($checkbox->label)) {
                                                         
                                                      ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id.'[]':''?>" type="checkbox" id="inlineCheckbox1" value="<?=!empty($checkbox->value)?$checkbox->value:''?>"
                                                <?=!empty($row['is_required'])?'required=true':''?> <?php if(!empty($checkedValues) && in_array($checkbox->value, $checkedValues)){ echo 'checked="checked"';}elseif(!empty($checkbox->selected)){ echo 'checked="checked"'; }else{ echo "";}?> data-parsley-errors-container="#errors-container<?=$row['name']?>">
                                                <label class="form-check-label" for="inlineCheckbox1"><?=!empty($checkbox->label)?$checkbox->label:''?><?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                                <span id="errors-container<?=$row['name']?>"></span>
                                            </div>
                                            <?php } } } //radio loop ?>
                                        </div>
                                    <?php } else if($row['type'] == 'select') { ?>
                                        <div class="form-group col-12 mb-4 <?= $row['name'] == "frequency"?$row['name']:''?>">
                                                <label for="example-select" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                                <select class="form-control" name="<?=!empty($row['name'])?$row['name'].'_'.$row['id'].'_'.$value->id:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['is_required'])?'required=true':''?> data-parsley-errors-container="#errors-container<?=$row['name']?>">
                                                <?php if(count($meta['options']) > 0) {
                                                    foreach ($meta['options'] as $select) {
                                                         if(!empty($select->label)) {
                                                    ?>
                                                <option value="<?=!empty($select->value)?$select->value:''?>" <?php if(!empty($value->meta_value) && $value->meta_value == $select->value){ echo 'selected="true"';}elseif(!empty($select->selected)){ echo 'selected="true"';}else{ echo "";}?>><?=!empty($select->label)?$select->label:''?></option>
                                            <?php } } } //select loop ?>
                                                </select>
                                                <span id="errors-container<?=$row['name']?>"></span>
                                            </div>
                                    <?php } else if($row['type'] == 'header'){ ?>
                                        <div class="col-md-12 mb-4">
                                                <{{$meta['subtype']}} ><?=!empty($row['label'])?$row['label']:''?></{{$meta['subtype']}}>
    
                                        </div>
    
                                    <?php } ?>
                                <?php $f++;
                                $a++;
                             }}}else{ ?>
                             <?php
                             if(!empty($row['meta'])){
                                    $meta = (array) json_decode($row['meta']);
                                }else{
                                    $meta = "";
                                }
                                if($row['type'] == 'textarea'){ ?>
                                <div class="form-group mb-4 <?= $row['name'] == "insert_milestone_one_details" || $row['name'] == "insert_milestone_two_details"?$row['name']:''?>">
                                    <label for="inputMake" class="form-label">{{ !empty($row['label']) ? $row['label'] : '' }} <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <textarea class="form-control {{ isset($meta['subtype']) && $meta['subtype'] == 'tinymce' ? 'tinyeditor':''}}" <?=!empty($row['is_required'])?'required=true':''?>
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
                                    <div class="form-group mb-4 <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?> <?= $row['name'] == "amount"?$row['name']:''?>">
                                    <label for="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <input type="text" id="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" class="form-control <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>" <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?= !empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
                                                <?php if(!empty($row['subtype']) && $row['subtype'] == 'time') {?>
                                                 <span class="input-group-addon add-on"><i class="bi bi-clock"></i></span>
                                                 <span id="errors-container<?=$row['name']?>"></span>
                                                <?php } ?>
                                </div>

                                <?php } else if($row['type'] == 'number' || $row['type'] == 'date'){ ?> 
                                <div class="<?= $row['name'] == "amount"?$row['name']:''?>">
                                    <label for="inputEmail4" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <div class="form-group mb-4 col-lg-6 type-<?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>">
                                        <input type="<?=(!empty($row['type']) && $row['type']=='number')?'number':((!empty($row['subtype']) && $row['subtype'] !='time')?$row['subtype']:'text')?>" class="form-control <?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>" <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?= !empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
                                                <?php if(!empty($row['type']) && $row['type'] == 'date') {?>
                                                    <span class="input-group-addon add-on" ><i class="bi bi-calendar-range"></i></span>
                                            <?php } ?>
                                    </div>
                                </div> 
                                <?php }elseif($row['type'] == 'radio-group'){ ?>
                                    <div class="form-group col-12 mb-4">
                                        <label for="inputEmail4" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?><?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
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
                                        <label class="mb-2 form-label">{{ !empty($row['label']) ? $row['label'] : '' }} <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
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
                                            <label for="example-select" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
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
                                            <h5><?=!empty($row['label'])?$row['label']:''?></h5>
                                    </div>
                                <?php } else if($row['type'] == 'paragraph'){ ?>
                                    <div class="col-md-12 mb-4">
                                            <p class="info"><?=!empty($row['label'])?$row['label']:''?></p>
                                    </div>
                                <?php } ?>
                                <?php $f++;
                                $a++;
                             ?>
                
                             <?php }} ?>
                                <?php }else{ ?>
                                    <div class="activity-list-item shadow-sm">
                                        <p class="font-weight-bold mb-1 text-center">No record found.</p>
                                    </div>
                            <?php }?>
                            <?php  if(!empty($templateField) && count($templateField) > 0){ ?>
                                <div class="button temp">
                                    
                                    <input type="hidden" id="previous_data_{{$template_name}}" name="previous_data" value=""> 
                                   
                                    <a href="{{url('/front/user_contract_list')}}" class="btn prev-btn">Back</a>  
                                    <button type="button" data-tempName="{{$template_name}}" class="btn edit-and-continue">Save and Continue</button>
                                    <!-- <button type="button" data-tempName="{{$templates->template_name}}" id="preview" class="btn preview">Preview</button> -->
                                <!-- <button type="button" class="btn">Save and Continue</button> -->
                            </div>
                            <a href="javascript:void(0)" data-tempName="{{$template_name}}" class="skip-content skip-and-next">Skip this step for now</a>
                                <?php }else{ ?>
                                    <div class="button temp">
                                        @if ($key == 0)
                                            <a href="{{url('/front/user_contract_list')}}" class="btn prev-btn">Back</a>     
                                        @else
                                            <a href="" class="btn prev-btn">Back</a>     
                                        @endif  
                                        <!-- <a href="#!" class="btn">Save and Continue</a> -->
                                        <button type="button" data-tempName="{{$template_name}}" class="btn save-and-continue">Save and Continue</button>

                                        <!-- <button type="button" class="btn">Save and Continue</button> -->
                                        <!-- <button type="button" data-tempName="{{$templates->template_name}}" id="preview" class="btn preview">Preview</button> -->
                                    </div>
                                    <a href="javascript:void(0)" data-tempName="{{$template_name}}" class="skip-content skip-and-next">Skip this step for now</a>
                                <?php } ?>
                            

                            </div>
                           </form>
                            
                        </div>
                        
                        <div class="col-lg-6 my-4 mt-lg-0">
                            <div class="faq-area">
                                <h5>Frequently Asked Questions</h5>
                                <ul>
                                @foreach ($templates->templateQuestions as $questions)
                                <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree_{{$questions->id}}" aria-expanded="false" aria-controls="collapseThree">
                                            {{$questions->questions}}
                                            </button>
                                            </h2>
                                            <div id="collapseThree_{{$questions->id}}" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                            <?php 
                                                if(!empty($questions->description)){
                                                    echo htmlspecialchars_decode($questions->description);
                                                } ?>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- <li><a href="javascript:void(0)" data-val="{{$questions->description}}" data-teml="{{$templates->template_name}}_{{$questions->id}}" class="questions">{{$questions->questions}}</a>
                                            <div class="description questions_{{$templates->template_name}}_{{$questions->id}}">
                                            
                                            </div>
                                        </li> -->
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $prev++;?>
                @endforeach
                    @endif
                    <div class="tab-pane fade" id="pills-print" role="tabpanel" aria-labelledby="pills-print-tab">
                    <form class="form" method="POST" id="template_print" action="{{ route('submit.contract') }}" name="template_print" data-parsley-validate enctype="multipart/form-data">
                            @csrf
                        <input type="hidden" id="edit_contract_data" name="edit_contract_data" value="edit"> 
                        <div class="print_download">
                            
                        </div>
                    </form>    
                    </div>
            </div>            
        </div>
    </section>
    <!-- End Property Area -->
@endsection
@section('js_section')
    <script>
        window.saveTemplate = "{{ route('contract.saveTemplate') }}";
        window.editTemplate = "{{ route('contract.updateTemplate') }}";
        window.backWithNotSaveTemplate = "{{ route('contract.notSaveTemplate') }}";
    </script>
@endsection