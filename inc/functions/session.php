<?php

	require_once 'inc/functions/database.php';

	function isLoggedIn()
	{
		return (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true);
	}


	function isAdmin()
	{
		return (isset($_SESSION['admin']) && $_SESSION['admin'] === true);
	}


	function doRegister()
	{
		$firstName = trim($_POST['first-name']);
		$lastName = trim($_POST['last-name']);
		$email = trim($_POST['email']);
		$password = $_POST['password'];

		if ($firstName === '' || $lastName === '' || $email === '' || $password == '')
		{
			$_SESSION['registerErrorMessage'] = 'please fill in all fields.';
		}
		else
		{
			$database = getDatabase();

			$result = $database->select('users', '*', [
				'email' => $email
			]);

			if (!empty($result) && count($result) !== 0)
			{
				$_SESSION['registerErrorMessage'] = 'that email is already registered.';
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

				mail($_POST['email'],
					'welcome to simpson!',
					'hey there, you decided to register for some reason! welcome and stuff!'
				);
			}
		}
	}


	function doLogin()
	{
		if (empty($_POST['email']) || empty($_POST['password']))
		{
			$_SESSION['loginErrorMessage'] = 'please fill in both fields.';
		}
		else
		{
			$database = getDatabase();

			$result = $database->select('users', '*', [
				'email' => $_POST['email']
			]);

			if (empty($result) || count($result) !== 1)
			{
				$_SESSION['loginErrorMessage'] = 'login failed.';
			}
			else
			{
				$passwordHash = $result[0]['password_hash'];

				if (!password_verify($_POST['password'], $passwordHash))
				{
					$_SESSION['loginErrorMessage'] = 'login failed.';
				}
				else
				{
					$_SESSION['userId'] = $result[0]['id'];
					$_SESSION['firstName'] = $result[0]['first_name'];
					$_SESSION['lastName'] = $result[0]['last_name'];
					$_SESSION['loggedIn'] = true;
				}
			}
		}
	}


	function doLogout()
	{
		$_SESSION = [];
		session_destroy();
	}
