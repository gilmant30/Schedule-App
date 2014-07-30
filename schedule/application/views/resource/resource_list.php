<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js" ></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/resource.js"></script>

<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter()  
	}); 
</script>

<body>
<div class="all-Resources">
	<h1>All Resources</h1>
	<table id="myTable" class="tablesorter">
		<thead>
			<tr>
				<th>Resource Id</th>
				<th>Name</th>
				<th>Type</th>
				<th>Title</th>
				<th>Hours Per week</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if($resource)
			{
				foreach($resource as $resource)
				{
					echo '<tr>';
						echo '<td class="clickable" id="'.$resource->RESOURCE_ID.'" style="cursor:pointer;">'.$resource->RESOURCE_ID.'</td>';
						echo '<td>'.$resource->RESOURCE_NAME.'</td>';
						foreach($resource_type as $type)
						{
							if($type->RESOURCE_TYPE_ID == $resource->RESOURCE_TYPE_ID)
								echo '<td>'.$type->TYPE_NAME.'</td>';
						}

						foreach($resource_title as $title)
						{
							if($title->TITLE_ID == $resource->TITLE_ID)
							{
								echo '<td>'.$title->TITLE_NAME.'</td>';
								echo '<td>'.$title->HR_WORK_WEEK.'</td>';
							}
						}
					echo '</tr>';
				}	
			}
		?>
		</tbody>

	</table>



</body>