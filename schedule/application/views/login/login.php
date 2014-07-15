<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<style>@import url('<?=base_url()?>/assets/css/login_screen.css'); </style>
	<title>Login</title>
</head>
<body>

<div class="container">
<?php
	$attr = 'id="login_form"';
		echo form_open('login/index', $attr);
		echo '<h1>Login</h1>';

		$data = array(
			'name' => 'email',
			'id' => 'email',
			'placeholder' => 'Email'
			);
		echo form_input($data);

		$data = array(
			'name' => 'password',
			'id' => 'password',
			'placeholder' => 'Password'
			);
		echo form_password($data);

		$data = array(
			'name' => 'submit',
			'id' => 'login_submit',
			'value' => 'Login'
			);
		echo form_submit($data);

		echo form_close();
		echo '<div id="error">'.validation_errors().'</div>'; 
?>
<div id="login_status"><?=$error?></div>

</div>

</body>
</html>