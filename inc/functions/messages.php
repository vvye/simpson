<?php

	require_once __DIR__ . '/../config/messages.php';

	require_once __DIR__ . '/users.php';
	require_once __DIR__ . '/avatars.php';


	function getNumMessages()
	{
		global $database;

		return (int)($database->count('messages', 'id', [
			'AND' => [
				'parent'  => null,
				'deleted' => 0
			]
		]));
	}


	function getMessages($page)
	{
		global $database;

		$messages = $database->select('messages', [
			'[>]users(author)'    => ['user' => 'id'],
			'[>]users(addressee)' => ['addressee' => 'id']
		], [
			'messages.id',
			'messages.post_time',
			'messages.content',
			'author.id(author_id)',
			'author.first_name(author_first_name)',
			'author.last_name(author_last_name)',
			'addressee.id(addressee_id)',
			'addressee.first_name(addressee_first_name)',
			'addressee.last_name(addressee_last_name)'
		], [
			'AND'   => [
				'parent'  => null,
				'deleted' => 0
			],
			'ORDER' => ['post_time' => 'DESC', 'id' => 'DESC'],
			'LIMIT' => [($page - 1) * MESSAGES_PER_PAGE, MESSAGES_PER_PAGE]
		]);

		$messages = array_map('processMessage', $messages);

		return $messages;
	}


	function getMessage($id)
	{
		global $database;

		$messages = $database->select('messages', [
			'[>]users(author)'    => ['user' => 'id'],
			'[>]users(addressee)' => ['addressee' => 'id']
		], [
			'messages.id',
			'messages.post_time',
			'messages.content',
			'author.id(author_id)',
			'author.first_name(author_first_name)',
			'author.last_name(author_last_name)',
			'addressee.id(addressee_id)',
			'addressee.first_name(addressee_first_name)',
			'addressee.last_name(addressee_last_name)'
		], [
			'AND' => [
				'messages.id' => $id,
				'deleted'     => 0
			]
		]);

		if (count($messages) !== 1)
		{
			return null;
		}

		return processMessage($messages[0]);
	}


	function processMessage($message)
	{
		$message = processReply($message);
		$message['hasAddressee'] = $message['addressee_id'] !== null && userExists($message['addressee_id']);
		$message['replies'] = getReplies($message['id']);

		return $message;
	}


	function processReply($message)
	{
		$message['authorHasAvatar'] = hasAvatar($message['author_id']);
		$message['content'] = nl2br($message['content']);
		$message['isOwnMessage'] = (int)$message['author_id'] === $_SESSION['userId'];

		return $message;
	}


	function getReplies($messageId)
	{
		global $database;

		$replies = $database->select('messages', [
			'[>]users(author)' => ['messages.user' => 'id']
		], [
			'messages.id',
			'messages.post_time',
			'messages.content',
			'author.id(author_id)',
			'author.first_name(author_first_name)',
			'author.last_name(author_last_name)'
		], [
			'parent'  => $messageId,
			'deleted' => 0,
			'ORDER'   => ['post_time' => 'ASC', 'id' => 'ASC']
		]);

		$replies = array_map('processReply', $replies);

		return $replies;
	}


	function postMessage($content, $addresseeId)
	{
		global $database;

		$database->insert('messages', [
			'id'        => null,
			'user'      => $_SESSION['userId'],
			'addressee' => $addresseeId,
			'parent'    => null,
			'content'   => htmlspecialchars($content),
			'post_time' => time()
		]);

		return $database->id();
	}


	function postReply($content, $parentId)
	{
		global $database;

		$database->insert('messages', [
			'id'        => null,
			'user'      => $_SESSION['userId'],
			'addressee' => null,
			'parent'    => $parentId,
			'content'   => htmlspecialchars($content),
			'post_time' => time()
		]);

		return $database->id();
	}


	function deleteMessage($id)
	{
		global $database;

		$rowCount = $database->update('messages', [
			'deleted' => 1
		], [
			'id' => $id
		])->rowCount();

		return $rowCount === 1;
	}


	function getNumNewMessages()
	{
		global $database;

		return (int)($database->count('messages', 'id', [
			'AND' => [
				'parent'       => null,
				'post_time[>]' => $_SESSION['lastActivityTime']
			]
		]));
	}


	function getNumNewReplies()
	{
		global $database;

		return (int)($database->count('messages', [
			'[>]messages(parents)' => ['parent' => 'id']
		], 'messages.id', [
			'AND' => [
				'parents.post_time[>]'  => $_SESSION['lastActivityTime'],
				'messages.post_time[>]' => $_SESSION['lastActivityTime']
			]
		]));
	}


	function getNumNewAddressings()
	{
		global $database;

		return (int)($database->count('messages', 'id', [
			'AND' => [
				'addressee'    => $_SESSION['userId'],
				'post_time[>]' => $_SESSION['lastActivityTime']
			]
		]));
	}


	function getNumNewRepliesToUser()
	{
		global $database;

		return (int)($database->count('messages', [
			'[>]messages(parents)' => ['parent' => 'id']
		], 'messages.id', [
			'AND' => [
				'parents.user'          => $_SESSION['userId'],
				'messages.post_time[>]' => $_SESSION['lastActivityTime']
			]
		]));
	}