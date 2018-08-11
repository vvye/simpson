<?php

	require_once __DIR__ . '/users.php';
	require_once __DIR__ . '/avatars.php';


	function getMessages()
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
			'ORDER' => ['post_time' => 'DESC', 'id' => 'ASC']
		]);

		$messages = array_map('processMessage', $messages);

		return $messages;
	}


	function processMessage($message)
	{
		$message['hasAddressee'] = $message['addressee_id'] !== null && userExists($message['addressee_id']);
		$message['authorHasAvatar'] = hasAvatar($message['author_id']);
		$message['content'] = nl2br($message['content']);

		return $message;
	}