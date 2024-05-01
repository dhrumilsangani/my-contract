$('#add_categories').validate({
    ignore: [],
    rules: {
        categories_name: "required",
    },
    messages: {
        categories_name: {
         required: "Please enter categories name",
        },
    },
});

$('#edit_categories').validate({
    ignore: [],
    rules: {
        categories_name: "required",
    },
    messages: {
        categories_name: {
         required: "Please enter categories name",
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
            var Url = baseurl+'/admin/delete_categories/'+id;	
            window.location.href = Url;
          } else {

          }
        });
}