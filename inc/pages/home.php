<?php

	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/messages.php';
	require_once __DIR__ . '/../functions/register.php';


	if (isset($_POST['home-panel']))
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

	if (isLoggedIn())
	{
		$numNewMessages = getNumNewMessages();
		$numNewReplies = getNumNewReplies();
		$numNewAddressings = getNumNewAddressings();
		$numNewRepliesToUser = getNumNewRepliesToUser();
	}

	renderTemplate('home', [
		'loggedIn'                  => isLoggedIn(),
		'displayName'               => $_SESSION['firstName'] ?? '',
		'hasAvatar'                 => hasAvatar($_SESSION['userId']),
		'userId'                    => $_SESSION['userId'],
		'loginError'                => isset($_GET['login-error']),
		'firstName'                 => getFieldValue('first-name'),
		'lastName'                  => getFieldValue('last-name'),
		'email'                     => getFieldValue('email'),
		'password'                  => getFieldValue('password'),
		'registrationAttempted'     => isset($registrationErrorMessages),
		'registrationErrorMessages' => $registrationErrorMessages ?? [],
		'numNewMessages'            => $numNewMessages ?? '',
		'numNewReplies'             => $numNewReplies ?? '',
		'numNewAddressings'         => $numNewAddressings ?? '',
		'numNewRepliesToUser'       => $numNewRepliesToUser ?? ''
	]);