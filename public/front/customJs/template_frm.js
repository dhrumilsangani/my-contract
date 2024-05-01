//const { extendWith } = require("lodash");

//const { exists } = require("laravel-mix/src/File");

$(document).ready(function () {
    var valueData = $(".answer7").attr("data-val");
    if(valueData == "Yes"){
        $('.amount').show();
        $('.frequency').show();
        $('.insert_milestone_one_details').hide();
        $('.insert_milestone_two_details').hide();
    }

    var value = $(".amend_agreement").attr("data-val");
    if(value == "yes"){
        $('.insert_other_clause').show();
        $('.amend_header').show();

    }
    //DatePicker Example
    $('#datetimepicker').datetimepicker();
    
    //TimePicke Example
    $('#datetimepicker1').datetimepicker({
        datepicker:false,
        format:'H:i'
    });
    
    //Inline DateTimePicker Example
    $('#datetimepicker2').datetimepicker({
        format:'Y-m-d H:i',
        inline:true
    });
    $('.datetimepicker3').datetimepicker({
        format:'d F Y',
        autoclose: true,
        timepicker:false,
    });

   // minDate and maxDate Example
    // $('.datetimepicker3').datetimepicker({
    //      format:'Y-m-d',
    //      autoclose: true,
    //      timepicker:false,
    //     //   minDate:'-1970/01/02', //yesterday is minimum date
    //     //   maxDate:'+1970/01/02' //tomorrow is maximum date
    // });

    // $('.datetimepicker3').datetimepicker({
    //     format:'Y-m-d',
    //     useCurrent: false,
    //     showTodayButton: true,
    //     showClear: true,
    //     toolbarPlacement: 'bottom',
    //     sideBySide: true,
    //     icons: {
    //         date: "fa fa-calendar",
    //         up: "fa fa-arrow-up",
    //         down: "fa fa-arrow-down",
    //         previous: "fa fa-chevron-left",
    //         next: "fa fa-chevron-right",
    //         today: "fa fa-clock-o",
    //         clear: "fa fa-trash-o"
    //     }
    // });
    
    //allowTimes options TimePicker Example
    $('#datetimepicker4').datetimepicker({
        datepicker:false,
        allowTimes:[
          '11:00', '13:00', '15:00', 
          '16:00', '18:00', '19:00', '20:00'
        ]
    });
    
});



$('body').on('click', '.answer7', function () {
    var value = $(this).attr("data-val");
    if(value == "Yes"){
        $('.amount').show();
        $('.frequency').show();
        $('.insert_milestone_one_details').hide();
        $('.insert_milestone_two_details').hide();
    }

    if(value == "No"){
        $('.amount').hide();
        $('.frequency').hide();
        $('.insert_milestone_one_details').show();
        $('.insert_milestone_two_details').show();
    }
    
});


$('body').on('click', '.amend_agreement', function () {
    var value = $(this).attr("data-val");
    if(value == "yes"){
        $('.insert_other_clause').show();
        $('.amend_header').show();
        
        $('.insert_other_val').attr( 'required',true);
        $('.amend_header_val').attr( 'required',true);
    }

    if(value == "no"){
        $('.insert_other_clause').hide();
        $('.amend_header').hide();

        $('.insert_other_val').attr('required',false);
        $('.amend_header_val').attr('required',false);
    }
    
});


