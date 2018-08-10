<?php

	require_once __DIR__ . '/../functions/users.php';


	global $currentSubpageName;

	do
	{

		if ($currentSubpageName === DEFAULT_SUBPAGE_NAME || !is_numeric($currentSubpageName))
		{
			$userId = $_SESSION['userId'];
			$isOwnProfile = true;
		}
		else
		{
			$userId = (int)$currentSubpageName;
			$isOwnProfile = false;
		}

		$user = getUser($userId);
		if ($user === null)
		{
			renderErrorMessage(MSG_USER_DOESNT_EXIST);
			break;
		}

		renderTemplate('profile', [
			'isOwnProfile'     => $isOwnProfile,
			'userId'           => $userId,
			'firstName'        => $user['first_name'],
			'lastName'         => $user['last_name'],
			'email'            => obfuscateEmail($user['email']),
			'bio'              => nl2br($user['bio']),
			'isEmailPublic'    => $user['email_public'],
			'registrationTime' => $user['registration_time'],
			'lastLoginTime'    => $user['last_login_time'],
			'token'            => getCsrfToken()
		]);

	} while (false);