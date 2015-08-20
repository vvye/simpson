<?php

	function sanitizePageName($pageName)
	{
		return preg_replace('/[^A-Za-z0-9 ]/', '', $pageName);
	}


	function getMenuItems()
	{
		return [
			[
				'pageName' => 'home',
				'caption'  => 'home'
			],
			[
				'pageName'  => 'messages',
				'caption'   => 'messages',
				'condition' => (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
			],
			[
				'pageName'  => 'profile',
				'caption'   => 'my profile',
				'condition' => (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
			],
			[
				'pageName'  => 'admin',
				'caption'   => 'admin',
				'condition' => (isset($_SESSION['admin']) && $_SESSION['admin'] === true)
			]
		];
	}


	function renderMenu()
	{
		$menuItems = getMenuItems();
		foreach ($menuItems as $menuItem)
		{
			if (isset($menuItem['condition']) && !$menuItem['condition'])
			{
				continue;
			}

			$selected = ($menuItem['pageName'] === $_SESSION['currentPageName'])
				? ' pure-menu-selected'
				: '';
			echo '<li class="pure-menu-item' . $selected . '">'
				. '<a href="?p=' . $menuItem['pageName'] . '" class="pure-menu-link">'
				. $menuItem['caption']
				. '</a></li>';
		}
	}