//Review contract data
$('body').on('click', '#reviewContract', function () {
    $('#template_frm').parsley().validate();
    if ($('#template_frm').parsley().isValid()) {
    var contract_id = $('#contract_id').val();
    var reviewContractUrl = baseurl+'/front/review/contract';	
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    var formData = $('#template_frm').serialize()+ '&typesubmit=view';;
        $.ajax({
            type: "POST",
            url: reviewContractUrl,
            data: formData,
            success: function (response) {
                //console.log(response);
                if (response.status == 'success') {
                    var reViewUrl = baseurl+'/front/viewContract/'+contract_id;	
                    window.open(reViewUrl, '_blank');

                } else {
                    $('.save-and-clone').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-clone').removeAttr('disabled');
            }
        });
    }
});

//$('body').on('submit', '#downloadContract', function () {
//     $('body').on('click','#downloadContract',function(event){
//     alert('test2');
//     var downloadContractUrl = baseurl+'/front/front/dashboard';	
//     setTimeout(function() {
//         $('#template_frm').submit();
//         window.location=downloadContractUrl
//         return false;
//     }, 500);

//     return false;
// 	event.preventDefault();
// });


$('body').on('click', '#downloadContract', function () {
    $('#template_frm').parsley().validate();
    if ($('#template_frm').parsley().isValid()) {
    var downloadContractUrl = baseurl+'/front/store/template';	
    var formData = $('#template_frm').serialize()+ '&typesubmit=download';;
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: "POST",
            url: downloadContractUrl,
            data: formData,
            success: function (response) {
                if (response.status == 'success') {
                    
                    window.open(response.docFile, '_blank');
                    var reViewUrl = baseurl+'/front/user_contract_list';	
                    window.location.href = reViewUrl;

                } else {
                    $('.save-and-clone').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-clone').removeAttr('disabled');
            }
        });
    }
});



//Review contract data
$('body').on('click', '#editReviewContract', function () {
    $('#edit_template_frm').parsley().validate();
    if ($('#edit_template_frm').parsley().isValid()) {
    var reviewContractUrl = baseurl+'/front/edit/contract/review';
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    var formData = $('#edit_template_frm').serialize()+ '&typesubmit=view';;
        $.ajax({
            type: "POST",
            url: reviewContractUrl,
            data: formData,
            success: function (response) {
                //console.log(response);
                if (response.status == 'success') {
                    var reViewUrl = baseurl+'/front/viewContract';	
                    window.open(reViewUrl, '_blank');

                } else {
                    $('.save-and-clone').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-clone').removeAttr('disabled');
            }
        });
    }
});

$('body').on('click', '#editDownloadContract', function () {
    $('#edit_template_frm').parsley().validate();
    if ($('#edit_template_frm').parsley().isValid()) {
    var downloadContractUrl = baseurl+'/front/update/template';	
    var formData = $('#edit_template_frm').serialize()+ '&typesubmit=download';
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: "POST",
            url: downloadContractUrl,
            data: formData,
            success: function (response) {
                if (response.status == 'success') {
                    
                    window.open(response.docFile, '_blank');
                    var reViewUrl = baseurl+'/front/user_contract_list';	
                    window.location.href = reViewUrl;

                } else {
                    $('.save-and-clone').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-clone').removeAttr('disabled');
            }
        });
    }
});


//store scorecard data
$('body').on('click', '.save-and-continue', function () {
    var frmName = $(this).attr("data-tempName");
    $('#template_'+frmName).parsley().validate();
    if ($('#template_'+frmName).parsley().isValid()) {
        $('.save-and-continue').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: saveTemplate,
            data: $('#template_'+frmName).serialize(),
            success: function (response) {
                //console.log(response);
                if (response.status == 'success') {
                    if(response.next_template == null){
                        $('.save-and-continue').removeAttr('disabled');
                        $(".print_download").html();
                        $(".print_download").html(response.sectionsHtml);
                       var iframe = $(".need_to_get_iFrameUrl").val();

                       $(".iframeData").html();
                       $(".iframeData").html("<iframe attributes='rana' src='"+iframe+"?version="+ new Date()+"' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>");
                        
                        $("#pills-print-tab").click();
                        document.getElementById("progressbar").style.width = "100%";
                    }else{
                        var progval = $('#progress_val_'+response.template_name).val();
                        $('.save-and-continue').removeAttr('disabled');
                        $("."+response.template_name).html();
                        $("."+response.template_name).html(response.sectionsHtml);
                        $("#pills-property-tab-"+response.template_name).click();
                        document.getElementById("progressbar").style.width = progval+"%";
                    }
                    $('.datetimepicker3').datetimepicker({
                        format:'d F Y',
                        autoclose: true,
                        timepicker:false,
                    });
                } else {
                    $('.save-and-continue').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-continue').removeAttr('disabled');
            }
        });
    }else{
        $('.save-and-continue').removeAttr('disabled');
    }
});


