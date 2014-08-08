var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/********************************** RESOURCES **********************************************/


	/************** New Resource ************************/

	$("#create-resource").click(function(event) {
		event.preventDefault();
		loadNewResourceForm();
	});

	function loadNewResourceForm(){
		$(".left-container").load(base_url + 'resource/newResource');
	}


	$("#new-resource-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'resource/createResource',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-resource-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-resource-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/*****************************************************/

	/************** Show All Resources ************************/

	$(".show-all-resources").click(function(event) {
		event.preventDefault();
		loadAllResources();
	});

	function loadAllResources(){
		$(".left-container").load(base_url + 'resource/showAll');
	}

	$(".clickable").click(function() {
		var id = $(this).text();
		var year = new Date();
		year = year.getFullYear();
		//$(".left-container").html('This is the resource page for resource '+id);
		$(".left-container").load(base_url + "resource/showResourceById/"+id+"/"+year);
	});


	/*****************************************************/

	/************** New Resource Type ************************/

	$("#add-resource-type").click(function(event) {
		event.preventDefault();
		loadNewResourceTypeForm();
	});

	function loadNewResourceTypeForm(){
		$(".left-container").load(base_url + 'resource/newResourceType');
	}


	$("#new-resource-type-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'resource/createResourceType',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-resource-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-resource-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/*****************************************************/


	/************** Title Resource ************************/

	$("#add-resource-title").click(function(event) {
		event.preventDefault();
		loadNewTitleForm();
	});

	function loadNewTitleForm(){
		$(".left-container").load(base_url + 'resource/newTitle');
	}


	$("#new-title-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'resource/createTitle',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-title-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-title-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/*****************************************************/


	/************** Search Resource ************************/

	$("#search-resource").click(function() {
		loadSearchResourceForm();
	});

	function loadSearchResourceForm(){
		$(".right-container").html('This is the search resource page');
	}

	/*******************************************************/

	/************** Update Resource Priority ************************/

	$("#new-resource-priority-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'resource/updatePriority',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-priority-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-priority-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	/*****************************************************/

	


	/************** Show All Resources ************************/


	/*****************************************************/

/****************************************************************************************/

});