$( document ).ready(function() {

	$('nav li ul').hide().removeClass('fallback');
		$('nav li').hover(
		  function () {
		    $('ul', this).stop().slideDown(100);
		  },
		  function () {
		    $('ul', this).stop().slideUp(100);
		  }
	);

	$("#search-button").click(function(){
		var projectCode = $("#search").val();
		$("#search").val('');
		if(projectCode)
		{
			alert(projectCode);
		}
		
	});

});