$('body').on('click', '.edit-and-continue', function () {
    var frmName = $(this).attr("data-tempName");
    $('#template_'+frmName).parsley().validate();
    if ($('#template_'+frmName).parsley().isValid()) {
        $('.save-and-continue').attr('disabled', true);
        $.ajax({
            type: "POST",
            url: editTemplate,
            data: $('#template_'+frmName).serialize(),
            success: function (response) {
                //console.log(response);
                if (response.status == 'success') {
                    if(response.next_template == null){
                        $('.save-and-continue').removeAttr('disabled');
                        $(".print_download").html();
                        $(".print_download").html(response.sectionsHtml);

                        var iframe = $(".need_to_get_iFrameUrl").val();

                        $(".iframeData").html();
                        $(".iframeData").html("<iframe attributes='rana' src='"+iframe+"?version="+ new Date()+"' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>");
                        $("#pills-print-tab").click();
                        document.getElementById("progressbar").style.width = "100%";
                    }else{
                        $('.save-and-continue').removeAttr('disabled');
                        $("."+response.template_name).html();
                        $("."+response.template_name).html(response.sectionsHtml);
                        $("#pills-property-tab-"+response.template_name).click();
                        var progval = $('#progress_val_'+response.template_name).val();
                        document.getElementById("progressbar").style.width = progval+"%";
                    }
                    $('.datetimepicker3').datetimepicker({
                        format:'d F Y',
                        autoclose: true,
                        timepicker:false,
                    });
                } else {
                    $('.save-and-continue').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-continue').removeAttr('disabled');
            }
        });
    }else{
        $('.save-and-continue').removeAttr('disabled');
    }
});


//store scorecard data

$('body').on('click', '.back-and-edit', function () {
    var frmName = $(this).attr("data-tempName");
    swal({
        title: "Are you sure you want to Save this data ?",
        type: "warning",
        customClass: "save-data",
        showCancelButton: true,
        confirmButtonColor: "#07689f",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
      },
      function(isConfirm){
        if (isConfirm) {
            // submitting the form when user press yes
            $('#template_'+frmName).parsley().validate();
            if ($('#template_'+frmName).parsley().isValid()) {
                $('#previous_data_'+frmName).val("previous");
                $('.save-and-continue').attr('disabled', true);
                $.ajax({
                    type: "POST",
                    url: saveTemplate,
                    data: $('#template_'+frmName).serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response.status == 'success') {
                                $('.save-and-continue').removeAttr('disabled');
                                $("."+response.template_name).html();
                                $("."+response.template_name).html(response.sectionsHtml);
                                $("#pills-property-tab-"+response.template_name).click();
                                var progval = $('#progress_val_'+response.template_name).val();
                                document.getElementById("progressbar").style.width = progval+"%";
                                $('.datetimepicker3').datetimepicker({
                                    format:'d F Y',
                                    autoclose: true,
                                    timepicker:false,
                                });
                        } else {
                            $('.save-and-continue').removeAttr('disabled');
                        }
                    },
                    fail: function () {
                        $('.save-and-continue').removeAttr('disabled');
                    }
                });
            }else{
                $('.save-and-continue').removeAttr('disabled');
            }
        } else {
            $('#previous_data_'+frmName).val("previous");
                $('.save-and-continue').attr('disabled', true);
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: "POST",
                    url: backWithNotSaveTemplate,
                    data: $('#template_'+frmName).serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response.status == 'success') {
                                $('.save-and-continue').removeAttr('disabled');
                                $("."+response.template_name).html();
                                $("."+response.template_name).html(response.sectionsHtml);
                                $("#pills-property-tab-"+response.template_name).click();
                                var progval = $('#progress_val_'+response.template_name).val();
                                document.getElementById("progressbar").style.width = progval+"%";
                                $('.datetimepicker3').datetimepicker({
                                    format:'d F Y',
                                    autoclose: true,
                                    timepicker:false,
                                });
                        } else {
                            $('.save-and-continue').removeAttr('disabled');
                        }
                    },
                    fail: function () {
                        $('.save-and-continue').removeAttr('disabled');
                    }
                });
        }
      });
    
});

