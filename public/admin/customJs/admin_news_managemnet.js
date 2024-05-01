$('#add_news').validate({
    ignore: [],
    rules: {
        title: "required",
        description: "required",
        image: {
            required: true,
            extension: "jpeg|jpg|png|gif",
        },
    },
    messages: {
        title: {
            required: "Please enter title",
        },
        description: {
            required: "Please enter description",
        }, 
        image: {
            required: "Input type is required",
            extension: "File must be png,jpeg and gif.",
        },           
    },
});

$('#edit_news').validate({
    ignore: [],
    rules: {
        title: "required",
        description: "required",
    },
    messages: {
        title: {
            required: "Please enter title",
        },
        description: {
            required: "Please enter description",
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
	CKEDITOR.replace('description');

});
