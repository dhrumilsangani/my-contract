$('#add_team').validate({
    ignore: [],
    rules: {
        name: "required",
        positions: "required",
        image: {
            required: true,
            extension: "jpeg|jpg|png|gif",
        },
    },
    messages: {
        name: {
         required: "Please enter name",
        },
        positions: {
         required: "Please enter positions",
        }, 
        image: {
            required: "Input type is required",
            extension: "File must be png,jpeg and gif.",
           },     
    },
});

$('#edit_team').validate({
    ignore: [],
    rules: {
        name: "required",
        positions: "required",
    },
    messages: {
        name: {
         required: "Please enter name",
        },
        positions: {
         required: "Please enter positions",
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
            var Url = baseurl+'/admin/delete_team/'+id;	
            window.location.href = Url;
          } else {

          }
        });
}