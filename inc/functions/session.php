<?php

	function doLogin()
	{
		global $database;

		$givenEmail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
		$givenPassword = filter_input(INPUT_POST, 'password');

		$user = $database->get('users', [
			'id',
			'first_name',
			'last_name',
			'password'
		], [
			'email' => $givenEmail
		]);

		if (!is_array($user) || empty($user))
		{
			return false;
		}

		if (!isPasswordCorrect($user['id'], $givenPassword))
		{
			return false;
		}

		$_SESSION['userId'] = $user['id'];
		$_SESSION['firstName'] = $user['first_name'];
		$_SESSION['lastName'] = $user['last_name'];
		$_SESSION['loggedIn'] = true;

		$_SESSION['csrfToken'] = renewCsrfToken();

		$database->update('users', [
			'last_login_time' => time(),
		], [
			'id' => $user['id']
		]);

		return true;
	}


	function doLogout()
	{
		session_unset();
		session_destroy();
	}


	function isPasswordCorrect($userId, $givenPassword)
	{
		global $database;

		$user = $database->get('users', '*', [
			'id' => $userId
		]);

		if (!is_array($user) || empty($user))
		{
			return false;
		}

		$passwordHash = $user['password'];

		return password_verify($givenPassword, $passwordHash);
	}


	function getCsrfToken()
	{
		if (!isLoggedIn())
		{
			return '';
		}

		return $_SESSION['csrfToken'];
	}


	function isCsrfTokenCorrect($token)
	{
		return $token === $_SESSION['csrfToken'];
	}


	function renewCsrfToken()
	{
		global $database;

		$newToken = bin2hex(random_bytes(8));
		$database->update('users', [
			'csrf_token' => $newToken
		], [
			'id' => $_SESSION['userId']
		]);

		return $newToken;
	}


	function isLoggedIn()
	{
		return $_SESSION['loggedIn'] ?? false;
	}