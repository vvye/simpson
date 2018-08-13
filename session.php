<?php

	require_once __DIR__ . '/inc/functions/database.php';
	require_once __DIR__ . '/inc/functions/session.php';


	session_start();

	$database = getDatabase();

	$baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']);

	if (isset($_GET['action']) && $_GET['action'] === 'login')
	{
		$loginSuccess = doLogin();
		header('Location: ' . $baseUrl . '/?p=home' . ($loginSuccess ? '' : '&login-error'));
	}
	else if (isset($_GET['action']) && $_GET['action'] === 'logout')
	{
		doLogout();
		header('Location: ' . $baseUrl . '/?p=home');
	}
	else
	{
		header('Location: ' . $baseUrl . '/?p=home');
	}
