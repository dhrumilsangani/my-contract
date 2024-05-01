/* const { extendWith } = require("lodash"); */

/** Form validation code start here **/
$( "#formbuild_data" ).submit(function( event ) {
    var	isValid = 1;
    var contract_name = $("#contract_name").val();
	var category_id = $("#category_id").val();
	var sub_category_id = $("#sub_category_id").val();
	var template_name = $("#template_name").val();
	var position_no = $("#position_no").val();

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
        $("#error-template-name").html('Please enter template name.');
        isValid = 0;
    }

    if (position_no == null) {
        $("#error-position-no").html('Please enter position no.');
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
				html += "<option value=''>Select sub category</option>";
				for(let i = 0;i < dataLength; i++){
				   html += '<option value="'+response.data[i].id+'">'+response.data[i].sub_categories_name+'</option>';
				}
				$('#sub_category_id').html(html);
			} else {
				$('#sub_category_id').html("<option value=''>Select sub category</option>");
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