<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>


<body>

<div class="new-title">

<?php
	$attr = 'id="new-title-form"';
	echo form_open('resource/index', $attr);
	echo '<h1>Create a New Title for Resources</h1>';

	$data = array(
		'name' => 'title',
		'id' => 'title'
		);
	echo form_label('Title Resource: ', 'title');
	echo form_input($data);

	echo '<br />';

	$data = array(
		'name' => 'work_week_hr',
		'id' => 'work-week-hr'
		);
	echo form_label('Hours per work week: ', 'work_week_hr');
	echo form_input($data);


	echo '<br />';
	echo '<br />';


	$data = array(
		'name' => 'new_title_submit',
		'id' => 'new-title-submit',
		'value' => 'Create Title'
		);
	echo form_submit($data);

	echo form_close();
	echo '<div id="new-title-error" style="color:red;"></div>'; 
	echo '<div id="new-title-success" style="color:green;"></div>'; 

	echo '<br />';
	echo '<br />';


	echo '<h2>Titles already exist</h2>';

	if($title)
	{
		echo '<table>';
			echo '<thead>';
				echo '<th>Title name</th>';
				echo '<th>Hours per week</th>';
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
			echo '</thead>';
			echo '<tbody>';
		foreach ($title as $title) {
			echo '<tr>';
				echo '<td>'.$title->TITLE_NAME.'</td>';
				echo '<td>'.$title->HR_WORK_WEEK.'</td>';
				echo '<td><a href="#">Edit</a></td>';
				echo '<td><a href="#">Delete</a></td>';
			echo '</tr>';
		}

			echo '</tbody>';
		echo '</table>';
	}
	else
	{
		echo 'There are currently no resource types created';
	}



?>

</div>

</body>
</html>