<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
<style>@import url('<?=base_url()?>/assets/css/project.css'); </style>
<body>

<div class="new-project">

<?php
	$attr = 'id="new-project-form"';
		echo form_open('project/index', $attr);
		echo '<h1>Create a New Project</h1>';

		$data = array(
			'name' => 'project_name',
			'id' => 'project-name',
			'placeholder' => 'Project Name'
			);
		echo form_input($data);

		$data = array(
			'name' => 'project_department',
			'id' => 'project-department',
			'placeholder' => 'Department'
			);
		echo form_input($data);

		$data = array(
			'name' => 'project_year',
			'id' => 'project-year',
			'placeholder' => 'Project Year'
			);
		echo form_input($data);

		$data = array(
			'name' => 'project_type',
			'id' => 'project-type',
			'placeholder' => 'Project Type'
			);
		echo form_input($data);

		$data = array(
			'name' => 'project_sponsor',
			'id' => 'project-sponsor',
			'placeholder' => 'Project Sponsor'
			);
		echo form_input($data);

		$data = array(
			'name' => 'sequence_number',
			'id' => 'sequence-number',
			'placeholder' => 'Sequence Number'
			);
		echo form_input($data);

		$data = array(
			'name' => 'project_descriptor',
			'id' => 'project-descriptor',
			'placeholder' => 'Project Descriptor'
			);
		echo form_input($data);

		$data = array(
			'name' => 'new_project_submit',
			'id' => 'new-project-submit',
			'value' => 'Create Project'
			);
		echo form_submit($data);

		echo form_close();
		echo '<div id="new-project-error" style="color:red;"></div>'; 
?>

</div>

</body>
</html>