<?php

	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/messages.php';


	do
	{
		if (!isset($_GET['message']) || !is_int($_GET['message'] * 1))
		{
			renderErrorAlert(MSG_MESSAGE_DOESNT_EXIST);
			break;
		}
		$messageId = $_GET['message'] * 1;

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

		$success = $error = false;

		if (isset($_POST['submit']))
		{
			if (!isCsrfTokenCorrect(getFieldValue('token')))
			{
				renderErrorAlert(MSG_BAD_TOKEN);
				break;
			}
			if (deleteMessage($messageId))
			{
				$success = true;
			}
			else
			{
				$error = true;
			}
		}

		renderTemplate('delete', [
			'message' => $message,
			'success' => $success,
			'error'   => $error,
			'token'   => getCsrfToken()
		]);

	} while (false);
