var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/********************************** Phases **********************************************/

	/************** New Phase ************************/

	$("#create-phase").click(function() {
	   	loadAllProjectPage();
	});

	function loadAllProjectPage(){
		$(".right-container").load(base_url + 'phase/newPhase');
	}

	function loadNewPhaseForm(){
		$(".right-container").load(base_url + 'phase/newPhase');
	}

	$("#new-phase-form").submit(function(event){
		event.preventDefault();

		var form_data = $(this).serialize();

		$.ajax({
		  	url: base_url + 'project/createPhase',
		  	type: "POST",
		  	data: form_data,
		  	dataType : 'json',
		  	success:function(data){
			  	if (data.success == 0) { //If fails
	                $('#new-project-error').html(data.msg); //Throw relevant error
	            }
	            else {
	            	$(".right-container").load(base_url + 'phase/info');        
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

/****************************************************************************************/

});