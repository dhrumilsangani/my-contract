$(document).ready(function(){
$('#add_price').validate({
    ignore: [],
    rules: {
        title: "required",
        type: "required",
        price: "required",
        price_code: "required",
    },
    messages: {
        title: {
            required: "Please enter title",
        }, 
        type: {
            required: "Please enter price type",
        }, 
        price: {
            required: "Please enter price",
        }, 
        price_code: {
            required: "Please enter price code",
        },        
    },
});

$('#edit_price').validate({
    ignore: [],
    rules: {
        title: "required",
        type: "required",
        price: "required",
        price_code: "required",
        
    },
    messages: {
        title: {
            required: "Please enter title",
        }, 
        type: {
            required: "Please enter price type",
        }, 
        price: {
            required: "Please enter price",
        }, 
        price_code: {
            required: "Please enter price code",
        },     
    },
    
}); 


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

CKEDITOR.editorConfig = function(config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.allowedContent = 'u em strong ul li';
    config.removeFormatTags = 'b,big,code,del,dfn,em,font,i,ins,kbd';
    config.toolbarCanCollapse = true;
    

};
CKEDITOR.replace('price_features');
}); 