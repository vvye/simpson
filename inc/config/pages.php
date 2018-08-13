<?php

	define('BASE_PATH', '/simpson');

	define('DEFAULT_PAGE_NAME', 'home');

	define('ERROR_PAGE', [
		'name' => '404'
	]);

	define('PAGES', [
		'home'           => [
			'name'    => 'home',
			'caption' => 'Home',
			'inMenu'  => true
		],
		'messages'       => [
			'name'      => 'messages',
			'caption'   => 'Messages',
			'condition' => isLoggedIn(),
			'inMenu'    => true,
			'related'   => ['delete']
		],
		'profile'        => [
			'name'      => 'profile',
			'caption'   => 'My profile',
			'condition' => isLoggedIn(),
			'inMenu'    => true,
			'related'   => ['edit-profile']
		],
		'logout'         => [
			'link'      => BASE_PATH . '/session.php?action=logout',
			'name'      => 'logout',
			'caption'   => 'Log out',
			'condition' => isLoggedIn(),
			'inMenu'    => true
		],
		'edit-profile'   => [
			'name'      => 'edit-profile',
			'condition' => isLoggedIn()
		],
		'delete' => [
			'name'      => 'delete',
			'condition' => isLoggedIn()
		]
	]);