<?php

	require_once __DIR__ . '/../functions/messages.php';


	$messages = getMessages();

	renderTemplate('messages', [
		'messages' => $messages
	]);