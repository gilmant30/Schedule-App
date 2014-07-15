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
				<th>Project Descriptor</th>
				<th>Name</th>
				<th>Year</th>
				<th>Department</th>
				<th>Type</th>
				<th>Sponsor</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td id="clickable">Exampele</td>
				<td>Project 1</td>
				<td>2014</td>
				<td>IT</td>
				<td>E</td>
				<td>Joe</td>
			</tr>
			<tr>
				<td>Exampele 2</td>
				<td>Project 2</td>
				<td>2015</td>
				<td>IT</td>
				<td>E</td>
				<td>Joe</td>
			</tr>
		</tbody>

	</table>


</body>
