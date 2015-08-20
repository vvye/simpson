<?php

	require_once 'inc/functions/database.php';

	if (isset($_POST['login-submit']))
	{
		if (empty($_POST['email']) || empty($_POST['password']))
		{
			$loginErrorMessage = 'please fill in both fields.';
		}
		else
		{
			$database = getDatabase();

			$result = $database->select('users', '*', [
				'email' => $_POST['email']
			]);

			if (empty($result) || count($result) !== 1)
			{
				$loginErrorMessage = 'login failed.';
			}
			else
			{
				$passwordHash = $result[0]['password_hash'];

				if (!password_verify($_POST['password'], $passwordHash))
				{
					$loginErrorMessage = 'login failed.';
				}
				else
				{
					session_start();
					$_SESSION['userId'] = $result[0]['id'];
					$_SESSION['firstName'] = $result[0]['first_name'];
					$_SESSION['lastName'] = $result[0]['last_name'];
					$_SESSION['loggedIn'] = true;
				}
			}
		}
	}

	header('Location: index.php' . (isset($loginErrorMessage) ? '?loginErrorMessage=' . $loginErrorMessage : ''));
	die();


