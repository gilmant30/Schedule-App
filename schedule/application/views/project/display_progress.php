<script type="text/javascript" src="<?= base_url();?>assets/js/home_page.js" ></script>


<?php

if($resource_types == TRUE)
{
echo '<h1>'.$type.'</h1>';
  foreach ($time_array as $arr) {
    echo $arr['sys_name']." total hours used:";
    echo '<div id="progress-bar-'.$arr['sys_id'].'-'.$arr['type_id'].'"></div>';

    echo $arr['percentage']."%";
    echo '</br>';
    echo '</br>';
  }
}

if($sys_type == TRUE)
{
  echo '<h1>'.$sys_name.'</h1>';
  foreach ($time_array as $arr) {
    echo $arr['type_name']." total hours used:";
    echo '<div id="progress-bar-'.$arr['sys_id'].'-'.$arr['type_id'].'"></div>';

    echo $arr['percentage']."%";
    echo '</br>';
    echo '</br>';
  }
}

if($resource == TRUE)
{
  echo '<h1>'.$sys_name.'</h1>';
    foreach ($time_array as $arr) {
    echo $arr['resource_name']." total hours used:";
    echo '<div id="progress-bar-'.$arr['sys_id'].'-'.$arr['type_id'].'"></div>';

    echo $arr['percentage']."%";
    echo '</br>';
    echo '</br>';
  }
}
?>


<script type="text/javascript">
$(document).ready(function(){
/*
  var arr = [];
  var length;
  var id;
  var percent;

  arr = <?=json_encode($time_array)?>;

  length = Object.keys(arr).length;

  for(var i = 0; i < length; i++)
  {
    id = String("#progress-bar-" + arr[i].sys_id + "-" + arr[i].type_id);
    percent = parseInt(arr[i].percentage);
    insertProgressBar(id,percent);
  }

  function insertProgressBar(id, percent)
  {
    $(function() {
      $(id).progressbar({
        value: percent
      });
    });
  }
*/
});



</script>