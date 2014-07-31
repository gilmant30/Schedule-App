var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/********************************** Phases **********************************************/

	/************** New Phase ************************/

	$("#create-phase").click(function(event) {
		event.preventDefault();
	   	loadNewPhaseForm();
	});

	/*
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
	*/

	function loadNewPhaseForm(){
		$(".left-container").load(base_url + 'phase/newPhase/1');
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

	$("#add-phase-type").click(function(event) {
		event.preventDefault();
	   	addPhaseType();
	});

	function addPhaseType(){
		$(".left-container").load(base_url + 'phase/newPhaseType');
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


	/***********************************************************/


/****************************************************************************************/
});