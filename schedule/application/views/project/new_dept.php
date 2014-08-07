<script type="text/javascript" src="<?=base_url()?>assets/js/new_project.js"></script>
<style>@import url('<?=base_url()?>assets/css/new_project.css'); </style>

<body>

<div class="new-dept">

<?php
	$attr = 'id="new-dept-form"';
	echo form_open('project/index', $attr);
	echo '<h1>Create a New Department</h1>';

	$data = array(
		'name' => 'dept_name',
		'id' => 'dept-name',
		'placeholder' => 'Department Name'
		);
	echo form_label('Department Name: ', 'dept_name');
	echo form_input($data);

	echo '</br>';

	$data = array(
		'name' => 'dept_abbr',
		'id' => 'dept-abbr',
		'placeholder' => 'Department Abbreviation'
		);
	echo form_label('Department Abbreviation: ', 'dept_abbr');
	echo form_input($data);

	echo '</br>';

	$data = array(
		'name' => 'new_dept_submit',
		'id' => 'new-dept-submit',
		'value' => 'Create Department'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-dept-error" style="color:red;"></div>'; 
	echo '<div id="new-dept-success" style="color:green;"></div>'; 

	echo '<h2>Departments already existent</h2>';
	foreach($department as $dept)
	{
		echo '<p>'.$dept->DEPT_NAME.'</p>';
	}
?>

</div>

</body>
</html>