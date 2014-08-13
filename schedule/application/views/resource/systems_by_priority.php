<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>

<script type="text/javascript">
$(document).ready(function() 
    { 
        $(".tablesorter").tablesorter()  
	}); 
</script>

<body>
	<h1>Priorities by Resource Type</h1>
	<p>Number system is done by '1' being primary system worked, on '2' secondary, etc...</p>
<?php
foreach ($resource_types as $type) {
	echo '<h3>'.$type->TYPE_NAME.'</h3>';
	echo '<table id="" class="tablesorter">';
		echo '<thead>';
			echo '<tr>';
					echo '<th></th>';
				foreach($resources as $resource){
					if($resource->RESOURCE_TYPE_ID == $type->RESOURCE_TYPE_ID)
					{
						echo '<th>'.$resource->RESOURCE_NAME.'</th>';
					}
				}
			echo '</tr>';
		echo '</thead>';
		echo '<tbody>';
			foreach($systems as $sys){
				echo '<tr>';
				echo '<td class="system">'.$sys->SKILL_NAME.'</td>';
				foreach($resources as $resource){
					if($resource->RESOURCE_TYPE_ID == $type->RESOURCE_TYPE_ID)
					{
						$flag = 0;
						foreach($resource_resps as $resp)
						{
							if($resource->RESOURCE_ID == $resp->RESOURCE_ID && $sys->SKILL_ID == $resp->SKILL_ID)
							{
								echo '<td id="order-'.$resource->RESOURCE_ID.'-'.$sys->SKILL_ID.'">'.$resp->RESP.'</td>';
								$flag++;
							}
						}
						if($flag == 0)
						{
							echo '<td id="'.$flag.'">0</td>';
						}
					}
				}
			echo '</tr>';
			}
		echo '</tbody>';

	echo '</table>';
}
	
?>


</body>