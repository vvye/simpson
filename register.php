<?php

	require_once 'inc/functions/database.php';

	if (!isset($_POST['register-submit']))
	{
		$firstName = trim($_POST['first-name']);
		$lastName = trim($_POST['last-name']);
		$email = trim($_POST['email']);
		$password = $_POST['password'];

		if ($firstName === '' || $lastName === '' || $email === '' || $password == '')
		{
			$registerErrorMessage = 'please fill in all fields.';
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

	header('Location: index.php ' . (isset($registerErrorMessage)) ? '?registerErrorMessage=' . $registerErrorMessage : '');
	die();
