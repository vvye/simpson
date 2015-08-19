<?php

	require_once 'inc/functions/database.php';

	if (!isset($_POST['register-submit']))
	{
		include 'inc/content/home.php';
	}
	else
	{
		// TODO check input

		$database = getDatabase();

		$database->insert('users', [
			'id'         => null,
			'first_name' => $_POST['first-name'],
			'last_name'  => $_POST['last-name'],
			'email'      => $_POST['email'],
			'password'   => $_POST['password']
		]);

		echo 'you registered as ' . $_POST['first-name'] . ' ' . $_POST['last-name'] . '(' . $_POST['email'] . ').';
	}
