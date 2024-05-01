$(document).ready(function(){

  $.validator.addMethod("customemail", 
      function(value, element) {
          //return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
          return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
      }, 
    "Sorry, I've enabled very strict email validation"
    );

    $("#sign_up_frm").validate({
    ignore: [],
      rules: {
        email: {
          required: true,
          email: true,
          customemail: true
        },
        password: {
					required: true,
					minlength : 8,
				},
				confirm_password: {
					required: true,
					minlength : 8,
					equalTo : '#password'
				}      
    },
      messages: {
       password: {
        required:	"Please enter password.",
        minlength:	"password minimum legnth should be 8 character.",
      },
      confirm_password: {
        required:	"Please enter confirm password.",
        minlength:	"confirm password minimum legnth should be 8 character.",
        equalTo: "Your password and confirm password does not match."
      },

       email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
       },
      },
    
    });
  });