<?php

	require_once __DIR__ . '/../functions/avatars.php';
	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/misc.php';
	require_once __DIR__ . '/../functions/register.php';
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
			$isOwnProfile = false;
		}

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

			if (!isCsrfTokenCorrect(getFieldValue('token')))
			{
				renderErrorAlert(MSG_BAD_TOKEN);
				$error = true;
			}

			if ($email === '')
			{
				renderErrorAlert(MSG_EMAIL_MISSING);
				$error = true;
			}

			if (trim(getFieldValue('first-name')) === '')
			{
				renderErrorAlert(MSG_FIRST_NAME_MISSING);
				$error = true;
			}
			else if (!preg_match('/^' . VALID_USERNAME_REGEX . '$/', getFieldValue('first-name')))
			{
				renderErrorAlert(MSG_INVALID_FIRST_NAME);
				$error = true;
			}
			if (trim(getFieldValue('last-name')) === '')
			{
				renderErrorAlert(MSG_LAST_NAME_MISSING);
				$error = true;
			}
			else if (!preg_match('/^' . VALID_USERNAME_REGEX . '$/', getFieldValue('last-name')))
			{
				renderErrorAlert(MSG_INVALID_LAST_NAME);
				$error = true;
			}

			$oldEmail = htmlspecialchars_decode($user['email']);
			$changeEmail = (strtolower($oldEmail) !== strtolower($email));
			if ($changeEmail && emailExists($email))
			{
				renderErrorAlert(MSG_EMAIL_TAKEN);
				$error = true;
			}

			$changePassword = ($newPassword !== '');
			if ($changePassword)
			{
				if (!isPasswordCorrect($userId, $oldPassword))
				{
					renderErrorAlert(MSG_WRONG_PASSWORD);
					$error = true;
				}
				if (strlen($newPassword) < MIN_PASSWORD_LENGTH)
				{
					renderErrorAlert(MSG_PASSWORD_TOO_SHORT);
					$error = true;
				}
				if ($newPassword !== $newPasswordConfirm)
				{
					renderErrorAlert(MSG_PASSWORDS_DONT_MATCH);
					$error = true;
				}
			}

			$changeAvatar = isset($_POST['change-avatar']);
			$deleteAvatar = isset($_POST['delete-avatar']);
			if ($changeAvatar)
			{
				$errorMessages = processUploadedAvatar($userId);
				if (!empty($errorMessages))
				{
					foreach ($errorMessages as $errorMessage)
					{
						renderErrorAlert($errorMessage);
					}
					$error = true;
				}
			}
			else if ($deleteAvatar)
			{
				deleteAvatar($userId);
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

				renderSuccessAlert(MSG_EDIT_PROFILE_SUCCESS);
			}
		}

		renderTemplate('edit-profile', [
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
			'token'              => getCsrfToken()
		]);
	} while (false);