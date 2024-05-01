function ajaxcall(url, data, callback) {
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(result) {
            callback(result);
        }
    });
}
function submitcall(url, data, callback) {
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function(result) {
            callback(result);
        }
    });
}



function handleAjaxResponse(output) {
    //output = JSON.parse(output);
    if (output.message != "") {
        toastr.success(output.status, output.message, "");
        $(".btn-sub").prop("disabled", true);
    }
    if (typeof output.redirect !== "undefined" && output.redirect != "") {
        setTimeout(function() {
            window.location.href = output.redirect;
        }, 500);
    }
    if (typeof output.jscode !== "undefined" && output.jscode != "") {
        eval(output.jscode);
    }

    if (typeof output.reload !== "undefined" && output.reload != "") {
        setTimeout(function() {
            window.location = window.location.href;
        }, 500);
    }
}

function handleFormValidate(form, rules, messages, submitCallback, ckeditor) {
    var error = $(".alert-danger", form);
    var success = $(".alert-success", form);
    if (ckeditor) {
        var ignor = [];
    } else {
        var ignor = ":hidden";
    }
    if ($().validate) {
        form.validate({
            errorElement: "div", //default input error message container
            errorClass: "help-block", // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: ignor,
            rules: rules,
            messages: messages,
            invalidHandler: function(event, validator) {
                //display error alert on form submit
                success.hide();
                error.show();
            },
            showErrors: function(errorMap, errorList) {
                if (typeof errorList[0] != "undefined") {
                    var position = $(errorList[0].element).offset().top - 70;
                    $("html, body").animate(
                        {
                            scrollTop: position
                        },
                        300
                    );
                }
                this.defaultShowErrors(); // keep error messages next to each input element
            },

            highlight: function(element) {
                // hightlight error inputs
                $(element)
                    .closest(".form-group")
                    .addClass("has-error"); // set error class to the control group
            },
            unhighlight: function(element) {
                // revert the change done by hightlight
                $(element)
                    .closest(".form-group")
                    .removeClass("has-error"); // set error class to the control group
            },

            errorPlacement: function(error, element) {
                if (
                    element.is("input[type=checkbox]") ||
                    element.is("input[type=radio]")
                ) {
                    var controls = element.closest('div[class*="col-"]');
                    if (controls.find(":checkbox,:radio").length > 1)
                        controls.append(error);
                    else error.insertAfter(element.nextAll(".lbl:eq(0)").eq(0));
                } else if (element.is(".select2")) {
                    error.insertAfter(
                        element.siblings('[class*="select2-container"]:eq(0)')
                    );
                } else if (element.is(".chosen-select")) {
                    error.insertAfter(
                        element.siblings('[class*="chosen-container"]:eq(0)')
                    );
                } else error.insertAfter(element.parent());
            },
            success: function(label) {
                label.closest(".form-group").removeClass("has-error"); // set success class to the control group
            },
            submitHandler: function(form) {
                if (
                    typeof submitCallback !== "undefined" &&
                    typeof submitCallback == "function"
                ) {
                    submitCallback(form);
                } else {
                    CKupdate();
                    handleAjaxFormSubmit(form, true);
                }
                return false;
            }
        });
    }
}

/**** Disable HTML tag for field code start ****/
//$("input,textarea,select").keyup(function(e){
$('body').on('keyup', 'input,textarea,select', function (e) {
	var reg =/<(.|\n)*?>/g; 
	if (reg.test($(this).val()) == true) {
		callToaster('error','HTML/Java Script tags are not allowed.');
		$(this).val("");
		return false;
	}
	e.preventDefault();
});

/**** Disable links for text field and text area start ****/
//$('input,textarea,select').keyup(function(e){
$('body').on('keyup', '.nolink', function (e) {
	var message = $('.input,textarea').val();
	if(/(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test($(this).val())){
		callToaster('error','Links are not allowed.');
		$(this).val("");
		e.preventDefault();
	}
	else if (/^[a-zA-Z0-9\-\.]+\.(com|org|net|mil|edu|COM|ORG|NET|MIL|EDU)$/i.test($(this).val())) {
		callToaster('error','Links are not allowed.');
		$(this).val("");
		e.preventDefault();
	}
});

//$('.alpha').keydown(function (e) {
$('body').on('keydown', '.alpha', function () {
	if (e.shiftKey || e.ctrlKey || e.altKey) {
	  e.preventDefault();
	}
	else
	{
		var key = e.keyCode;
		if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
			e.preventDefault();
		}
	}
});

//$('.alphanum').keyup(function (e) {
$('body').on('keyup', '.alphanum', function () {
	if (this.value.match(/[^a-zA-Z0-9 ]/g)) {
		this.value = this.value.replace(/[^a-zA-Z0-9 ]/g, '');
	}
});

//$('.onlynum').keyup(function(e){
$('body').on('keyup', '.onlynum', function () {
	if (/\D/g.test(this.value)){
		this.value = this.value.replace(/\D/g, '');
	}
});

$.validator.addMethod("subscribermail", 
function(value, element) {
    //return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
    return /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)
        && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value);
}, 
"Sorry, I've enabled very strict email validation"
);

$("#add_front_subs").validate({
    ignore: [],
    rules: {
    email: {
        required: true,
        email: true,
        subscribermail: true
    },
    },
    messages: {
    email: {
        required: "Please enter email address",
        email: "Please enter a valid email address.",
        },
    },

});


/**** Disable links for text field and text area end ****/


function validateEmail(email) {
	const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}
	
function callToaster(toastrMsgType, toastrMsg){
	toastr.options.timeOut = 5000; // 3 second
	if(toastrMsgType != "" && toastrMsg!=""){
		if(toastrMsgType == "info"){toastr.info(toastrMsg);}
		if(toastrMsgType == "success"){toastr.success(toastrMsg);}
		if(toastrMsgType == "error"){toastr.error(toastrMsg);}
		if(toastrMsgType == "warning"){toastr.warning(toastrMsg);}
	}
}