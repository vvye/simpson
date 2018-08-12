<?php

	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/messages.php';
	require_once __DIR__ . '/../functions/users.php';

	global $currentSubpageName;


	do
	{

		$newId = null;
		$error = false;
		$errorMessages = [];

		if (!isset($_POST['submit']))
		{
			$content = '';
			$addAddressee = false;
			$addressee = '';
		}
		else
		{
			$content = trim(getFieldValue('content'));
			$addAddressee = getFieldValue('add-addressee');
			$addressee = trim(getFieldValue('addressee'));

			if (trim($content) === '')
			{
				$error = true;
				$errorMessages[] = MSG_NO_MESSAGE_CONTENT;
				break;
			}

			$numUsersByName = getNumUsersByName($addressee);

			if ($numUsersByName !== 0)
			{
				// if there are multiple users by that name, arbitrarily take the first one
				$addresseeId = getUserIdByName($addressee);
			}
			else if (is_numeric($addressee) && is_int($addressee * 1) && userExists($addressee))
			{
				$addresseeId = $addressee;
			}
			else
			{
				$addresseeId = null;
			}

			$newId = postMessage($content, $addresseeId);
			$content = '';
			$addAddressee = false;
			$addressee = '';

		}

	} while (false);

	$page = is_numeric($currentSubpageName) && is_int($currentSubpageName * 1) ? $currentSubpageName * 1 : 1;
	$numMessages = getNumMessages();
	$numPages = (int)ceil($numMessages / MESSAGES_PER_PAGE);
	constrain($page, 1, $numPages);

	$messages = getMessages($page);

	renderTemplate('messages', [
		'messages'      => $messages,
		'content'       => $content,
		'addAddressee'  => $addAddressee,
		'addressee'     => $addressee,
		'error'         => $error,
		'errorMessages' => $errorMessages,
		'newId'         => $newId,
	]);

	renderPagination(BASE_PATH . '/messages', $page, $numPages);