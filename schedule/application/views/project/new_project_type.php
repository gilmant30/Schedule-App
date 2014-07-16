<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
<style>@import url('<?=base_url()?>assets/css/project.css'); </style>

<body>

<div class="new-project-type">

<?php
	$attr = 'id="new-project-type-form"';
	echo form_open('project/index', $attr);
	echo '<h1>Create a New Project Type</h1>';

	$data = array(
		'name' => 'project_type_name',
		'id' => 'project-type-name',
		'placeholder' => 'Project Type Name'
		);
	echo form_input($data);

	$data = array(
		'name' => 'new_project_type_submit',
		'id' => 'new-project-type-submit',
		'value' => 'Create Project Type'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-project-error" style="color:red;"></div>'; 
	echo '<div id="new-project-success" style="color:green;"></div>'; 
?>

</div>

</body>
</html>