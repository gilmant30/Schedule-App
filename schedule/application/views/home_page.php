<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-latest.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/jquery-ui-1.10.4.custom.min.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/jquery.multi-select.js" ></script>
<script type="text/javascript" src="<?= base_url();?>assets/js/new_project.js" ></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<style>@import url('<?=base_url()?>assets/css/home_page.css'); </style>

<script type="text/javascript">
var base_url = 'http://localhost/schedule/';
$(document).ready(function(){
  $(".right-container").load(base_url + 'project/progressBar');
});
</script>

<body>
<div id="project_id"></div>
<div class="main-container">
  
  <div class="left-container">
    <h2>Schedule Home Page</h1>
      <p>Whatever the home page wants to look like info can go here</p>
  </div>

  <div class="right-container"></div>  


</body>
