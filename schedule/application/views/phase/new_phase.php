<script type="text/javascript" src="<?=base_url()?>assets/js/phase.js"></script>
<style>@import url('<?=base_url()?>assets/css/phase.css'); </style>

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
			echo '<th>Phase Duration (total hours for developers)</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

	foreach($phase_types as $type)
	{
		$input = array(
		'name' => 'phase_duration',
		'class' => 'phase-duration'
		);


		echo '<tr>';
		echo '<td>'.form_checkbox('insert_phase[]', $type->PHASE_TYPE_ID, FALSE).'</td>';
		echo '<td>'.$type->TYPE_NAME.'</td>';
		echo '<td>'.form_input($input).'</td>';

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

