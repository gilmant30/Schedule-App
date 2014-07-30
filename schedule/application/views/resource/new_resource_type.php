<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>


<body>

<div class="new-resource">

<?php
	$attr = 'id="new-resource-type-form"';
	echo form_open('resource/index', $attr);
	echo '<h1>Create a New Resource Type</h1>';

	$data = array(
		'name' => 'resource_type',
		'id' => 'resource-type'
		);
	echo form_label('Resource Type: ', 'resource_type');
	echo form_input($data);


	echo '<br />';
	echo '<br />';


	$data = array(
		'name' => 'new_resource_type_submit',
		'id' => 'new-resource-type-submit',
		'value' => 'Create Resource Type'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-resource-error" style="color:red;"></div>'; 
	echo '<div id="new-resource-success" style="color:green;"></div>'; 

	echo '<br />';
	echo '<br />';

	echo '<h2>Resource Types already exist</h2>';

	if($resource_type)
	{
		foreach ($resource_type as $type) {
			echo '<p>'.$type->TYPE_NAME.'</p>';
		}
	}
	else
	{
		echo 'There are currently no resource types created';
	}
?>

</div>

</body>
</html>