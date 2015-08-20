<?php

	require_once 'inc/functions/session.php';

	session_start();
	unset($_SESSION['registerErrorMessage']);
	unset($_SESSION['loginErrorMessage']);

	if (isset($_POST['register-submit']))
	{
		doRegister();
	}
	else if (isset($_POST['login-submit']))
	{
		doLogin();
	}
	else if (isset($_GET['logout']))
	{
		doLogout();
	}

	header('Location: index.php');
