  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/new_phase.js"></script>

<script>

</script>

<div class="new-phase-type">

<?php
	$attr = 'id="new-phase-type-form"';
	echo form_open('project/index', $attr);
	echo '<h1>Create a New Phase Type</h1>';

	$data = array(
		'name' => 'phase_type_name',
		'id' => 'phase-type-name',
		'placeholder' => 'Phase Type Name'
		);
	echo form_input($data);

	$data = array(
		'name' => 'new_phase_type_submit',
		'id' => 'new-phase-type-submit',
		'value' => 'Create Phase Type'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-phase-error" style="color:red;"></div>'; 
	echo '<div id="new-phase-success" style="color:green;"></div>'; 

	echo '<h2>Phase type Order</h2>';
	echo '<ul id="sortable">';
		foreach($phase_types as $type)
		{
	 		echo '<li id="phase-type-'.$type->PHASE_TYPE_ID.'" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$type->TYPE_NAME.'</li>';
	  	}
	echo '</ul>';
?>
 
</body>
</html>


