<?php if(!empty($template_form)){
                                foreach ($template_form as $row){
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
                                <textarea class="form-control {{ isset($meta['subtype']) && $meta['subtype'] == 'tinymce' ? 'tinyeditor':''}}" <?=!empty($row['is_required'])?'required=true':''?>
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
                            <?php }}} ?>

                            <?php }else{ ?>
                            <div class="activity-list-item shadow-sm">
                                <p class="font-weight-bold mb-1 text-center">No record found.</p>
                            </div>
                            <?php }?>

                            <div class="button temp">
                                <?php $template_name = preg_replace('/\s+/', '', $template->template_name); ?>
                                    
                                    <input type="hidden" id="previous_data_{{$template_name}}" name="previous_data" value=""> 
                                    @if($prev == 2 && $prveSign == "previous") 
                                        @if($eventType == "edit")
                                        <a href="{{url('/front/user_contract_list')}}" class="btn prev-btn">Back</a>   
                                        @else    
                                        <a href="{{ route('contract.type', $contractDetail->sub_category_id) }}" class="btn prev-btn">Back</a>  
                                        @endif
                                    
                                    @else
                                    <button type="button" data-tempName="{{$template_name}}" class="back-and-edit btn prev-btn">Back</button>
                                    @endif

                                    <button type="button" data-tempName="{{$template_name}}" class="btn edit-and-continue">Save and Continue</button>
                                    @if($eventType == "add")
                                        <button type="button" data-tempName="{{$template_name}}" id="preview" class="btn preview">Preview</button>
                                    @endif
                                <!-- <button type="button" class="btn">Save and Continue</button> -->
                            </div>
                            <a href="javascript:void(0)" data-tempName="{{$template_name}}" class="skip-content skip-and-next">Skip this step for now</a>