<script type="text/javascript" src="<?=base_url()?>assets/js/new_project.js"></script>
<style>@import url('<?=base_url()?>assets/css/new_project.css'); </style>
<style>@import url('<?=base_url()?>assets/css/progress_tracker.css'); </style>
<style>@import url('<?=base_url()?>assets/css/multi-select.css'); </style>

<script type="text/javascript">


</script>

<body>

<div class="new-project">

<div class="tracker">
<ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-todo">Create Project</li><!--
 --><li class="progtrckr-todo">Create Phases</li><!--
 --><li class="progtrckr-todo">Allocate Resources</li><!--
 --><li class="progtrckr-todo">Review</li><!--
 --><li class="progtrckr-todo">Finished!</li>
</ol>
</div>

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
	    echo '<option value ="'.$dept->PROJECT_DEPT_ID.'" id="'.$dept->ABBR.'">'.$dept->DEPT_NAME.'</option>';
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
	    echo '<option value ="'.$type->PROJECT_TYPE_ID.'" id="'.$type->ABBR.'">'.$type->TYPE_NAME.'</option>';
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

	foreach ($resource_type as $type) {
		$data = array(
		'name' => 'duration_'.$type->RESOURCE_TYPE_ID,
		'class' => 'project-duration',
		'value' => 0
		);
	echo form_label($type->TYPE_NAME.' project duration (hrs): ', 'duration_'.$type->RESOURCE_TYPE_ID);
	echo form_input($data);

	echo '<br />';
	}

	echo '<br />';

	echo form_label('Select all systems used in this project: ', 'system[]');
	echo '<select name="system[]" id="system" multiple="multiple">';
		foreach($system as $sys)
		{
			echo '<option value="'.$sys->SKILL_ID.'">'.$sys->SKILL_NAME.'</option>';
		}
	echo '</select>';

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