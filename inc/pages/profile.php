<?php

	require_once __DIR__ . '/../functions/avatars.php';
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
			renderErrorAlert(MSG_USER_DOESNT_EXIST);
			break;
		}

		renderTemplate('profile', [
			'isOwnProfile'     => $isOwnProfile,
			'userId'           => $userId,
			'firstName'        => $user['first_name'],
			'lastName'         => $user['last_name'],
			'email'            => obfuscateEmail($user['email']),
			'emailPublic'      => $user['email_public'],
			'bio'              => nl2br($user['bio']),
			'hasAvatar'        => hasAvatar($userId),
			'registrationTime' => $user['registration_time'],
			'lastLoginTime'    => $user['last_login_time'],
			'token'            => getCsrfToken()
		]);

	} while (false);