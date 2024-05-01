$(document).ready(function(){
    
    $.validator.addMethod("customemail", 
      function(value, element) {
          //return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
          return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
      }, 
    "Sorry, I've enabled very strict email validation"
    );

    $("#send_contract_frm").validate({
    ignore: [],
      rules: {
        contrct_url: "required",
        email: {
          required: true,
          email: true,
          customemail: true
        },      
    },
      messages: {
        contrct_url: {
        required: "Please enter contrct url",
       },      
       email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
       },
      },
    
    });
  });