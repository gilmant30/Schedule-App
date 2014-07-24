<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>

<body>
<div class="project-info-body">

<div id="gantt-chart">
<div class="gantt1"></div>
</div>

<div id="phase-info"></div>

</div>
</body>

<script>

	$(function() {	
		var data = <?= $json_array ?>;
		var len = Object.keys(data).length;
		var arr = [];
		var color = ['ganttOrange', 'ganttRed', 'ganttBlue', 'ganttGreen'];
		var c = 0;

		for(var i = 0;i < len; i++)
		{
			if(c>3)
			{
				c=0;
			}
			var start_date = new Date(data[i].phase_start).getTime(); 
			var end_date = new Date(data[i].phase_end).getTime(); 
			

			var start = "/Date(" + start_date.valueOf() + ")/";
			var end = "/Date("+ end_date.valueOf() +")/";

			arr.push({
				from: start,
				to: end,
				label: data[i].phase_type,
				customClass: color[c],
				dataObj: {phase_id: data[i].phase_id}
			});

			c++;
		}

		var start_date = new Date("<?php echo $project->PROJECT_START; ?>").getTime(); 
		var end_date = new Date("<?php echo $project->PROJECT_END; ?>").getTime(); 

		var start = "/Date(" + start_date.valueOf() + ")/";
		var end = "/Date("+ end_date.valueOf() +")/";

		console.log(arr);
	
		$(".gantt1").gantt({
			source: [
				{
					name: "<?=$project->PROJECT_CODE?>",
					desc: "<?=$project->PROJECT_INFO?>",
					values: [
							{
								from: start,
								to: end,
								label: "Whole Project Length", 
								customClass: "ganttGreen",
								dataObj: {project_id:"<?= $project->PROJECT_ID; ?>"}
							}
						] 
				},
				{
					name: "",
					desc: "Phases",
					values: arr
				}
				],
			scale: "weeks",
			minScale: "weeks",
			scrollToToday: false,
			navigate: "scroll",
			waitText: "Loading phases...",
			onItemClick: function(data) {
				$(".right-container").html("This is where the data will go for phase with id of " + data.phase_id);
			},
		});
	
	});

</script>