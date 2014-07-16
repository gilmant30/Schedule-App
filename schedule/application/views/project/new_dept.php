<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>

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
	echo form_input($data);

	$data = array(
		'name' => 'new_dept_submit',
		'id' => 'new-dept-submit',
		'value' => 'Create Department'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-dept-error" style="color:red;"></div>'; 
	echo '<div id="new-dept-success" style="color:green;"></div>'; 
?>

</div>

</body>
</html>