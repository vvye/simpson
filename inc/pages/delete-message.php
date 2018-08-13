<?php

	require_once __DIR__ . '/../functions/messages.php';

	global $currentSubpageName;


	do
	{
		if (!is_numeric($currentSubpageName) || !is_int($currentSubpageName * 1))
		{
			renderErrorAlert(MSG_MESSAGE_DOESNT_EXIST);
			break;
		}
		$messageId = $currentSubpageName * 1;

		$message = getMessage($messageId);

		if ($message === null)
		{
			renderErrorAlert(MSG_MESSAGE_DOESNT_EXIST);
			break;
		}

		if ((int)$message['author_id'] !== $_SESSION['userId'])
		{
			renderErrorAlert(MSG_NOT_YOUR_MESSAGE);
			break;
		}

		if (!isCsrfTokenCorrect(getFieldValue('token')))
		{
			renderErrorAlert(MSG_BAD_TOKEN);
			break;
		}

		$success = $error = false;

		if (isset($_POST['submit']))
		{
			if (deleteMessage($messageId))
			{
				$success = true;
			}
			else
			{
				$error = true;
			}
		}

		renderTemplate('delete-message', [
			'message' => $message,
			'success' => $success,
			'error'   => $error,
			'token'   => getCsrfToken()
		]);

	} while (false);
