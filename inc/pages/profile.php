<?php

	require_once __DIR__ . '/../functions/avatars.php';
	require_once __DIR__ . '/../functions/users.php';


	do
	{
		if (!isset($_GET['user']) || !is_int($_GET['user'] * 1))
		{
			$userId = $_SESSION['userId'];
			$isOwnProfile = true;
		}
		else
		{
			$userId = $_GET['user'] * 1;
			$isOwnProfile = $userId === $_SESSION['userId'];
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
			'lastActivityTime' => $user['last_activity_time']
		]);

	} while (false);