	<script type="text/javascript" src="<?=base_url()?>assets/js/project.js"></script>
	<style>@import url('<?=base_url()?>assets/css/project.css'); </style>
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter()  
	}); 
</script>

<body>
<div class="all-projects">
	<h1>Show all Projects</h1>
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
						echo '<td>'.$proj->PROJECT_DEPT_ID.'</td>';
						echo '<td>'.$proj->PROJECT_TYPE_ID.'</td>';
						echo '<td>'.$proj->PROJECT_SPONSOR.'</td>';
						echo '<td>'.$proj->PROJECT_DESCRIPTOR.'</td>';
					echo '</tr>';
				}	
			}
		?>
		</tbody>

	</table>



</body>
