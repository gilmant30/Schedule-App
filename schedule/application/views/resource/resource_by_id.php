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

?>



</body>