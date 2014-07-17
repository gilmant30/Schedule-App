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

		"use strict";

		$(".gantt").gantt({
			source: [{
				name: "Testing",
				desc: " ",
				values: [{
					from: "/Date(1328832000000)",
					to: "/Date(1333411200000)",
					label: "Test", 
					customClass: "ganttRed"
				}]
			}],
			scale: "weeks",
			minScale: "weeks",
			maxScale: "months",
			onItemClick: function(data) {
				alert("Item clicked - show some details");
			},
			onAddClick: function(dt, rowId) {
				alert("Empty space clicked - add an item!");
			},
			onRender: function() {
				console.log("chart rendered");
			}
		});

	});

</script>
</html>