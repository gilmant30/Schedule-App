var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {

/********************************** RESOURCES **********************************************/


	/************** New Resource ************************/

	$("#create-resource").click(function() {
		loadNewResourceForm();
	});

	function loadNewResourceForm(){
		$(".right-container").html('This is the new resource page');
	}

	/*****************************************************/



	/************** Search Resource ************************/

	$("#search-resource").click(function() {
		loadSearchResourceForm();
	});

	function loadSearchResourceForm(){
		$(".right-container").html('This is the search resource page');
	}

	/*******************************************************/


	/************** Show All Resource ************************/

	$("#show-all-resource").click(function() {
		showAllResources();
	});

	function showAllResources(){
		$(".right-container").html('This is the show all resources page');
	}

	/*******************************************************/

/****************************************************************************************/

});