$('body').on('click', '.back-and-edit-print', function () {
        var frmName = $(this).attr("data-tempName");
            $('#previous_data_'+frmName).val("previous");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
                $.ajax({
                    type: "POST",
                    url: backWithNotSaveTemplate,
                    data: $('#template_'+frmName).serialize(),
                    success: function (response) {
                        console.log(response);
                        if (response.status == 'success') {
                                $('.save-and-continue').removeAttr('disabled');
                                $("."+response.template_name).html();
                                $("."+response.template_name).html(response.sectionsHtml);
                                $("#pills-property-tab-"+response.template_name).click();
                                var progval = $('#progress_val_'+response.template_name).val();
                                document.getElementById("progressbar").style.width = progval+"%";
                                $('.datetimepicker3').datetimepicker({
                                    format:'d F Y',
                                    autoclose: true,
                                    timepicker:false,
                                });
                        } else {
                            $('.save-and-continue').removeAttr('disabled');
                        }
                    },
                    fail: function () {
                        $('.save-and-continue').removeAttr('disabled');
                    }
                });
        
    
    
});


//store scorecard data
$('body').on('click', '.skip-and-next', function () {
        var frmName = $(this).attr("data-tempName");
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: "POST",
                url: backWithNotSaveTemplate,
                data: $('#template_'+frmName).serialize(),
                success: function (response) {
                 console.log(response);
                        if (response.status == 'success') {
                            if(response.next_template == null){
                                $('.save-and-continue').removeAttr('disabled');
                                $(".print_download").html();
                                $(".print_download").html(response.sectionsHtml);
                                
                                var iframe = $(".need_to_get_iFrameUrl").val();
                                $(".iframeData").html();
                                $(".iframeData").html("<iframe attributes='rana' src='"+iframe+"?version="+ new Date()+"' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>");

                                $("#pills-print-tab").click();
                                document.getElementById("progressbar").style.width = "100%";
                            }else{
                                $('.save-and-continue').removeAttr('disabled');
                                $("."+response.template_name).html();
                                $("."+response.template_name).html(response.sectionsHtml);
                                $("#pills-property-tab-"+response.template_name).click();
                                var progval = $('#progress_val_'+response.template_name).val();
                                document.getElementById("progressbar").style.width = progval+"%";
                            }
                                $('.datetimepicker3').datetimepicker({
                                    format:'d F Y',
                                    autoclose: true,
                                    timepicker:false,
                                });
                        } else {
                            $('.save-and-continue').removeAttr('disabled');
                        }
                    },
                    fail: function () {
                        $('.save-and-continue').removeAttr('disabled');
                    }
                });
    
});


//Review contract data
$('body').on('click', '#preview', function () {

    var frmName = $(this).attr("data-tempName");
    $('#template_'+frmName).parsley().validate();
    if ($('#template_'+frmName).parsley().isValid()) {
        //$('.save-and-continue').attr('disabled', true);
        var contract_id = $('#contract_id').val();
        var contract_data_id = $('#contract_data_id').val();
        
    var previewContractUrl = baseurl+'/front/preview';	
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
        $.ajax({
            type: "POST",
            url: previewContractUrl,
            data: $('#template_'+frmName).serialize(),
            success: function (response) {
                if (response.status == 'success') {
                    var reViewUrl = baseurl+'/front/previewContract/'+contract_id+'/'+contract_data_id;	
                    window.open(reViewUrl, '_blank');

                } else {
                    $('.save-and-clone').removeAttr('disabled');
                }
            },
            fail: function () {
                $('.save-and-clone').removeAttr('disabled');
            }
        });
    }
});

$(document).ready(function(){
    $(".questions").mouseover(function() {
        $tempName = $(this).attr("data-teml");
        $(".questions_"+$tempName).show();
    }).mouseout(function() {
        $temp = $(this).attr("data-teml");
        $(".questions_"+$temp).hide();
    });
});