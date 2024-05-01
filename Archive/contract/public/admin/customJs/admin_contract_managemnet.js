        $('#add_contract').validate({
                ignore: [],
                rules: {
                    title: "required",
                    contractFile: {
                        required: true,
                        extension: "docx",
                    },
                },
                messages: {
                    title: {
                     required: "Please enter title",
                    },
                    contractFile: {
                     required: "Input type is required",
                     extension: "File must be docx.",
                    },
                         
                 },
            });

        $('#edit_contract').validate({
                ignore: [],
                rules: {
                    title: "required",
                    contractFile: {
                        extension: "docx"
                    },
                },
                messages: {
                    title: {
                     required: "Please enter title",
                    },
                    contractFile: {
                     extension: "File must be docx.",
                    },
                 },
                
            }); 

            $(document).ready(function() {
                CKEDITOR.editorConfig = function(config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;
        
                };
                CKEDITOR.replace('detail');
                CKEDITOR.replace('contract_faq');
        
            });


            function deleteContract(id){
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
                        var Url = baseurl+'/admin/delete_contract/'+id;	
                        window.location.href = Url;
                      } else {
            
                      }
                    });
            }
            
            $('body').on('change', '.categories_id', function () {
               //window.getSubcategorie = "{{route('contract_management')}}";
                window.getSubcategorie = backendUrl+"/admin/getSubCategoryFromParent";
				
                var categories = $('.categories_id').val();
				
				$.ajax({
					type: "GET",
					url: getSubcategorie,
					data: {
						'categoriesId': categories,
					},
					success: function (response) {
						var response = JSON.parse(response);
						var html = "";						
						$('#sub_categories_id').html("");
						if (response.result == 'success') {
							var dataLength = response.data.length;
							html += "<option value=''>Select sub categories</option>";
							for(let i = 0;i < dataLength; i++){
							   html += '<option value="'+response.data[i].id+'">'+response.data[i].sub_categories_name+'</option>';
							}
							$('#sub_categories_id').html(html);
						} else {
							$('#sub_categories_id').html("<option value=''>Select sub categories</option>");
						}
					},
					fail: function () {

					}
				});               
            });


   