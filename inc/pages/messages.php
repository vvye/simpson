<?php

	require_once __DIR__ . '/../functions/form.php';
	require_once __DIR__ . '/../functions/messages.php';
	require_once __DIR__ . '/../functions/users.php';

	global $currentSubpageName;


	do
	{
		$newMessageId = null;
		$newReplyId = null;
		$parentId = null;
		$messageErrors = [];
		$replyErrors = [];

		if (isset($_POST['post-message']))
		{
			$messageContent = trim(getFieldValue('content'));
			$replyContent = '';
			$addAddressee = getFieldValue('add-addressee');
			$addressee = trim(getFieldValue('addressee'));

			if (trim($messageContent) === '')
			{
				$messageErrors[] = MSG_NO_MESSAGE_CONTENT;
				break;
			}

			if (!isCsrfTokenCorrect(getFieldValue('token')))
			{
				$messageErrors[] = MSG_BAD_TOKEN;
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

			$newMessageId = postMessage($messageContent, $addresseeId);
			$messageContent = '';
			$addAddressee = false;
			$addressee = '';

		}
		else if (isset($_POST['post-reply']))
		{
			$messageContent = '';
			$replyContent = trim(getFieldValue('reply-content'));
			$addAddressee = false;
			$addressee = '';

			$parentId = getFieldValue('message-id');

			if (trim($replyContent) === '')
			{
				$replyErrors[] = MSG_NO_MESSAGE_CONTENT;
				break;
			}

			if (!isCsrfTokenCorrect(getFieldValue('token')))
			{
				$replyErrors[] = MSG_BAD_TOKEN;
				break;
			}

			$newReplyId = postReply($replyContent, $parentId);
		}
		else
		{
			$messageContent = '';
			$replyContent = '';
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
		'messages'       => $messages,
		'messageContent' => $messageContent,
		'addAddressee'   => $addAddressee,
		'addressee'      => $addressee,
		'messageError'   => !empty($messageErrors),
		'messageErrors'  => $messageErrors,
		'newMessageId'   => $newMessageId,
		'replyContent'   => $replyContent,
		'replyError'     => !empty($replyErrors),
		'replyErrors'    => $replyErrors,
		'messageId'      => $parentId,
		'newReplyId'     => $newReplyId,
		'token'          => getCsrfToken(),
	]);

	renderPagination(BASE_PATH . '/messages', $page, $numPages);