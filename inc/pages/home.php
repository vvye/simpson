<?php

	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/register.php';


	if (isset($_POST['register']))
	{
		$registrationErrorMessages = validateRegistrationForm();

		if (empty($registrationErrorMessages))
		{
			$email = htmlspecialchars(trim(getFieldValue('email')));
			$firstName = getFieldValue('first-name');
			$lastName = getFieldValue('last-name');
			$passwordHash = password_hash(getFieldValue('password'), PASSWORD_DEFAULT);

			startRegistration($email, $firstName, $lastName, $passwordHash);
		}
	}

	renderTemplate('home', [
		'loggedIn'                  => isLoggedIn(),
		'displayName'               => $_SESSION['firstName'] ?? '',
		'loginError'                => isset($_GET['login-error']),
		'firstName'                 => getFieldValue('first-name'),
		'lastName'                  => getFieldValue('last-name'),
		'email'                     => getFieldValue('email'),
		'password'                  => getFieldValue('password'),
		'registrationAttempted'     => isset($registrationErrorMessages),
		'registrationErrorMessages' => $registrationErrorMessages ?? []
	]);