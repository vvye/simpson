<?php

	require_once __DIR__ . '/../config/database.php';
	require_once __DIR__ . '/../config/user.php';


	function validateRegistrationForm()
	{
		$errorMessages = [];

		if (trim(getFieldValue('email')) === '')
		{
			$errorMessages[] = MSG_EMAIL_MISSING;
		}
		if (getFieldValue('email') !== getFieldValue('email-confirm'))
		{
			$errorMessages[] = MSG_EMAILS_DONT_MATCH;
		}
		if (!preg_match('/^' . VALID_USERNAME_REGEX . '$/', getFieldValue('username')))
		{
			$errorMessages[] = MSG_INVALID_USERNAME;
		}
		if (strlen(getFieldValue('password')) < 8)
		{
			$errorMessages[] = MSG_PASSWORD_TOO_SHORT;
		}
		if (getFieldValue('password') !== getFieldValue('password-confirm'))
		{
			$errorMessages[] = MSG_PASSWORDS_DONT_MATCH;
		}
		if (emailExists(getFieldValue('email')))
		{
			$errorMessages[] = MSG_EMAIL_TAKEN;
		}
		if (usernameExists(getFieldValue('username')))
		{
			$errorMessages[] = MSG_USERNAME_TAKEN;
		}

		return $errorMessages;
	}


	function emailExists($email)
	{
		global $database;

		$numEmails = $database->count('users', [
			'email' => $email
		]);

		return (is_int($numEmails) && $numEmails > 0);
	}


	function usernameExists($username)
	{
		global $database;

		$numUsers = $database->count('users', [
			'name' => $username
		]);

		return (is_int($numUsers) && $numUsers > 0);
	}


	function startRegistration($email, $username, $passwordHash)
	{
		global $database;

		$activationToken = bin2hex(random_bytes(16));

		$userId = $database->insert('users', [
			'id'                   => null,
			'email'                => strtolower(htmlspecialchars($email)),
			'name'                 => htmlspecialchars($username),
			'password'             => $passwordHash,
			'legacy_login'         => 0,
			'registration_time'    => time(),
			'activated'            => 0,
			'enable_notifications' => 1,
			'activation_token'     => $activationToken
		]);

		return $userId;
	}
	
	