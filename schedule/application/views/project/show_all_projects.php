<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.tablesorter.js" ></script>

<style>@import url('<?=base_url()?>assets/css/new_project.css'); </style>

<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter()  
	}); 
</script>

<body>
<div class="all-projects">
	<h1><?=$title;?></h1>
	<table id="myTable" class="tablesorter">
		<thead>
			<tr>
				<th>Project Code</th>
				<th>Name</th>
				<th>Year</th>
				<th>Department</th>
				<th>Type</th>
				<th>Sponsor</th>
				<th>Descriptor</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if($projects != FALSE)
			{
				foreach($projects as $proj)
				{
					echo '<tr>';
						echo '<td class="clickable" id="'.$proj->PROJECT_ID.'" style="cursor:pointer;">'.$proj->PROJECT_CODE.'</td>';
						echo '<td>'.$proj->PROJECT_NAME.'</td>';
						echo '<td>'.$proj->PROJECT_YEAR.'</td>';
						foreach($department as $dept)
						{
							if($dept->PROJECT_DEPT_ID == $proj->PROJECT_DEPT_ID)
								echo '<td>'.$dept->DEPT_NAME.'</td>';
						}

						foreach($types as $type)
						{
							if($type->PROJECT_TYPE_ID == $proj->PROJECT_TYPE_ID)
								echo '<td>'.$type->TYPE_NAME.'</td>';
						}
						echo '<td>'.$proj->PROJECT_SPONSOR.'</td>';
						echo '<td>'.$proj->PROJECT_DESCRIPTOR.'</td>';
					echo '</tr>';
				}	
			}
		?>
		</tbody>

	</table>



</body>
