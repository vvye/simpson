<?php

	require_once __DIR__ . '/../config/messages.php';

	require_once __DIR__ . '/users.php';
	require_once __DIR__ . '/avatars.php';


	function getNumMessages()
	{
		global $database;

		return $database->count('messages', 'id', [
			'AND' => [
				'parent'  => null,
				'deleted' => 0
			]
		]);
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


	function processMessage($message)
	{
		$message = processReply($message);
		$message['hasAddressee'] = $message['addressee_id'] !== null && userExists($message['addressee_id']);
		$message['replies'] = getReplies($message['id']);

		return $message;
	}


	function processReply($reply)
	{
		$reply['authorHasAvatar'] = hasAvatar($reply['author_id']);
		$reply['content'] = nl2br($reply['content']);

		return $reply;
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
			'parent' => $messageId,
			'ORDER'  => ['post_time' => 'ASC', 'id' => 'ASC']
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