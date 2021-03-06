var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/************** New Project ************************/

	$("#create-project").click(function(event) {
		event.preventDefault();
	   	loadNewProjectForm();
	});

	function loadNewProjectForm(){
		$(".left-container").load(base_url + 'project/newProject');
	}

	$("#new-project-form").submit(function(event){
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
	            	$(".left-container").load(base_url + 'phase/newPhase/'+data.project_id);      
	            }
	        }
		});
	});


/*************************************************/

/****************** New Project Form *************/

	var year = $("#project-year").val();
	var type = $("#project-type option:selected").attr("id");
	var seq_num = $("#sequence-number").val();
	var dept = $("#project-dept option:selected").attr("id");
	var descriptor = $("#project-descriptor").val();
	$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-" + descriptor);

	$("#project-descriptor").bind( "keyup keypress blur", function() {
		descriptor = $(this).val();
		$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-" + descriptor);
	});

	$("#project-type").bind( "change", function() {
		type = $("#project-type option:selected").attr("id");
		$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-"  + descriptor);
	});


	$("#project-year").bind( "keyup keypress blur", function() {
		year = $(this).val();
		year = year.slice(2);
		$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-"  + descriptor);
	});

	$("#project-dept").bind( "change", function() {
		dept = $("#project-dept option:selected").attr("id");
		$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-" + descriptor);
	});

	$("#sequence-number").bind( "keyup keypress blur", function() {
		seq_num = $(this).val();
		$("#project-code").val(year + "-" + type + "-" + seq_num + "-" + dept + "-"  + descriptor);
	});


/*************************************************/

/************** Show All Projects ************************/

	$("#show-all-project-table").click(function(event) {
		event.preventDefault();
	   	showAllProjects();
	});

	function showAllProjects(){
		$(".left-container").load(base_url + 'project/showAll');
	}

	$(".clickable").click(function() {
		selectProject($(this).attr("id"));
	});

	function selectProject(id)
	{
		$(".top-container").load(base_url + 'project/displayInfo/' + id);
	}

	/***********************************************************/

	/************** Add Project Type ************************/

	$("#add-project-type").click(function(event) {
	   	event.preventDefault();
	   	addProjectType();
	});

	function addProjectType(){
		$(".left-container").load(base_url + 'project/newProjectType');
	}

	$("#new-project-type-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'project/createProjectType',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-project-type-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-project-type-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/***********************************************************/

	/************** Add Project Dept ************************/

	$("#add-dept").click(function(event) {
	   	event.preventDefault();
	   	addDept();
	});

	function addDept(){
		$(".left-container").load(base_url + 'project/newDept');
	}

	$("#new-dept-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'project/createDept',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-dept-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-dept-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/***********************************************************/

});