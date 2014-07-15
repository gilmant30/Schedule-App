<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<style>@import url('<?=base_url()?>/assets/css/login_screen.css'); </style>
	<title>Welcome to CodeIgniter</title>
</head>
<body>

<div id="container">
	<h1>Login screen!</h1>

<?php
	$attr = 'id="login_form"';
	echo form_open('login/login_form', $attr);

	echo '<h3>Login</h3>';

	echo '<div id="input">';
	$data = array(
		'name' => 'email',
		'id' => 'email',
		'placeholder' => 'Email'
		);
	echo form_input($data);
	echo '</div>';

	echo '<div id="input">';
	$data = array(
		'name' => 'password',
		'id' => 'password',
		'placeholder' => 'Password'
		);
	echo form_password($data);
	echo '</div>';

	echo '<div id="login_submit">';
	$data = array(
		'name' => 'submit',
		'id' => 'login_submit',
		'value' => 'Login'
		);
	echo form_submit($data);
	echo '</div>';

	echo form_close();
?>

</div>

</body>
</html>