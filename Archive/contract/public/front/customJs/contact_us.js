$(document).ready(function(){

    // function validateEmail($email) {
    //   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    //   return emailReg.test( $email );
    // }
    // $('#errors-email').hide();
    // $('form input[name="email"]').blur(function () {
    //   var email = $(this).val();
    //     var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/igm;
    //     if (re.test(email)) {
    //     console.log('If');
    //         $('#errors-email').hide();
    //     } else {
    //         $('#errors-email').show();
    //     }
    //   });
    $.validator.addMethod("customemail", 
      function(value, element) {
          return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
      }, 
    "Sorry, I've enabled very strict email validation"
    );

    $("#contact_frm").validate({
    ignore: [],
      rules: {
        name: "required",
        subject: "required",
        email: {
          required: true,
          email: true,
          customemail: true
        },
    },
      messages: {
        name: {
        required: "Please enter name",
       },      
       subject: {
        required: "Please enter subject",
       },     
       email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
       },
      },
    
    });
  });