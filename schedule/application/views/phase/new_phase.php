<script type="text/javascript" src="<?=base_url()?>assets/js/new_phase.js"></script>

<style>@import url('<?=base_url()?>assets/css/progress_tracker.css'); </style>

<script>

	var projectStart = "<?= $project->PROJECT_START?>";
	var projectEnd = "<?= $project->PROJECT_END?>";

	//alert(projectStart); 
  
  $(function() {
    $( ".phase-start" ).datepicker({
    	changeMonth: true,
     	changeYear: true,
     	showWeek: true,
     	numberOfMonths: 2,
     	minDate: projectStart,
     	maxDate: projectEnd,
     	beforeShowDay: function(date){ return [date.getDay() == 1,""]},
    });
  });

    $(function() {
    $( ".phase-end" ).datepicker({
    	changeMonth: true,
     	changeYear: true,
     	showWeek: true,
     	numberOfMonths: 2,
     	minDate: projectStart,
     	maxDate: projectEnd,
     	beforeShowDay: function(date){ return [date.getDay() == 5,""]},
    });
  });
 </script>

<div class="new-phase">

<div class="tracker">
<ol class="progtrckr" data-progtrckr-steps="5">
    <li class="progtrckr-done">Create Project</li><!--
 --><li class="progtrckr-todo">Create Phases</li><!--
 --><li class="progtrckr-todo">Allocate Resources</li><!--
 --><li class="progtrckr-todo">Select Dates</li><!--
 --><li class="progtrckr-todo">Finished!</li>
</ol>
</div>

<?php
	$attr = 'id="new-phase-form"';
	echo form_open('phase/index', $attr);

	echo form_hidden('project_id', $project->PROJECT_ID);

	echo '<h1>Create New phase for '.$project->PROJECT_CODE.'</h1>';

	echo '<table class="phase-table">';
	echo '<thead>';
		echo '<tr>';
			echo '<th>Add?</th>';
			echo '<th>Type</th>';
			foreach ($resource_types as $type) {
				echo '<th>'.$type->TYPE_NAME.' duration (hrs)</th>';
			}
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

	foreach($phase_types as $phase_type)
	{
		echo '<tr>';
		echo '<td>'.form_checkbox('insert_phase[]', $phase_type->PHASE_TYPE_ID, FALSE).'</td>';
		echo '<td>'.$phase_type->TYPE_NAME.'</td>';

		foreach ($resource_types as $type) {
			$input = array(
			'name' => 'phase_duration_'.$phase_type->PHASE_TYPE_ID.'_'.$type->RESOURCE_TYPE_ID,
			'class' => 'phase-duration'
			);
			
			echo '<td>'.form_input($input).'</td>';
		}

		echo '</tr>';
	}
	echo '</tbody>';
  	echo '</table>';


  	$data = array(
		'name' => 'new_phase_submit',
		'id' => 'new-phase-submit',
		'value' => 'Create Phase(s)'
		);
	echo form_submit($data);
  	echo form_close();

	echo '<div id="new-phase-error" style="color:red;"></div>'; 
	echo '<div id="new-phase-success" style="color:green;"></div>'; 
?>

</div>

