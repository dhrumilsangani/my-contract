$('#add_content').validate({
    ignore: [],
    rules: {
        title: "required",
    },
    messages: {
        title: {
            required: "Please enter title",
        },        
    },
});

$('#edit_content').validate({
    ignore: [],
    rules: {
        title: "required",
    },
    messages: {
        title: {
            required: "Please enter title",
        },      
    },
    
}); 

$(document).ready(function() {

    // $("#title").change(function() {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $("input[name=_token]").val()
    //         }
    //     });
    //     jQuery.ajax({
    //         url: backendUrl + "/admin/cms_content_check_slug",
    //         method: 'post',
    //         data: {
    //             content_title: $(this).val(),
    //         },
    //         success: function(data) {
    //             data = jQuery.parseJSON(JSON.stringify(data));
    //             //$('#ajaxLoader').removeClass('d-block');
    //             $('#content_slug').val(data.slug);
    //         }
    //     });
    // })

    CKEDITOR.editorConfig = function(config) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.height = 300;
        config.toolbarCanCollapse = true;

    };
    CKEDITOR.replace('content');

});
