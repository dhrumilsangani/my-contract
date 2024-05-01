/* const { extendWith } = require("lodash"); */

$(document).ready(function() {
	CKEDITOR.editorConfig = function(config) {
		config.language = 'es';
		config.uiColor = '#F7B42C';
		config.height = 300;
		config.toolbarCanCollapse = true;

	};
	CKEDITOR.replace('description');

});
/** Form validation code start here **/

$( "#questions_data" ).submit(function( event ) {
    var	isValid = 1;
    var contract_name = $("#contract_name").val();
	var category_id = $("#category_id").val();
	var sub_category_id = $("#sub_category_id").val();
	var template_name = $("#template_id").val();
	var questions = $("#questions").val();
	var description = $("#description").val();

	if (contract_name == null) {
        $("#error-contract").html('Please select contract.');
        isValid = 0;
    }

	if (category_id == null) {
        $("#error-category").html('Please select category.');
        isValid = 0;
    }
	if (sub_category_id == null) {
        $("#error-sub-category").html('Please select sub category.');
        isValid = 0;
    }
	if (template_name == null) {
        $("#error-template-name").html('Please select template name.');
        isValid = 0;
    }

	if (questions == null) {
        $("#error-questions").html('Please enter question.');
        isValid = 0;
    }

	if (description == null) {
        $("#error-description").html('Please enter description.');
        isValid = 0;
    }

    if(isValid == 1){
        return true;
    }
    else
    {
        return false;
    }
    
});
/** Form validation code end here **/

$('body').on('change', '#category_id', function () {
	window.getSubcategorie = backendUrl+"/admin/template/getSubCategory";
	
	var categories = $('#category_id').val();
	
	$.ajax({
		type: "GET",
		url: getSubcategorie,
		data: {
			'category_id': categories,
		},
		success: function (response) {
			var response = JSON.parse(response);
			var html = "";						
			$('#sub_category_id').html("");
			if (response.result == 'success') {
				var dataLength = response.data.length;
				html += "<option value=''>Select sub categories</option>";
				for(let i = 0;i < dataLength; i++){
				   html += '<option value="'+response.data[i].id+'">'+response.data[i].sub_categories_name+'</option>';
				}
				$('#sub_category_id').html(html);
			} else {
				$('#sub_category_id').html("<option value=''>Select sub categories</option>");
			}
		},
		fail: function () {

		}
	});
});

$('body').on('change', '#sub_category_id', function () {
	window.getContract = backendUrl+"/admin/template/getContract";
	
	var category_id = $('#category_id').val();
	var sub_category_id = $('#sub_category_id').val();
	
	$.ajax({
		type: "GET",
		url: getContract,
		data: {
			'category_id': category_id,
			'sub_category_id': sub_category_id,
		},
		success: function (response) {
			var response = JSON.parse(response);
			var html = "";						
			$('#contract_name').html("");
			if (response.result == 'success') {
				var dataLength = response.data.length;
				html += "<option value=''>Select Contract</option>";
				for(let i = 0;i < dataLength; i++){
				   html += '<option value="'+response.data[i].id+'">'+response.data[i].title+'</option>';
				}
				$('#contract_name').html(html);
			} else {
				$('#contract_name').html("<option value=''>Select Contract</option>");
			}
		},
		fail: function () {

		}
	});
});


$('body').on('change', '#contract_name', function () {
	window.getTemplate = backendUrl+"/admin/get_template_list";
	
	var contract_id = $('#contract_name').val();
	$.ajax({
		type: "GET",
		url: getTemplate,
		data: {
			'contract_id': contract_id,
		},
		success: function (response) {
			var response = JSON.parse(response);
			var html = "";						
			$('#template_id').html("");
			if (response.result == 'success') {
				var dataLength = response.data.length;
				html += "<option value=''>Select Template</option>";
				for(let i = 0;i < dataLength; i++){
				   html += '<option value="'+response.data[i].id+'">'+response.data[i].template_name+'</option>';
				}
				$('#template_id').html(html);
			} else {
				$('#template_id').html("<option value=''>Select Template</option>");
			}
		},
		fail: function () {

		}
	});
});



function deleteQuestions(id){
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
            var Url = baseurl+'/admin/delete_questions/'+id;	
            window.location.href = Url;
          } else {

          }
        });
}