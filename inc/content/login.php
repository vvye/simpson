<?php

	require_once 'inc/functions/database.php';

	if (!isset($_POST['login-submit']))
	{
		include 'inc/content/home.php';
	}
	else
	{
		$database = getDatabase();

		// TODO obviously
		$result = $database->select('users', '*', [
			'AND' => [
				'email'    => $_POST['email'],
				'password' => $_POST['password']
			]
		]);

		if (empty($result) || count($result) !== 1)
		{
			echo 'login failed.';
		}
		else
		{
			echo 'you logged in as ' . $_POST['email'] . '.';
		}
	}

