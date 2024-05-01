$(document).ready(function(){
    $.validator.addMethod("customemail", 
      function(value, element) {
        if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value)){
            $('button[type="submit"]').attr('disabled',false);           
        }else{
            $('button[type="submit"]').attr('disabled',true);
        }
        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);          
      }, 
    "Please enter a valid email address."
    );

        $('#add_client_page').validate({
                ignore: [],
                rules: {
                    name: "required",
                    company_name: "required",
                    email: {
                        required: true,
                        email: true,
                        customemail: true
                    },
                    password: "required",
                    confirm_password: "required",
                    confirm_password: {
                        required: true,
                        equalTo: "#password"
                    },
                    phone: {
                        phoneUS: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                    },
                   company_name: {
                    required: "Please enter company name",
                   },
                   email: {
                    required: "Please enter email address",
                    email: "Please enter a valid email address.",
                   },
                   password: {
                    required: "Please enter password",
                   },      
                   confirm_password: {
                        required: "Please enter confirm password",
                        equalTo : "The password confirmation and password must match.",
                   },
                   phone: {
                    phone: "Please enter a valid phone number.",
                   },       
                },
                
            });
        $('#edit_form').validate({
                ignore: [],
                rules: {
                    name: "required",
                    company_name: "required",
                    email: {
                        required: true,
                        email: true,
                        customemail: true
                    },
                    phone: {
                        phoneUS: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                       },
                    company_name: {
                     required: "Please enter company name",
                    },
                    email: {
                     required: "Please enter email address",
                     email: "Please enter a valid email address.",
                    },
                    phone: {
                        phone: "Please enter a valid phone number.",
                       }, 
                },
                
            }); 

            $('#add_subs').validate({
                ignore: [],
                rules: {
                    email: {
                        required: true,
                        email: true,
                        customemail: true
                    },
                },
                messages: {
                    email: {
                     required: "Please enter email address",
                     email: "Please enter a valid email address.",
                    },
                },
                
            }); 

            $('#admin_edit_form').validate({
                ignore: [],
                rules: {
                    name: "required",
                    company_name: "required",
                    email: {
                        required: true,
                        email: true,
                        customemail: true
                    },
                    phone: {
                        phoneUS: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name",
                       },
                    company_name: {
                     required: "Please enter company name",
                    },
                    email: {
                     required: "Please enter email address",
                     email: "Please enter a valid email address.",
                    },
                    phone: {
                        phone: "Please enter a valid phone number.",
                       }, 
                },
                
            }); 


            $('#change_password').validate({
                ignore: [],
                rules: {
                    old_password: "required",
                    new_password: "required",
                    new_password_confirmation: {
                        required: true,
                        equalTo: "#newPasswordInput"
                    }
                },
                messages: {
                    old_password: {
                        required: "Please enter old password",
                       },
                       new_password: {
                        required: "Please enter new password",
                       },      
                       new_password_confirmation: {
                            required: "Please enter confirm password",
                            equalTo : "The password confirmation and password must match.",
                       },
                },
                
            }); 



    //     (function()
    //   {
    //     'use strict';
    //     window.addEventListener('load', function()
    //     {
    //       // Fetch all the forms we want to apply custom Bootstrap validation styles to
    //       var forms = document.getElementsByClassName('needs-validation');
    //       // Loop over them and prevent submission
    //       var validation = Array.prototype.filter.call(forms, function(form)
    //       {
    //         form.addEventListener('submit', function(event)
    //         {
    //           if (form.checkValidity() === false)
    //           {
    //             event.preventDefault();
    //             event.stopPropagation();
    //           }
    //           form.classList.add('was-validated');
    //         }, false);
    //       });
    //     }, false);
    //   })();


    

});

function deleteClient(id){
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
            var Url = baseurl+'/admin/delete_client/'+id;	
            window.location.href = Url;
          } else {

          }
        });
}