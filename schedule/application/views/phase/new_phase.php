<script type="text/javascript" src="<?=base_url()?>assets/js/new_phase.js"></script>
<style>@import url('<?=base_url()?>assets/css/progress_tracker.css'); </style>


<script type="text/javascript">

$(document).ready(function(){

	var resources = <?= json_encode($resource_types)?>;

	var resource_arr = [];

	resources.forEach(function(entry){
		resource_arr.push(entry.RESOURCE_TYPE_ID);
	});

	$(".phase-duration").bind( "blur", function() {
		var name = $(this).attr("name");

		var hours = $(this).val();

		var resource_id = name.substr(name.lastIndexOf("_")+1);

		resource_arr.forEach(function(entry) {
			if(entry == resource_id)
			{
				var resource = $("#h-"+entry).text();

				resource = parseInt(resource);
				hours = parseInt(hours);

				resource = resource - hours;

				if(hours > 0)
					$("#h-"+entry).html(resource);	

				if(resource < 0)
					$("#h-"+entry).css("color", "red");	
			}
		});
	});
});

</script>

<div class="new-phase">

<div class="tracker">
<ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-done">Create Project</li><!--
 --><li class="progtrckr-todo">Create Phases</li><!--
 --><li class="progtrckr-todo">Allocate Resources</li><!--
 --><li class="progtrckr-todo">Review</li><!--
 --><li class="progtrckr-todo">Finished!</li>
</ol>
</div>

<?php

	$attr = 'id="new-phase-form"';
	echo form_open('phase/index', $attr);

	echo form_hidden('project_id', $project->PROJECT_ID);

	echo '<h1>Create New phases for '.$project->PROJECT_CODE.'</h1>';

	foreach($phase_types as $phase_type)
	{
		echo '<h3>'.$phase_type->TYPE_NAME.'</h3>';

		echo '<table class="phase-table">';
			echo '<thead>';
				echo '<tr>';
					echo '<th></th>';
					foreach ($system as $sys) {
						echo '<th>'.$sys->SKILL_NAME.' (hrs)</th>';
					}
				echo '</tr>';
			echo '</thead>';

			echo '<tbody>';
			foreach ($resource_types as $resource_type) {
				echo '<tr>';
					echo '<td>'.$resource_type->TYPE_NAME.'</td>';
					foreach($system as $sys)
					{
						$input = array(
						'name' => 'duration_'.$phase_type->PHASE_TYPE_ID.'_'.$sys->SKILL_ID.'_'.$resource_type->RESOURCE_TYPE_ID,
						'class' => 'phase-duration',
						'value' => 0
						);
						echo '<td>'.form_input($input).'</td>';
					}
				echo '</tr>';
			}
				
			echo '</tbody>';
  		echo '</table>';

  	echo '<p>-------------------------------------------------------------------------</p>';	
	}




  	$data = array(
		'name' => 'new_phase_submit',
		'id' => 'new-phase-submit',
		'value' => 'Create Phase(s)'
		);
	echo form_submit($data);
  	echo form_close();

	echo '<div id="new-phase-error" style="color:red;"></div>'; 
	echo '<div id="new-phase-success" style="color:green;"></div>'; 


	echo '</br>';
	echo '</br>';

	echo '<h2>Time left in project</h2>';

	echo '<ul>';
		foreach ($resource_types as $type) {
			foreach($project_duration as $duration)
			{
				if($duration->RESOURCE_TYPE_ID == $type->RESOURCE_TYPE_ID)
					echo '<li class="project-hours">'.$type->TYPE_NAME.' time left for project: <strong id="h-'.$type->RESOURCE_TYPE_ID.'">'.$duration->PROJ_DURATION.'</strong></li>';
			}
		}
	echo '</ul>';

?>

</div>

