$('#add_sub_categories').validate({
    ignore: [],
    rules: {
        categories_id: "required",
        sub_categories_name: "required",
    },
    messages: {
        categories_id: {
            required: "Please select categories name",
        },
        sub_categories_name: {
            required: "Please enter sub categories name",
        },
           
    },
});

$('#edit_sub_categories').validate({
    ignore: [],
    rules: {
        categories_id: "required",
        sub_categories_name: "required",
    },
    messages: {
        categories_id: {
            required: "Please select categories name",
        },
        sub_categories_name: {
            required: "Please enter sub categories name",
        },
    },
    
}); 


function deleteTeam(id){
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
            var Url = baseurl+'/admin/delete_sub_categories/'+id;	
            window.location.href = Url;
          } else {

          }
        });
}