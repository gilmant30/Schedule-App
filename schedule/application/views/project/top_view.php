<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
<style>@import url('<?=base_url()?>assets/css/top_container.css'); </style>
<body>

<div class="top-view">

<?php

if($project == FALSE)
{
	echo "ERROR - Error retrieving project information";
}
else
{
	echo '<div id="top-view-info">';
		
	echo '<div id="top-view-info-project-id">'.$project->PROJECT_ID.'</div>';

		echo '<div id="top-view-project-name">';
		echo 'Title: '.$project->PROJECT_NAME;
		echo '</div>';

		echo '<div id="top-view-project-department">';
		foreach($department as $dept)
		{
			if($dept->PROJECT_DEPT_ID == $project->PROJECT_DEPT_ID)
				echo 'Department: '.$dept->DEPT_NAME;
		}
		echo '</div>';

		echo '<div id="top-view-project-type">';
		foreach($types as $type)
		{
			if($type->PROJECT_TYPE_ID == $project->PROJECT_TYPE_ID)
				echo 'Type: '.$type->TYPE_NAME;
		}
		echo '</div>';

		echo '<div id="top-view-project-start">';
		echo 'Project Start: '.$project->PROJECT_START;
		echo '</div>';

		echo '<div id="top-view-project-end">';
		echo 'Project End: '.$project->PROJECT_END;
		echo '</div>';
	
		echo '<div id="top-view-project-detail">';
		echo 'Info: '.$project->PROJECT_INFO;
		echo '</div>';
	
	echo '</div>';

	echo '<div id="top-view-calendar">';
		echo '<div class="gantt"></div>';
	echo '</div>';
}

?>

</div>
</body>

<script>

	$(function() {	

			var start_date = new Date("<?php echo $project->PROJECT_START; ?>").getTime(); 
			var end_date = new Date("<?php echo $project->PROJECT_END; ?>").getTime(); 

			var start = "/Date(" + start_date.valueOf() + ")/";
			var end = "/Date("+ end_date.valueOf() +")/";


			$(".gantt").gantt({
				source: [{
						name: "<?php echo $project->PROJECT_CODE; ?>",
						desc: "<?php echo $project->PROJECT_DESCRIPTOR; ?>",
						values: [
							{
								from: start,
								to: end,
								label: "Whole Project Length", 
								customClass: "ganttOrange",
								dataObj: {project_id:"<?= $project->PROJECT_ID; ?>"}
							}
						]
					}],
				scale: "weeks",
				minScale: "weeks",
				scrollToToday: false,
				navigate: "scroll",
				onItemClick: function(data) {
					$(".right-container").load('<?=base_url()?>project/showProjectInfo/<?=$project->PROJECT_ID?>');
				},
			});

	});

</script>
</html>