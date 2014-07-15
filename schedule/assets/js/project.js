var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

	$("#create-project").click(function() {
	   	loadNewProjectForm();
	});

	function loadNewProjectForm(){
		$(".right-container").load(base_url + 'project/newProject');
	}


	$("#new-project-form").submit(function(event){
		$("#new-project-error").empty();
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'project/createProject',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-project-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$(".right-container").load(base_url + 'project/info');        
	            }
	        }
		});
	});


	$("#show-all-project").click(function() {
	   	showAllProjects();
	});

	function showAllProjects(){
		$(".right-container").load(base_url + 'project/showAll');
	}



});