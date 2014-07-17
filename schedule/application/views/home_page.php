<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/phase.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-latest.js"></script>
	<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js"></script>
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-ui-1.10.4.custom.min.js"></script>
	<style>@import url('<?=base_url()?>assets/css/project.css'); </style>
	<style>@import url('<?=base_url()?>assets/css/gantt.css'); </style>
	<style>@import url('<?=base_url()?>assets/css/top_container.css'); </style>
	<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.fn.gantt.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/moment.min.js"></script>
	<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://taitems.github.com/UX-Lab/core/css/prettify.css" />
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
		<li id="search-project">Search Project</li>
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
<h1>Welcome to the home page for your new scheduler application click on a link on the left to begin</h1>
</div>



</div>

</body>
</html>