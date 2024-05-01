$(document).ready(function() {
        $("#page_title").change(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                }
            });
            jQuery.ajax({
                url: backendUrl + "/admin/cms_page_check_slug",
                method: 'post',
                data: {
                    page_title: $(this).val(),
                },
                success: function(data) {
                    data = jQuery.parseJSON(JSON.stringify(data));
                    //$('#ajaxLoader').removeClass('d-block');
                    $('#page_slug').val(data.slug);
                }
            });
        })
        CKEDITOR.editorConfig = function(config) {
            config.language = 'es';
            config.uiColor = '#F7B42C';
            config.height = 300;
            config.toolbarCanCollapse = true;

        };
        CKEDITOR.replace('page_content');

    });


$('#add_cms_page').validate({
    ignore: [],
    rules: {
        page_title: "required",
    },
    messages: {
      page_title: {
       required: "Please enter page title",
      },
   },

});


$('#edit_cms_page').validate({
  ignore: [],
  rules: {
      page_title: "required",
  },
  messages: {
    page_title: {
     required: "Please enter page title",
    },
 },

});

// $(".collapse.show").each(function() {
//     $(this).prev(".card-header").find(".fa").addClass("fa-angle-down").removeClass("fa-angle-right");
// });
// $(".collapse").on('show.bs.collapse', function() {
//     $(this).prev(".card-header").find(".fa").removeClass("fa-angle-right").addClass("fa-angle-down");
// }).on('hide.bs.collapse', function() {
//     $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-right");
// });

      

      // (function()
      // {
      //   'use strict';
      //   window.addEventListener('load', function()
      //   {
      //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
      //     var forms = document.getElementsByClassName('needs-validation');
      //     // Loop over them and prevent submission
      //     var validation = Array.prototype.filter.call(forms, function(form)
      //     {
      //       form.addEventListener('submit', function(event)
      //       {
      //         if (form.checkValidity() === false)
      //         {
      //           event.preventDefault();
      //           event.stopPropagation();
      //         }
      //         form.classList.add('was-validated');
      //       }, false);
      //     });
      //   }, false);
      // })();


      function deleteCms(id){
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
                var Url = baseurl+'/admin/delete_cms_page/'+id;	
                window.location.href = Url;
              } else {
    
              }
            });
    }