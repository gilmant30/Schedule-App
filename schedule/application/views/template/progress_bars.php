<script type="text/javascript" src="<?= base_url();?>assets/js/home_page.js" ></script>


<div class="display">
	<h3>Select View</h3>
	<ul>
		<li><select name="project_system" id="project-system">
      <?php
        echo '<option value="0">None</option>';
        foreach($systems as $system)
          echo '<option value="'.$system->SKILL_ID.'">'.$system->SKILL_NAME.'</option>';
      ?>
    </select></li>
		<li><select name="project_type" id="resource-type">
     <?php
        echo '<option value="0">None</option>';
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
<div class="bar"></div>


