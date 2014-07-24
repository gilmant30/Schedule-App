var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/********************************** Phases **********************************************/

	/************** New Phase ************************/

	$("#create-phase").click(function() {
	   	loadAllProjectPage();
	});

	function loadAllProjectPage(){
		var project_id = $("#top-view-info-project-id").text();
		//check whether there is a valid project id available
		if(project_id)
		{
			loadNewPhaseForm(project_id);
		}
		else
		{
			$(".right-container").load(base_url + 'phase/selectProject');
		}
		
	}

	function loadNewPhaseForm(project_id){
		$(".right-container").load(base_url + 'phase/newPhase/' + project_id);
	}

	$("#new-phase-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'phase/createPhase',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-phase-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-phase-form")[0].reset();
	            	$("#new-phase-success").html(data.msg);        
	            }
	        }
		});
	});

	/*************************************************/


	/************** Show All Phases ************************/

	$("#show-all-phase").click(function() {
	   	showAllPhasess();
	});

	function showAllPhases(){
		$(".right-container").load(base_url + 'phase/showAll');
	}

	/***********************************************************/

	/************** New Phase Type ************************/

	$("#add-phase-type").click(function() {
	   	addPhaseType();
	});

	function addPhaseType(){
		$(".right-container").load(base_url + 'phase/newPhaseType');
	}

	$("#new-phase-type-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'phase/createPhaseType',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-phase-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$("#new-phase-success").html(data.msg); //throws success message       
	            }
	        }
		});
	});

	$(function() {
	    $( "#sortable" ).sortable({
    		update: function(event, ui){
    			var order = $("#sortable").sortable('toArray');
    			alert(order);
    			/*
    			$.ajax({
				  	url: base_url + 'phase/updateTypeOrder',
				  	type: "POST",
				  	data: order,
				  	dataType : 'json',
				  	success:function(data){
					  	if (data.success == 0) { //If fails
			                $('#new-phase-error').html(data.msg); //Throw relevant error
			            }
			            else {
			            	console.log(data.msg)
			            	//$("#new-phase-success").html(data.msg); //throws success message       
			            }
			        }
				});
	    		*/
    		}
	    });
	    $( "#sortable" ).disableSelection();
	});

	/***********************************************************/


/****************************************************************************************/
});