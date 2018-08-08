<?php

	define('BASE_PATH', '/simpson');

	define('DEFAULT_PAGE_NAME', 'home');

	define('DEFAULT_SUBPAGE_NAME', '');

	define('ERROR_PAGE', [
		'name' => '404'
	]);

	define('PAGES', [
		'home' => [
			'name' => 'home',
			'caption' => 'Home'
		],
		'messages' => [
			'name' => 'messages',
			'caption' => 'Messages',
			'condition' => isLoggedIn()
		],
		'profile' => [
			'name' => 'profile',
			'caption' => 'My profile',
			'condition' => isLoggedIn()
		],
		'logout' => [
			'link' => BASE_PATH . '/session.php?action=logout',
			'name' => 'logout',
			'caption' => 'Log out',
			'condition' => isLoggedIn()
		]
	]);