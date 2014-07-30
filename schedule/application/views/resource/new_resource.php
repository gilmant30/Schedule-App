<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>


<body>

<div class="new-resource">

<?php
	$attr = 'id="new-resource-form"';
	echo form_open('resource/index', $attr);
	echo '<h1>Create a New Resource</h1>';

	$data = array(
		'name' => 'resource_name',
		'id' => 'resource-name'
		);
	echo form_label('Resource Name: ', 'resource_name');
	echo form_input($data);

	echo '<br />';

	echo form_label('Resource Type: ', 'resource_type');
	echo '<select class="resource_options" name="resource_type" id="resource-type">';
	  foreach($resource_type as $type)
	  {
	    echo '<option value ="'.$type->RESOURCE_TYPE_ID.'">'.$type->TYPE_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';
	
	echo form_label('Resource Title: ', 'resource_title');
	echo '<select class="resource_options" name="resource_title" id="resource-title">';
	  foreach($title as $title)
	  {
	    echo '<option value ="'.$title->TITLE_ID.'">'.$title->TITLE_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';
	echo '<br />';


	$data = array(
		'name' => 'new_resource_submit',
		'id' => 'new-resource-submit',
		'value' => 'Create Resource'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-resource-error" style="color:red;"></div>'; 
	echo '<div id="new-resource-success" style="color:green;"></div>'; 
?>

</div>

</body>
</html>