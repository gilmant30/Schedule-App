<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
<style>@import url('<?=base_url()?>assets/css/project.css'); </style>

<script>
  $(function() {
    $( "#project-start" ).datepicker({
    	changeMonth: true,
     	changeYear: true,
     	showWeek: true,
     	minDate: 0,
     	beforeShowDay: function(date){ return [date.getDay() == 1,""]},
     	onClose: function( selectedDate ) {
        $( "#project-end" ).datepicker( "option", "minDate", selectedDate );
      }
    });
  });

    $(function() {
    $( "#project-end" ).datepicker({
    	changeMonth: true,
     	changeYear: true,
     	showWeek: true,
     	beforeShowDay: function(date){ return [date.getDay() == 5,""]},
     	 onClose: function( selectedDate ) {
        $( "#project-end" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
</script>

<body>

<div class="new-project">

<?php
	$attr = 'id="new-project-form"';
	echo form_open('project/index', $attr);
	echo '<h1>Create a New Project</h1>';

	echo '<div id="input-left">';
	$data = array(
		'name' => 'project_name',
		'id' => 'project-name'
		);
	echo form_label('Project Name: ', 'project_name');
	echo form_input($data);

	echo form_label('Department: ', 'project_dept_id');
	echo '<select class="options" name="project_dept_id" id="project-dept">';
	  foreach($department as $dept)
	  {
	    echo '<option value ="'.$dept->PROJECT_DEPT_ID.'">'.$dept->DEPT_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';

	$data = array(
		'name' => 'project_year',
		'id' => 'project-year'
		);
	echo form_label('Project Year (YYYY): ', 'project_year');
	echo form_input($data);

	echo form_label('Project Type: ', 'project_type_id');
	echo '<select class="options" name="project_type_id" id="project-type">';
	  foreach($project_type as $type)
	  {
	    echo '<option value ="'.$type->PROJECT_TYPE_ID.'">'.$type->TYPE_NAME.'</option>';
	  }
	echo '</select>';

	echo '<br />';

	$data = array(
		'name' => 'project_sponsor',
		'id' => 'project-sponsor'
		);
	echo form_label('Project Sponsor: ', 'project_sponsor');
	echo form_input($data);

	$data = array(
		'name' => 'sequence_number',
		'id' => 'sequence-number'
		);
	echo form_label('Sequence Number: ', 'sequence_number');
	echo form_input($data);

	echo '</div>';

	echo '<div id="input-right">';
	$data = array(
		'name' => 'project_descriptor',
		'id' => 'project-descriptor'
		);
	echo form_label('Project Descriptor: ', 'project_descriptor');
	echo form_input($data);

	$data = array(
		'name' => 'project_code',
		'id' => 'project-code'
		);
	echo form_label('Project Code: ', 'project_code');
	echo form_input($data);

	$data = array(
		'name' => 'project_start',
		'id' => 'project-start'
		);
	echo form_label('Project Start Week (Monday): ', 'project_start');
	echo form_input($data);

	$data = array(
		'name' => 'project_end',
		'id' => 'project-end'
		);
	echo form_label('Project End Week (Friday): ', 'project_end');
	echo form_input($data);

	$data = array(
		'name' => 'project_info',
		'id' => 'project-info',
		'rows' => '6'
		);
	echo form_label('Project Info: ', 'project_info');
	echo form_textarea($data);
	echo '<br />';
	echo '<br />';
	echo '</div>';


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