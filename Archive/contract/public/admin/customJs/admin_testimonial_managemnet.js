$('#add_testimonial').validate({
    ignore: [],
    rules: {
        name: "required",
        title: "required",
    },
    messages: {
        name: {
         required: "Please enter name",
        },
        title: {
            required: "Please enter Comment",
        },        
    },
});

$('#edit_testimonial').validate({
    ignore: [],
    rules: {
        name: "required",
        title: "required",
    },
    messages: {
        name: {
         required: "Please enter name",
        },
        title: {
            required: "Please enter Comment",
        },      
    },
    
}); 

$(document).ready(function() {
    CKEDITOR.editorConfig = function(config) {
        config.language = 'es';
        config.uiColor = '#F7B42C';
        config.height = 300;
        config.toolbarCanCollapse = true;

    };
    CKEDITOR.replace('titledata');

});

function deleteTestimonial(id){
    swal({
        title: "Are you sure you want to delete ?",
        text: "",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#07689f",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            var Url = baseurl+'/admin/delete_testimonial/'+id;
            window.location.href = Url;
          } else {

          }
        });
}