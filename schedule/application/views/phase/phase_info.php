 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/phase.js"></script>

<?php

foreach($phase_types as $type)
{
	if($type->PHASE_TYPE_ID == $phase->PHASE_TYPE_ID)
	echo '<h1>'.$type->TYPE_NAME.' - '.$phase->PHASE_START.' to '.$phase->PHASE_END.'</h1>';
}


?>

 
</body>
</html>