<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/phase.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js"></script>
	<style>@import url('<?=base_url()?>assets/css/project.css'); </style>
	<style>@import url('<?=base_url()?>assets/css/top_container.css'); </style>
	<title>Schedule App</title>
</head>
<body>

<div class="main-container">

<div class="top-container">
<h1>Select a project to work on</h1>
</div>

<div class="left-container">
	<h1>Project</h1>
	<ul class="project">
		<li id="create-project">Create Project</li>
		<li id="show-all-project">Show all</li>
	</ul>
	<h1>Phase</h1>
	<ul class="phase">
		<li id="create-phase">Create Phase</li>
		<li id="edit-phase">Edit Phase</li>
	</ul>
	<h1>Resources</h1>
	<ul class="resource">
		<li id="create-resource">Create Resource</li>
		<li id="search-resource">Search Resource</li>
		<li id="show-all-resource">Show all Resources</li>
	</ul>
	<h1>System</h1>
	<ul class="system">
		<li id="add-project-type">Add Project Type</li>
		<li id="add-phase-type">Add Phase Type</li>
		<li id="add-dept">Add Department</li>
		<li><a href="<?=base_url();?>login/logout">Logout</a></li>
	</ul>
</div>

<div class="right-container">
<h1>Welcome to the home page for your new scheduler application click on a link on the right to begin</h1>
</div>



</div>

</body>
</html>