<?php

	require_once 'inc/functions/database.php';

	if (!isset($_POST['register-submit']))
	{
		include 'inc/content/home.php';
	}
	else
	{
		$firstName = trim($_POST['first-name']);
		$lastName = trim($_POST['last-name']);
		$email = trim($_POST['email']);
		$password = $_POST['password'];

		if ($firstName === '' || $lastName === '' || $email === '' || $password == '')
		{
			$registerErrorMessage = 'please fill in all fields.';
			include 'inc/content/home.php';
		}
		else
		{
			$database = getDatabase();

			$result = $database->select('users', '*', [
				'email' => $email
			]);

			if (!empty($result) && count($result) !== 0)
			{
				$registerErrorMessage = 'that email is already registered.';
				include 'inc/content/home.php';
			}
			else
			{
				$passwordHash = password_hash($password, PASSWORD_DEFAULT);

				$database->insert('users', [
					'id'            => null,
					'first_name'    => $_POST['first-name'],
					'last_name'     => $_POST['last-name'],
					'email'         => $_POST['email'],
					'password_hash' => $passwordHash
				]);

				// TODO
				echo 'you registered as ' . $firstName . ' ' . $lastName . '.';
			}
		}
	}
