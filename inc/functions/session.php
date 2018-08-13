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
			'password',
			'last_activity_time'
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

		$_SESSION['userId'] = (int)$user['id'];
		$_SESSION['firstName'] = $user['first_name'];
		$_SESSION['lastName'] = $user['last_name'];
		$_SESSION['loggedIn'] = true;
		$_SESSION['lastActivityTime'] = $user['last_activity_time'];

		$_SESSION['csrfToken'] = renewCsrfToken();

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

		try
		{
			$newToken = bin2hex(random_bytes(8));
		}
		catch (Exception $e)
		{
			$newToken = substr(md5(rand()), 0, 8);
		}

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


	function updatePassword($userId, $password)
	{
		global $database;

		$database->update('users', [
			'password' => password_hash($password, PASSWORD_DEFAULT)
		], [
			'id' => $userId
		]);
	}


	function updateLastActivityTime()
	{
		global $database;

		if (!isLoggedIn())
		{
			return;
		}

		$now = time();

		$_SESSION['lastActivityTime'] = $now;

		$database->update('users', [
			'last_activity_time' => $now
		], [
			'id' => $_SESSION['userId']
		]);
	}
