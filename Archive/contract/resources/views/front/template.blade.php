
                            <?php if(!empty($template_form)){
                                foreach ($template_form as $row){
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
                                    <input type="text" id="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" class="form-control <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>" <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
                                                <?php if(!empty($row['subtype']) && $row['subtype'] == 'time') {?>
                                                 <span class="input-group-addon add-on"><i class="bi bi-clock"></i></span>
                                                 <span id="errors-container<?=$row['name']?>"></span>
                                                <?php } ?>
                                </div>

                                <?php } else if($row['type'] == 'number' || $row['type'] == 'date'){ ?> 
                                <div class="<?= $row['name'] == "amount"?$row['name']:''?>">
                                    <label for="inputEmail4" class="form-label"><?= !empty($row['label']) ? $row['label'] : '' ?> <?=$row['is_required'] == '1' ? '<span class="astrick">*</span>':''?></label>
                                    <div class="form-group mb-4 col-lg-6 type-<?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>">
                                        <input type="<?=(!empty($row['type']) && $row['type']=='number')?'number':((!empty($row['subtype']) && $row['subtype'] !='time')?$row['subtype']:'text')?>" class="form-control <?=($row['type'] == 'date')?'datetimepicker3':''?> <?=(!empty($row['subtype']) && $row['subtype'] == 'time')?'addtime':''?>" <?=$row['is_required'] == '1' ? 'required=true':''?> name="<?=!empty($row['name'])?$row['name'].'_'.$row['id']:''?>" id="<?=!empty($row['name'])?$row['name']:''?>" <?=!empty($row['maxlength'])?'maxlength="'.$row['maxlength'].'"':''?> <?=!empty($row['min'])?'min="'.$row['min'].'"':''?> <?=!empty($row['max'])?'max="'.$row['max'].'"':''?> placeholder="<?=!empty($meta['placeholder'])?$meta['placeholder']:''?>" data-parsley-errors-container="#errors-container<?=$row['name']?>" value="" />
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
                                            <p class="fw-bold"><?=!empty($row['label'])?$row['label']:''?></p>
                                    </div>
                                <?php } else if($row['type'] == 'paragraph'){ ?>
                                    <div class="col-md-12 mb-4">
                                            <p class="fw-bold"><?=!empty($row['label'])?$row['label']:''?></p>
                                    </div>
                                <?php } ?>
                                <?php } ?>
                                <?php }else{ ?>
                                    <div class="activity-list-item shadow-sm">
                                        <p class="font-weight-bold mb-1 text-center">No record found.</p>
                                    </div>
                            <?php }?>
                            <?php $template_name = preg_replace('/\s+/', '', $template->template_name); ?>

                            <div class="button temp">
                                    <input type="hidden" id="previous_data_{{$template_name}}" name="previous_data" value="">  
                                    <!-- <a href="{{ route('contract.type', $contractDetail->sub_category_id) }}" class="btn prev-btn">Back</a>      -->
                                    <button type="button" data-tempName="{{$template_name}}" class="back-and-edit btn prev-btn">Back</button>
                                    <button type="button" data-tempName="{{$template_name}}" class="btn save-and-continue">Save and Continue</button>
                                    @if($eventType == "add")
                                        <button type="button" data-tempName="{{$template_name}}" id="preview" class="btn preview">Preview</button>
                                    @endif
                                <!-- <button type="button" class="btn">Save and Continue</button> -->
                            </div>
                            <a href="javascript:void(0)" data-tempName="{{$template_name}}" class="skip-content skip-and-next">Skip this step for now</a>
                            