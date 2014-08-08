<script type="text/javascript">
$(function() {
    $( "#project-year" ).selectmenu();
 
    $( "#resource-type" ).selectmenu();
 
    $( "#project-system" )
      .selectmenu()
      .selectmenu( "menuWidget" )
        .addClass( "overflow" );
  });

$(function() {
    $( "#dev-progress-bar" ).progressbar({
      value: 37
    });
});

$(function() {
    $( "#ba-progress-bar" ).progressbar({
      value: 65
    });
});

$(function() {
    $( "#ops-progress-bar" ).progressbar({
      value: 15
    });
});
</script>

<div class="display">
	<h3>Select View</h3>
	<ul>
		<li><select name="project_system" id="project-system">
      <?php
        echo '<option value="none">None</option>';
        foreach($systems as $system)
          echo '<option name="'.$system->SKILL_ID.'">'.$system->SKILL_NAME.'</option>';
      ?>
    </select></li>
		<li><select name="project_type" id="resource-type">
     <?php
        echo '<option value="none">None</option>';
        foreach($resource_types as $type)
          echo '<option value="'.$type->RESOURCE_TYPE_ID.'">'.$type->TYPE_NAME.'</option>';
      ?>
    </select></li>
		<li><select name="year" id="project-year">
        <?php
        foreach($years as $year)
          echo '<option value="'.$year.'">'.$year.'</option>';
      ?>
    </select></li>
	</ul>
</div>
<div class="dev">
	<p>Developers total hrs <p>
	<div id="dev-progress-bar"></div>
	<div>0%</div>
	<p class="button">Show developer hours</p>
</div>

</br>

<div class="ba">
	<p>Business Analyst total hrs <p>
	<div id="ba-progress-bar"></div>
	<div>0%</div>
	<p class="button">Show ba hours</p>
</div>

 </br>

<div class="ops">
	<p>Ops total hrs <p>
	<div id="ops-progress-bar"></div>
	<div>0%</div>
	<p class="button">Show ops hours</p>
</div>