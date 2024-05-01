$(document).ready(function(){
  $.validator.addMethod("customemail", 
      function(value, element) {
          return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
      }, 
    "Sorry, I've enabled very strict email validation"
    );

    $("#signin_frm").validate({
    ignore: [],
      rules: {
        email: {
          required: true,
          email: true,
          customemail: true
        },
        password: "required",
    },
      messages: {
        password: {
        required: "Please enter password",
       },      
       email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
       },
      },
    
    });
  });