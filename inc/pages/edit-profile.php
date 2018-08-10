<?php

	require_once __DIR__ . '/../functions/users.php';
	require_once __DIR__ . '/../functions/avatars.php';
	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/misc.php';
	require_once __DIR__ . '/../functions/register.php';

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

		if (!isset($_GET['token']) || !isCsrfTokenCorrect($_GET['token']))
		{
			renderErrorMessage(MSG_BAD_TOKEN);
			break;
		}
		$token = $_GET['token'];

		$user = getUser($userId);

		if (!isset($_POST['submit']))
		{
			$email = htmlspecialchars_decode($user['email']);
			$emailPublic = (bool)$user['email_public'];
			$firstName = htmlspecialchars_decode($user['first_name']);
			$lastName = htmlspecialchars_decode($user['last_name']);
			$oldPassword = '';
			$newPassword = $newPasswordConfirm = '';
			$bio = htmlspecialchars_decode($user['bio']);
		}
		else
		{
			$email = trim(getFieldValue('email'));
			$emailPublic = (bool)getFieldValue('email-public');
			$firstName = getFieldValue('first-name');
			$lastName = getFieldValue('last-name');
			$oldPassword = getFieldValue('old-password');
			$newPassword = getFieldValue('new-password');
			$newPasswordConfirm = getFieldValue('new-password-confirm');
			$bio = trim(getFieldValue('bio'));

			$error = false;

			if ($email === '')
			{
				renderErrorMessage(MSG_EMAIL_MISSING);
				$error = true;
			}

			if (trim(getFieldValue('first-name')) === '')
			{
				renderErrorMessage(MSG_FIRST_NAME_MISSING);
				$error = true;
			}
			else if (!preg_match('/^' . VALID_USERNAME_REGEX . '$/', getFieldValue('first-name')))
			{
				renderErrorMessage(MSG_INVALID_FIRST_NAME);
				$error = true;
			}
			if (trim(getFieldValue('last-name')) === '')
			{
				renderErrorMessage(MSG_LAST_NAME_MISSING);
				$error = true;
			}
			else if (!preg_match('/^' . VALID_USERNAME_REGEX . '$/', getFieldValue('last-name')))
			{
				renderErrorMessage(MSG_INVALID_LAST_NAME);
				$error = true;
			}

			$oldEmail = htmlspecialchars_decode($user['email']);
			$changeEmail = (strtolower($oldEmail) !== strtolower($email));
			if ($changeEmail && emailExists($email))
			{
				renderErrorMessage(MSG_EMAIL_TAKEN);
				$error = true;
			}

			$changePassword = ($newPassword !== '');
			if ($changePassword)
			{
				if (!isPasswordCorrect($userId, $oldPassword))
				{
					renderErrorMessage(MSG_WRONG_PASSWORD);
					$error = true;
				}
				if (strlen($newPassword) < MIN_PASSWORD_LENGTH)
				{
					renderErrorMessage(MSG_PASSWORD_TOO_SHORT);
					$error = true;
				}
				if ($newPassword !== $newPasswordConfirm)
				{
					renderErrorMessage(MSG_PASSWORDS_DONT_MATCH);
					$error = true;
				}
			}

			$changeAvatar = isset($_POST['change-avatar']);
			if ($changeAvatar)
			{
				$deleteAvatar = isset($_POST['delete-avatar']);
				if ($deleteAvatar)
				{
					deleteAvatar($userId);
				}
				else
				{
					$errorMessages = processUploadedAvatar($userId);
					if (!empty($errorMessages))
					{
						foreach ($errorMessages as $errorMessage)
						{
							renderErrorMessage($errorMessage);
						}
						$error = true;
					}
				}
			}

			if (!$error)
			{
				setUserData($userId, [
					'email'       => $email,
					'firstName'   => $firstName,
					'lastName'    => $lastName,
					'emailPublic' => $emailPublic,
					'bio'         => $bio
				]);

				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;

				if ($changePassword)
				{
					updatePassword($userId, $newPassword);
				}

				renderSuccessMessage(MSG_EDIT_PROFILE_SUCCESS);
			}
		}

		renderTemplate('edit-profile', [
			'action'             => BASE_PATH . '/edit-profile' . ($isOwnProfile ? '' : ('/' . $userId)) . '?token=' . getCsrfToken(),
			'isOwnProfile'       => $isOwnProfile,
			'userId'             => $userId,
			'firstName'          => $firstName,
			'lastName'           => $lastName,
			'email'              => $email,
			'emailPublic'        => $emailPublic,
			'hasAvatar'          => hasAvatar($userId),
			'oldPassword'        => $oldPassword,
			'newPassword'        => $newPassword,
			'newPasswordConfirm' => $newPasswordConfirm,
			'bio'                => $bio,
			'token'              => $token
		]);
	} while (false);