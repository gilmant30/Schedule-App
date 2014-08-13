<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-latest.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-ui-1.10.4.custom.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/header.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/new_project.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/new_phase.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/resource.js" ></script>
<style>@import url('<?=base_url()?>assets/css/header.css'); </style>
<style>@import url('<?=base_url()?>assets/css/new_project.css'); </style>


<script type="text/javascript">

var projects = <?=$project_codes?>;

var arr = [];

projects.forEach(function(entry){
	arr.push(entry.PROJECT_CODE);
});


  $(function() {
    $( "#search" ).autocomplete({
      source: arr
    });
  });



</script>
<body>

<div class="nav-menu">
	<div id="logo">
		<a href="http://www.worksafecenter.com/"><img id="logo" src="<?=base_url();?>/assets/img/mem_logo.png"></a>
	</div>

	<nav id="header-menu">
		<ul>
		    <li><a href="<?=base_url()?>project/index">Home</a></li>
		    <li>
		      <a href="#">Projects</a>
		      <ul class="fallback">
		        <li><a href="#" id="create-project">Create Project</a></li>
		        <li><a href="#" id="show-all-project-table">Show Table</a></li>
		        <li><a href="#">Show Calendar</a></li>
		       	<li><a href="#" id="add-project-type">Create Project Type</a></li>
		        <li><a href="#" id="add-dept">Create Department Type</a></li>
		      </ul>
		    </li>
		    <li>
		      <a href="#">Phases</a>
		      <ul class="fallback">
		        <li><a href="#">Edit Phase</a></li>
		        <li><a href="#" id="add-phase-type">Create Phase Type</a></li>
		      </ul>
		    </li>
		    <li>
		    	<a href="#">Resources</a>
		    	<ul class="fallback">
		    		<li><a href="#" id="create-resource">Create Resource</a></li>
		    		<li><a href="#" class="show-all-resources">Show All Resources</a></li>
		    		<li><a href="#" id="add-resource-type">Create Resource Type</a></li>
		    		<li><a href="#" id="add-resource-title">Create Resource Title</a></li>
		    		<li><a href="#" id="systems-by-priority">Systems by Priority</a></li>
		    		<li><a href="#">Resource Numbers</a></li>
		    	</ul>
		    </li>
		     <li>
		      <a href="#">Testing Only</a>
		      <ul class="fallback">
		        <li><a href="#" id="create-phase">Create Phase</a></li>
		        <li><a href="#" id="system-preferences">System Preferences</a></li>
		        <li><a href="#">Allocate Resource</a></li>
		      </ul>
		    </li>
		    <li><a href="<?=base_url()?>">Logout</a></li>
		</ul>
	</nav>

	<div class="search-bar">
	  <label for="search">Search: </label>
	  <input id="search">
	  <p id="search-button">Search</p>
	</div>

</div>

</br>


</body>
