$(document).ready(function(){
    $.validator.addMethod("customemail", 
      function(value, element) {
          //return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
          return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
      }, 
    "Sorry, I've enabled very strict email validation"
    );

$('#edit_profile').validate({
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
        company_name: {
         required: "Please enter company name",
        },
        name: {
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
        password: "required",
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
});