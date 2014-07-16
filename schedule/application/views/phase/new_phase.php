<script type="text/javascript" src="<?=base_url()?>assets/js/phase.js"></script>

<body>

<div class="new-phase">

<?php
	$attr = 'id="new-phase-form"';
	echo form_open('phaset/index', $attr);
	echo '<h1>Create a New Phase</h1>';

	//this will be where the project id is stored
	echo form_hidden('project_id', '1');

	$data = array(
		'name' => 'phase_name',
		'id' => 'phase-name',
		'placeholder' => 'Phase Name'
		);
	echo form_input($data);

	$data = array(
		'name' => 'phase_type',
		'id' => 'phase-type',
		'placeholder' => 'Phase Type'
		);
	echo form_input($data);

	$data = array(
		'name' => 'phase_duration',
		'id' => 'phase-duration',
		'placeholder' => 'Phase Duration (weeks)'
		);
	echo form_input($data);

	$data = array(
		'name' => 'new_phase_submit',
		'id' => 'new-phase-submit',
		'value' => 'Create Phase'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-phase-error" style="color:red;"></div>'; 
?>

</div>

</body>
</html>