<?php

	function sanitize($string)
	{
		return preg_replace('/[^A-Za-z0-9 ]/', '', $string);
	}


	function getDefaultMenuItems()
	{
		return [
			[
				'pageName' => 'home',
				'caption' => 'home'
			],
			[
				'pageName' => 'messages',
				'caption' => 'messages',
				'condition' => (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
			],
			[
				'pageName' => 'profile',
				'caption' => 'my profile',
				'condition' => (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
			],
			[
				'pageName' => 'admin',
				'caption' => 'admin',
				'condition' => (isset($_SESSION['admin']) && $_SESSION['admin'] === true)
			],
			[
				'pageName' => 'logout',
				'caption' => 'log out',
				'condition' => (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
			]
		];
	}
