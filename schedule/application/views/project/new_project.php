<script type="text/javascript" src="<?=base_url()?>assets/js/new_project.js"></script>
<style>@import url('<?=base_url()?>assets/css/new_project.css'); </style>

<body>

<div class="new-project">

<?php
	$attr = 'id="new-project-form"';
	echo form_open('project/index', $attr);
	echo '<h1>Create a New Project</h1>';

	$data = array(
		'name' => 'project_name',
		'id' => 'project-name'
		);
	echo form_label('Project Name: ', 'project_name');
	echo form_input($data);

	echo '<br />';

	echo form_label('Department: ', 'project_dept_id');
	echo '<select class="options" name="project_dept_id" id="project-dept">';
	  foreach($department as $dept)
	  {
	    echo '<option value ="'.$dept->PROJECT_DEPT_ID.'">'.$dept->DEPT_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';

	$data = array(
		'name' => 'project_year',
		'id' => 'project-year'
		);
	echo form_label('Project Year (YYYY): ', 'project_year');
	echo form_input($data);

	echo '<br />';

	echo form_label('Project Type: ', 'project_type_id');
	echo '<select class="options" name="project_type_id" id="project-type">';
	  foreach($project_type as $type)
	  {
	    echo '<option value ="'.$type->PROJECT_TYPE_ID.'">'.$type->TYPE_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';

	$data = array(
		'name' => 'project_sponsor',
		'id' => 'project-sponsor'
		);
	echo form_label('Project Sponsor: ', 'project_sponsor');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'sequence_number',
		'id' => 'sequence-number'
		);
	echo form_label('Sequence Number: ', 'sequence_number');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'project_descriptor',
		'id' => 'project-descriptor'
		);
	echo form_label('Project Descriptor: ', 'project_descriptor');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'project_code',
		'id' => 'project-code'
		);
	echo form_label('Project Code: ', 'project_code');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'project_duration',
		'id' => 'project-duration'
		);
	echo form_label('Project Duration (total hours for developers): ', 'project_duration');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'project_info',
		'id' => 'project-info',
		'rows' => '6'
		);
	echo form_label('Project Info: ', 'project_info');
	echo form_textarea($data);
	echo '<br />';
	echo '<br />';


	$data = array(
		'name' => 'new_project_submit',
		'id' => 'new-project-submit',
		'value' => 'Create Project'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-project-error" style="color:red;"></div>'; 
	echo '<div id="new-project-success" style="color:green;"></div>'; 
?>

</div>

</body>
</html>