var base_url = 'http://localhost/schedule/';

$( document ).ready(function() {
/********************************** HOME PAGE **********************************************/
var system;
var type;
var year;

/************** Progress Bar ************************/
	
$("#project-system").bind( "change", function() {
  system = $("#project-system").val();
  type = $("#resource-type").val();
  year = $("#project-year").val();
  $(".bar").load(base_url + "project/displayProgress/" + system + "/" + type + "/" + year);
});

$("#resource-type").bind( "change", function() {
  system = $("#project-system").val();
  type = $("#resource-type").val();
  year = $("#project-year").val();
  setTimeout(function() { loadPage(system,type,year); }, 1000);
});

$("#project-year").bind( "change", function() {
  system = $("#project-system").val();
  type = $("#resource-type").val();
  year = $("#project-year").val();
  setTimeout(function() { loadPage(system,type,year); }, 1000);
});

function loadPage(sys,resourceType,projectYear)
{
  $(".bar").load(base_url + "project/displayProgress/" + sys + "/" + resourceType + "/" + projectYear);
}

/*****************************************************/

/****************************************************************************************/

});