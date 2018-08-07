<?php

	renderTemplate('home', [
		'loggedIn'   => isLoggedIn(),
		'firstName'  => $_SESSION['firstName'] ?? '',
		'loginError' => isset($_GET['login-error'])
	]);

	if (isset($_POST['register']))
	{
		print_r($_POST);
	}