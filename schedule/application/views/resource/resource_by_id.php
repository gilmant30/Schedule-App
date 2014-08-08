<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>


<script type="text/javascript">

$(document).ready(function(){

	$(function() {
	    $( "#year-progress-bar" ).progressbar({
	      value: <?= $progress_bar ?>
	    });
	});
});
</script>

<style type="text/css">
.ui-progressbar#year-progress-bar{
	width: 50%;
}
</style>

<?php
	echo '<h1>Year: '.$year.'</h1>';

	echo '<p>Choose another Year: <a href="#" id="year-2">'.$year2.'</a>   <a href="#" id="year3">'.$year3.'</a></p>';

	echo '<p>Name: '.$resource_info->RESOURCE_NAME.'</p>';

	echo '<p>Job: '.$resource_info->TYPE_NAME.'</p>';

	echo '<p>Total Time for the year: '.$total_time.' hrs</p>';

	echo '<p>Time Spent: '.$time_spent.' hrs</p>';

	echo '<p>Time Left: '.$available_time.' hrs</p>';

	echo '<p>'.$resource_info->RESOURCE_NAME.' total hrs <p>';
	echo '<div id="year-progress-bar"></div>';

	echo '<a href="#" class="show-all-resources">Show All Resources</a>';


	echo '<h3>Priority</h3>';

	$attr = 'id="new-resource-priority-form"';
	echo form_open('resource/index', $attr);

	$hidden = array(
		'resource_id' => $resource_id,
		'year' => $year
		);

	echo form_hidden($hidden);

	foreach ($systems as $system) {
		$flag = 0;
		foreach($resource_resp as $resp)
		{
			if($system->SKILL_ID == $resp->SKILL_ID)
			{
				$input = array(
					'name' => 'priority_'.$system->SKILL_ID,
					'id' => 'priority_'.$system->SKILL_ID,
					'value' => $resp->RESP
					);
				echo form_label($system->SKILL_NAME.': ', 'priority_'.$system->SKILL_ID);
				echo form_input($input);
				$flag++;
			}
		}
		if($flag == 0)
		{
			$input = array(
				'name' => 'priority_'.$system->SKILL_ID,
				'id' => 'priority_'.$system->SKILL_ID,
				'value' => '0'
				);
			echo form_label($system->SKILL_NAME.': ', 'priority_'.$system->SKILL_ID);
			echo form_input($input);
		}
		echo '</br>';
	}

	$data = array(
		'name' => 'new_resource_priority_submit',
		'id' => 'new-resource-priority-submit',
		'value' => 'Update Resource Priority'
		);
	echo form_submit($data);

	echo form_close();

	echo '<div id="new-priority-error" style="color:red;"></div>'; 
	echo '<div id="new-priority-success" style="color:green;"></div>'; 

?>



</body>