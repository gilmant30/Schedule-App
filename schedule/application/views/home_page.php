<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-latest.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-ui-1.10.4.custom.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/new_project.js" ></script>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">


<style>@import url('<?=base_url()?>assets/css/home_page.css'); </style>

<script type="text/javascript">
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

<body>
<div id="project_id"></div>
<div class="main-container">
  
  <div class="left-container">
    <h2>Schedule Home Page</h1>
      <p>Whatever the home page wants to look like info can go here</p>
  </div>

  <div class="right-container">
  	<div class="display">
  		<h3>Select View</h3>
  		<ul>
  			<li>By day</li>
  			<li>By month</li>
  			<li>By year</li>
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

  </div>

</div>  


</body>
